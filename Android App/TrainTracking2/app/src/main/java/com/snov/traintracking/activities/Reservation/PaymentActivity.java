package com.snov.traintracking.activities.Reservation;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.os.CountDownTimer;
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
import com.snov.traintracking.activities.MainActivity;
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
    EditText EditAmount;
    LinearLayout GroupWaiting, GroupPayment;

    private static final int REQUEST_CODE = 1234;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_payment);


        GroupWaiting = (LinearLayout)findViewById(R.id.waiting_group);
        GroupPayment = (LinearLayout)findViewById(R.id.payment_group);
        ButtonPay = (Button)findViewById(R.id.pay_button);


        EditAmount = (EditText)findViewById(R.id.edit_amount);
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

                        }else{
                            Toast.makeText(PaymentActivity.this, "Transaction Failed.!", Toast.LENGTH_SHORT).show();

                        }
                        Toast.makeText(PaymentActivity.this, response.toString(), Toast.LENGTH_LONG).show();
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
}