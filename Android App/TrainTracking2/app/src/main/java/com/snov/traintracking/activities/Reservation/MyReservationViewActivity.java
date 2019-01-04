package com.snov.traintracking.activities.Reservation;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.widget.TextView;

import com.snov.traintracking.R;
import com.snov.traintracking.utilities.Config;

public class MyReservationViewActivity extends AppCompatActivity {

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_reservation_view);

        TextView StartStation = (TextView)findViewById(R.id.my_start);
        TextView EndStation = (TextView)findViewById(R.id.my_end);
        TextView TrainID = (TextView)findViewById(R.id.my_train);
        TextView Date = (TextView)findViewById(R.id.my_date);

        StartStation.setText(Config.MY_START_STATION);
        EndStation.setText(Config.MY_END_STATION);
        TrainID.setText(Config.MY_TRAIN_ID);
        Date.setText(Config.MY_DATE);
    }
}
