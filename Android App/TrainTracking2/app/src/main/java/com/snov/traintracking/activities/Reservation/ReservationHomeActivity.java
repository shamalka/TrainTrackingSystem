package com.snov.traintracking.activities.Reservation;

import android.content.Intent;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.LoginActivity;
import com.snov.traintracking.utilities.Config;

public class ReservationHomeActivity extends AppCompatActivity {

    Button NewBooking;
    Button MyBookings;
    Button CancelBookings;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reservation_menu);

        NewBooking = (Button)findViewById(R.id.new_booking);
        MyBookings = (Button)findViewById(R.id.my_bookings);
        CancelBookings = (Button)findViewById(R.id.cancel_bookings);

        NewBooking.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Config.CHECK_LOGIN.equals("1")){
                    Intent intent = new Intent(ReservationHomeActivity.this, ReservationActivity.class);
                    startActivity(intent);
                }else{
                    Intent intent = new Intent(ReservationHomeActivity.this, LoginActivity.class);
                    startActivity(intent);
                }

            }
        });

        MyBookings.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                if(Config.CHECK_LOGIN.equals("1")){
                    Intent intent = new Intent(ReservationHomeActivity.this, MyReservationsActivity.class);
                    startActivity(intent);
                }else{
                    Intent intent = new Intent(ReservationHomeActivity.this, LoginActivity.class);
                    startActivity(intent);
                }

            }
        });

    }
}
