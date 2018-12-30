package com.snov.traintracking.activities.Reservation;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.SharingActivity;
import com.snov.traintracking.utilities.Config;

public class PlaceOrderActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_place_order);

        Button GoBack = (Button)findViewById(R.id.go_back);
        GoBack.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Intent intent = new Intent(PlaceOrderActivity.this, SelectSeatsActivity.class);
                startActivity(intent);
            }
        });

        Toast.makeText(PlaceOrderActivity.this, "Selected Seats: " + Config.SELECTED_SEATS, Toast.LENGTH_LONG).show();
    }
}