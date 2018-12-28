package com.snov.traintracking.activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.ImageButton;
import android.widget.TextView;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.Reservation.ReservationActivity;
import com.snov.traintracking.utilities.Config;

public class MainActivity extends AppCompatActivity {


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
        if(Config.CHECK_LOGIN=="0"){
            LoggedIn.setText("Login Here");
            LoggedIn.setOnClickListener(new View.OnClickListener() {
                public void onClick(View v) {
                    // Perform action on click
                    Intent intent = new Intent(MainActivity.this, LoginActivity.class);
                    startActivity(intent);
                }
            });
        }else{
            LoggedIn.setText("Log Out");
            LoggedIn.setOnClickListener(new View.OnClickListener() {
                public void onClick(View v) {
                    Config.CHECK_LOGIN="0";
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
                Intent intent = new Intent(MainActivity.this, ReservationActivity.class);
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
                Intent intent = new Intent(MainActivity.this, TrainListActivity.class);
                startActivity(intent);
            }
        });



    }
}
