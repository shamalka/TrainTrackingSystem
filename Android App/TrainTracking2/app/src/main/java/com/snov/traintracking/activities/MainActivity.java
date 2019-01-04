package com.snov.traintracking.activities;

import android.content.Intent;
import android.content.SharedPreferences;
import android.os.CpuUsageInfo;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.Reservation.PaymentActivity;
import com.snov.traintracking.activities.Reservation.ReservationActivity;
import com.snov.traintracking.activities.Reservation.ReservationHomeActivity;
import com.snov.traintracking.activities.Reservation.SelectSeatsActivity;
import com.snov.traintracking.utilities.Config;

public class MainActivity extends AppCompatActivity {

    String LoginStatus;
    String UserEmail;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_main);
        //System.out.println("Test01");

        //Home UI Routing
        ImageButton TrackingCard = (ImageButton)findViewById(R.id.TrainTrackingView);
        ImageButton ReservationCard = (ImageButton)findViewById(R.id.ReservationView);
        ImageButton NewsCard = (ImageButton)findViewById(R.id.NewsFeedView);
        ImageButton FeedbackCard = (ImageButton)findViewById(R.id.FeedbackView);

        TextView LoggedIn = (TextView)findViewById(R.id.logged_in);

        SharedPreferences sharedPreferences = getSharedPreferences(Config.SHARED_PREFS, MODE_PRIVATE);
        LoginStatus = sharedPreferences.getString(Config.CHECK_LOGIN_PREFS, "0");
        UserEmail = sharedPreferences.getString(Config.USER_EMAIL_PREFS, "");
        Toast.makeText(MainActivity.this, "Login Status: " + LoginStatus, Toast.LENGTH_SHORT).show();
        Toast.makeText(MainActivity.this, "Email: " + UserEmail, Toast.LENGTH_SHORT).show();

        //Check login status using shared preferences and then assign status and user email to two normal static variables.
        //Because now its easy to call the normal variables rather than calling shared prefs every time
        if(LoginStatus.equals("0")){
            Config.CHECK_LOGIN="0";
            Config.USER_EMAIL = UserEmail;
            LoggedIn.setText("Login Here");
            LoggedIn.setOnClickListener(new View.OnClickListener() {
                public void onClick(View v) {
                    // Perform action on click
                    Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                    startActivity(intent);
                }
            });
        }else{
            Config.CHECK_LOGIN="1";
            Config.USER_EMAIL = UserEmail;
            LoggedIn.setText("Log Out");
            LoggedIn.setOnClickListener(new View.OnClickListener() {
                public void onClick(View v) {
                    SetSharedPref("0","");
                    Intent intent = new Intent(MainActivity.this, MainActivity.class);
                    startActivity(intent);
                }
            });
        }

        TrackingCard.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                // Perform action on click
                Intent intent = new Intent(MainActivity.this, TrackingHomeActivity.class);
                startActivity(intent);
            }
        });

        ReservationCard.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                // Perform action on click
                Intent intent = new Intent(MainActivity.this, ReservationHomeActivity.class);
                startActivity(intent);
            }
        });

        NewsCard.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                // Perform action on click
                Intent intent = new Intent(MainActivity.this, NewsActivity.class);
                startActivity(intent);
            }
        });

        FeedbackCard.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                // Perform action on click
                Intent intent = new Intent(MainActivity.this, NewsViewActivity.class);
                startActivity(intent);
            }
        });



    }

    public void SetSharedPref(String Flag, String Email){
        SharedPreferences sharedPreferences = getSharedPreferences(Config.SHARED_PREFS, MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putString(Config.CHECK_LOGIN_PREFS, Flag);
        editor.putString(Config.USER_EMAIL_PREFS, Email);
        editor.commit();
    }
}
