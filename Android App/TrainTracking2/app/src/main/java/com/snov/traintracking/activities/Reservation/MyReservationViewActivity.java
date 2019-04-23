package com.snov.traintracking.activities.Reservation;

import android.content.Context;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
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

public class MyReservationViewActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_reservation_view);

        TextView StartStation = (TextView)findViewById(R.id.reservation_start_my);
        TextView EndStation = (TextView)findViewById(R.id.reservation_end_my);
        TextView TrainID = (TextView)findViewById(R.id.reservation_train_my);
        TextView Date = (TextView)findViewById(R.id.reservation_date_my);
        TextView ArrivelTime = (TextView)findViewById(R.id.reservation_time_my);
        TextView Seats = (TextView)findViewById(R.id.reservation_seats_my);
        TextView Price = (TextView)findViewById(R.id.reservation_price_my);
        TextView UserID = (TextView)findViewById(R.id.reservation_user_my);

        Button CancelButton = (Button)findViewById(R.id.cancelation_button);

        StartStation.setText(Config.MY_START_STATION);
        EndStation.setText(Config.MY_END_STATION);
        TrainID.setText(Config.MY_TRAIN_ID);
        Date.setText(Config.MY_DATE);
        ArrivelTime.setText(Config.MY_TIME);
        Seats.setText(Config.MY_SEAT_NUMBERS);
        Price.setText(Config.MY_PRICE);
        UserID.setText(Config.MY_RESERVATION_ID);

        CancelButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                CancelReservation();
            }
        });
        //Toast.makeText(MyReservationViewActivity.this,Config.MY_RESERVATION_ID,Toast.LENGTH_SHORT).show();
    }

    public void CancelReservation(){
        String Method = "cancel_reservation";

        String Reservation_ID = Config.MY_RESERVATION_ID;

        CancelTask cancelTask = new CancelTask(this);
        cancelTask.execute(Method,Reservation_ID);
    }

    public class CancelTask extends AsyncTask<String,Void,String> {

        Context context;


        CancelTask(Context context){
            this.context = context;

        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected String doInBackground(String... params) {

            String CancelURL = Constants.CANCEL_RESERVATION;
            String LoginUrl = Constants.SERVER_URL;

            String method = params[0];
            if(method.equals("cancel_reservation")){
                String Reservation_ID = params[1];

                try {
                    URL url = new URL(CancelURL);
                    HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoOutput(true);
                    OutputStream OS = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(OS,"UTF-8"));

                    String data = URLEncoder.encode("reservation_id","UTF-8") + "=" + URLEncoder.encode(Reservation_ID,"UTF-8");

                    bufferedWriter.write(data);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    OS.close();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    inputStream.close();
                    return "Cancelation Request Sent";
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
