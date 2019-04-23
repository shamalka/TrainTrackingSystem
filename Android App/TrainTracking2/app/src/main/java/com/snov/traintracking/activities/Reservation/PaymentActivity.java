package com.snov.traintracking.activities.Reservation;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.CountDownTimer;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.android.volley.AuthFailureError;
import com.android.volley.Request;
import com.android.volley.RequestQueue;
import com.android.volley.Response;
import com.android.volley.VolleyError;
import com.android.volley.toolbox.StringRequest;
import com.android.volley.toolbox.Volley;
import com.braintreepayments.api.dropin.DropInActivity;
import com.braintreepayments.api.dropin.DropInRequest;
import com.braintreepayments.api.dropin.DropInResult;
import com.braintreepayments.api.interfaces.HttpResponseCallback;
import com.braintreepayments.api.internal.HttpClient;
import com.braintreepayments.api.models.PaymentMethodNonce;
import com.snov.traintracking.R;
import com.snov.traintracking.activities.EmailHelpers.GMailSender;
import com.snov.traintracking.activities.MainActivity;
import com.snov.traintracking.activities.NewsActivity;
import com.snov.traintracking.activities.NewsViewActivity;
import com.snov.traintracking.activities.PostNewsActivity;
import com.snov.traintracking.activities.SendMailActivity;
import com.snov.traintracking.activities.SharingActivity;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;

import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
import java.util.HashMap;
import java.util.Map;
import java.util.Timer;
import java.util.TimerTask;

public class PaymentActivity extends AppCompatActivity {

    //Braintree
    final String API_GET_TOKEN = "http://railway.sinhalafunnystories.com/railway_system/braintree/main.php";
    final String API_CHECKOUT = "http://railway.sinhalafunnystories.com/railway_system/braintree/checkout.php";

    String token,amount;
    HashMap<String,String> paramsHash;

    Button ButtonPay;
    TextView EditAmount;
    LinearLayout GroupWaiting, GroupPayment;

    private static final int REQUEST_CODE = 1234;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_payment);


        GroupWaiting = (LinearLayout)findViewById(R.id.waiting_group);
        GroupPayment = (LinearLayout)findViewById(R.id.payment_group);
        ButtonPay = (Button)findViewById(R.id.pay_button);


        EditAmount = (TextView)findViewById(R.id.edit_amount);
        EditAmount.setText(Config.TOTAL_TICKET_PRICE);

        new GetToken().execute();

        ButtonPay.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                SubmitPayment();
            }
        });

    }

    private void SubmitPayment() {
        DropInRequest dropInRequest = new DropInRequest().clientToken(token);
        startActivityForResult(dropInRequest.getIntent(this), REQUEST_CODE);
    }

    @Override
    protected void onActivityResult(int requestCode, int resultCode, Intent data) {
        if(requestCode==REQUEST_CODE){
            if(resultCode==RESULT_OK){
                DropInResult result = data.getParcelableExtra(DropInResult.EXTRA_DROP_IN_RESULT);
                PaymentMethodNonce nonce = result.getPaymentMethodNonce();
                String strNonce = nonce.getNonce();

                if(!EditAmount.getText().toString().isEmpty()){
                    amount = EditAmount.getText().toString();
                    paramsHash = new HashMap<>();
                    paramsHash.put("amount", amount);
                    paramsHash.put("nonce", strNonce);

                    sendPayments();
                }else{
                    Toast.makeText(this, "Amount Not valid", Toast.LENGTH_SHORT).show();
                }
            }else if(resultCode==RESULT_CANCELED){
                Toast.makeText(this, "User Cancel", Toast.LENGTH_SHORT).show();
            }else{
                Exception error = (Exception)data.getSerializableExtra(DropInActivity.EXTRA_ERROR);
                Log.d("Error", error.toString());
            }
        }
    }

    private void sendPayments() {
        RequestQueue requestQueue = Volley.newRequestQueue(PaymentActivity.this);

        StringRequest stringRequest = new StringRequest(Request.Method.POST, API_CHECKOUT,
                new Response.Listener<String>() {
                    @Override
                    public void onResponse(String response) {
                        Log.d("Done", response.toString());
                        if(response.toString().contains("Successful")){
                            Toast.makeText(PaymentActivity.this, "Transaction Successful.!", Toast.LENGTH_SHORT).show();
                            UpdateReservation();
                            Config.RESPONSE=token;
                            sendMessage();
                            Intent intent = new Intent(PaymentActivity.this, ReservationHomeActivity.class);
                            startActivity(intent);
//                            AlertDialog alertDialog = new AlertDialog.Builder(PaymentActivity.this).create();
//                            alertDialog.setTitle("Transaction Successfull");
//                            alertDialog.setMessage("Your ticket will be recived by an email.");
//                            alertDialog.setIcon(R.drawable.done);
//                            alertDialog.setButton(AlertDialog.BUTTON_POSITIVE, "OK",
//                                    new DialogInterface.OnClickListener() {
//                                        public void onClick(DialogInterface dialog, int which) {
//                                            Intent intent = new Intent(PaymentActivity.this, NewsActivity.class);
//                                            startActivity(intent);
//                                            finish();
//                                        }
//                                    });
//                            alertDialog.show();
                        }else{
                            Toast.makeText(PaymentActivity.this, "Transaction Failed.!", Toast.LENGTH_SHORT).show();
                            Intent intent = new Intent(PaymentActivity.this, ReservationHomeActivity.class);
                            startActivity(intent);

                        }
                        //Toast.makeText(PaymentActivity.this, response.toString(), Toast.LENGTH_LONG).show();
                    }
                }, new Response.ErrorListener() {
            @Override
            public void onErrorResponse(VolleyError error) {
                Log.d("Error", error.toString());
            }
        }){

            @Override
            protected Map<String, String> getParams() throws AuthFailureError {
                if (paramsHash == null)
                    return null;
                Map<String, String> params = new HashMap<>();
                for (String key : paramsHash.keySet()) {
                    params.put(key, paramsHash.get(key));
                }
                return params;
            }

            @Override
            public Map<String, String> getHeaders() throws AuthFailureError {
                Map<String,String> params = new HashMap<>();
                params.put("Content-Type", "application/x-www-form-urlencoded");
                return params;
            }
        };

        requestQueue.add(stringRequest);

    }




    public class GetToken extends AsyncTask{
        ProgressDialog mDialog;

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            mDialog = new ProgressDialog(PaymentActivity.this, android.R.style.Theme_DeviceDefault_Dialog);
            mDialog.setCancelable(false);
            mDialog.setMessage("Please Wait..");
            mDialog.show();
        }

        @Override
        protected Object doInBackground(Object[] objects) {
            HttpClient httpClient = new HttpClient();
            httpClient.get(API_GET_TOKEN, new HttpResponseCallback() {
                @Override
                public void success(final String responseBody) {
                    runOnUiThread(new Runnable() {
                        @Override
                        public void run() {
                            //Hide Group waiting
                            GroupWaiting.setVisibility(View.GONE);
                            //Show Group Payment
                            GroupPayment.setVisibility(View.VISIBLE);

                            //set Token
                            token = responseBody;
                        }
                    });
                }

                @Override
                public void failure(Exception exception) {
                    Log.d("Error", exception.toString());
                }
            });

            return null;
        }

        @Override
        protected void onPostExecute(Object o) {
            super.onPostExecute(o);
            mDialog.dismiss();
        }
    }

    public void UpdateReservation(){
        String Method = "update_temp";

        String UserID = Config.USER_EMAIL;

        UpdateTask updateTask = new UpdateTask(this);
        updateTask.execute(Method,UserID);
    }

    public class UpdateTask extends AsyncTask<String,Void,String> {

        Context context;


        UpdateTask(Context context){
            this.context = context;

        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected String doInBackground(String... params) {

            String TempReserveUrl = Constants.UPDATE_RESERVATION_URL;
            String LoginUrl = Constants.SERVER_URL;

            String method = params[0];
            if(method.equals("update_temp")){
                String UserID = params[1];

                try {
                    URL url = new URL(TempReserveUrl);
                    HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoOutput(true);
                    OutputStream OS = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(OS,"UTF-8"));

                    String data = URLEncoder.encode("user_id","UTF-8") + "=" + URLEncoder.encode(UserID,"UTF-8");

                    bufferedWriter.write(data);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    OS.close();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    inputStream.close();
                    return "Paid";
                } catch (MalformedURLException e) {
                    e.printStackTrace();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }

            return null;
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }

        @Override
        protected void onPostExecute(String result) {
            Toast.makeText(context,result,Toast.LENGTH_SHORT).show();

        }
    }

    String Ticket = "<html>\n" +
            "<head>\n" +
            "\t<title></title>\n" +
            "\t<link href=\"https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css\" rel=\"stylesheet\" type=\"text/css\" />\n" +
            "\t<link href=\"https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css\" rel=\"stylesheet\" type=\"text/css\" />\n" +
            "\t<link href=\"https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css\" rel=\"stylesheet\" type=\"text/css\" />\n" +
            "\t<link href=\"https://svc.webspellchecker.net/spellcheck31/lf/scayt3/ckscayt/css/wsc.css\" rel=\"stylesheet\" type=\"text/css\" />\n" +
            "</head>\n" +
            "<body aria-readonly=\"false\" style=\"cursor: auto;\">\n" +
            "<h1><u><span style=\"font-size:24px\"><strong>This is your ticket</strong></span></u></h1>\n" +
            "\n" +
            "<table border=\"1\" cellpadding=\"1\" cellspacing=\"1\" style=\"width:500px\">\n" +
            "\t<tbody>\n" +
            "\t\t<tr>\n" +
            "\t\t\t<td style=\"width:200px\">Train ID</td>\n" +
            "\t\t\t<td style=\"width:287px\">"+Config.SELECTED_TRAIN_ID+"</td>\n" +
            "\t\t</tr>\n" +
            "\t\t<tr>\n" +
            "\t\t\t<td style=\"width:200px\">Train Name</td>\n" +
            "\t\t\t<td style=\"width:287px\">"+Config.TRAIN_ID+"</td>\n" +
            "\t\t</tr>\n" +
            "\t\t<tr>\n" +
            "\t\t\t<td style=\"width:200px\">Start Station</td>\n" +
            "\t\t\t<td style=\"width:287px\">"+Config.START_STATION+"</td>\n" +
            "\t\t</tr>\n" +
            "\t\t<tr>\n" +
            "\t\t\t<td style=\"width:200px\">End Station</td>\n" +
            "\t\t\t<td style=\"width:287px\">"+Config.END_STATION+"</td>\n" +
            "\t\t</tr>\n" +
            "\t\t<tr>\n" +
            "\t\t\t<td style=\"width:200px\">Date | Arrival Time</td>\n" +
            "\t\t\t<td style=\"width:287px\">"+Config.RESERVATION_DATE+ " | " + Config.ARRIVAL_TIME+"</td>\n" +
            "\t\t</tr>\n" +
            "\t\t<tr>\n" +
            "\t\t\t<td style=\"width:200px\">Seat Numbers</td>\n" +
            "\t\t\t<td style=\"width:287px\">"+Config.SELECTED_SEATS+"</td>\n" +
            "\t\t</tr>\n" +
            "\t\t<tr>\n" +
            "\t\t\t<td style=\"width:200px\">Price</td>\n" +
            "\t\t\t<td style=\"width:287px\">"+Config.TOTAL_TICKET_PRICE+"</td>\n" +
            "\t\t</tr>\n" +
            "\t</tbody>\n" +
            "</table>\n" +
            "</body>\n" +
            "</html>\n";

    private void sendMessage() {

        Thread sender = new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    GMailSender sender = new GMailSender("ps4.snov@gmail.com", "0713631082");
                    sender.sendMail("Train Tracking & Reservation",
                            Ticket,
                            "ps4.snov@gmail.com",
                            Config.USER_EMAIL);

                } catch (Exception e) {
                    Log.e("mylog", "Error: " + e.getMessage());
                }
            }
        });
        sender.start();
    }

}