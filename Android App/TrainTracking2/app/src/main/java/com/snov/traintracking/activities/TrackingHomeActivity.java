package com.snov.traintracking.activities;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.view.View;
import android.widget.Button;

import com.snov.traintracking.R;
import com.snov.traintracking.utilities.Config;

public class TrackingHomeActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_tracking_home);

        CardView ShareTrain = (CardView)findViewById(R.id.share_train);
        CardView ViewTrain = (CardView)findViewById(R.id.view_train);

        ShareTrain.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Config.CHECK_TRAIN_LIST_REQUEST="0";
                // Perform action on click
                Intent intent = new Intent(TrackingHomeActivity.this, SelectStationsActivity.class);
                startActivity(intent);
            }
        });

        ViewTrain.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                Config.CHECK_TRAIN_LIST_REQUEST="1";
                // Perform action on click
                Intent intent = new Intent(TrackingHomeActivity.this, SelectStationsActivity.class);
                startActivity(intent);
            }
        });


    }
}
