package com.snov.traintracking.activities.Reservation;

import android.content.Intent;
import android.os.Bundle;
import android.support.v7.app.AppCompatActivity;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.SharingActivity;
import com.snov.traintracking.utilities.Config;

public class PlaceOrderActivity extends AppCompatActivity {

    TextView ReservationDate;
    TextView ReservationClass;
    TextView ReservationUser;
    TextView ReservationTrain;
    TextView ReservationSeats;
    TextView ReservationPrice;

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



    }
}