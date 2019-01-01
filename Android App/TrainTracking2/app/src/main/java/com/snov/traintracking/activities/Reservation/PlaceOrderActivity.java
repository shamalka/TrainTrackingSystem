package com.snov.traintracking.activities.Reservation;

import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
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

public class PlaceOrderActivity extends AppCompatActivity {

    TextView ReservationDate;
    TextView ReservationClass;
    TextView ReservationUser;
    TextView ReservationTrain;
    TextView ReservationSeats;
    TextView ReservationPrice;

    String[] SeatsArray;
    Integer TotalTicketPrice;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_place_order);

        Button GoBack = (Button)findViewById(R.id.go_back);
        GoBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                DeleteTempReservation();
                Intent intent = new Intent(PlaceOrderActivity.this, SelectSeatsActivity.class);
                startActivity(intent);
            }
        });

        Toast.makeText(PlaceOrderActivity.this, "Selected Seats: " + Config.SELECTED_SEATS, Toast.LENGTH_LONG).show();

        ReservationDate = (TextView)findViewById(R.id.reservation_date);
        ReservationClass = (TextView)findViewById(R.id.reservation_class);
        ReservationUser = (TextView)findViewById(R.id.reservation_user);
        ReservationTrain = (TextView)findViewById(R.id.reservation_train);
        ReservationSeats = (TextView)findViewById(R.id.reservation_seats);
        ReservationPrice = (TextView)findViewById(R.id.reservation_price);

        ReservationDate.setText(Config.RESERVATION_DATE);
        ReservationClass.setText(Config.RESERVATION_CLASS);
        ReservationUser.setText(Config.USER_EMAIL);
        ReservationTrain.setText(Config.TRAIN_ID);
        ReservationSeats.setText(Config.SELECTED_SEATS);

        CalculateTotalTicketPrice();

        Button DeleteRecord = (Button)findViewById(R.id.delete_record);
        DeleteRecord.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {

            }
        });



    }

    public void CalculateTotalTicketPrice(){
        SeatsArray=Config.SELECTED_SEATS.split(",");
        Toast.makeText(PlaceOrderActivity.this, "Selected Seats: " + SeatsArray.length, Toast.LENGTH_LONG).show();
        TotalTicketPrice = (SeatsArray.length)*Integer.parseInt(Config.SELECTED_TICKET_PRICE);
        ReservationPrice.setText(TotalTicketPrice.toString());
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        DeleteTempReservation();
        Intent intent = new Intent(PlaceOrderActivity.this, SelectSeatsActivity.class);
        startActivity(intent);
    }

    public void DeleteTempReservation(){

        String Method = "delete_temp";

        String UserID = Config.USER_EMAIL;

        DeleteTask deleteTask = new DeleteTask(this);
        deleteTask.execute(Method,UserID);

    }

    public class DeleteTask extends AsyncTask<String,Void,String> {

        Context context;


        DeleteTask(Context context){
            this.context = context;

        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected String doInBackground(String... params) {

            String TempReserveUrl = Constants.DELETE_TEMP_RESERVATION_URL;
            String LoginUrl = Constants.SERVER_URL;

            String method = params[0];
            if(method.equals("delete_temp")){
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
                    return "Succesful..!!";
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
}