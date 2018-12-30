package com.snov.traintracking.activities.Reservation;

import android.annotation.TargetApi;
import android.app.DatePickerDialog;
import android.content.Intent;
import android.icu.util.Calendar;
import android.os.Build;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.DatePicker;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.SharingTrainListActivity;
import com.snov.traintracking.activities.TrackingTrainListActivity;
import com.snov.traintracking.activities.TrainListActivity;
import com.snov.traintracking.utilities.Config;

public class ReservationActivity extends AppCompatActivity {

    Calendar calender;
    DatePickerDialog Datepickerdialog;

    Button SelectDate;
    TextView DateText;
    TextView ClassText;

    @TargetApi(Build.VERSION_CODES.N)
    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_reservation);

        Config.CHECK_TRAIN_LIST_REQUEST="2";

        ClassText = (TextView)findViewById(R.id.class_text);

        Spinner StartStationDropDown = (Spinner) findViewById(R.id.Start_Station_DropDown);
        // Create an ArrayAdapter using the string array and a default spinner
        ArrayAdapter<CharSequence> StartAdapter = ArrayAdapter
                .createFromResource(this, R.array.Start_Station_Array,
                        android.R.layout.simple_spinner_item);
        // Specify the layout to use when the list of choices appears
        StartAdapter
                .setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        // Apply the adapter to the spinner
        StartStationDropDown.setAdapter(StartAdapter);

        StartStationDropDown.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view,
                                       int position, long id) {
                //Log.v("item", (String) parent.getItemAtPosition(position));
                Toast.makeText(ReservationActivity.this, "Item " + (String) parent.getItemAtPosition(position), Toast.LENGTH_SHORT).show();
                Config.START_STATION=(String) parent.getItemAtPosition(position);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                // TODO Auto-generated method stub
            }
        });


        Spinner EndStationDropDown = (Spinner) findViewById(R.id.End_Station_DropDown);
        // Create an ArrayAdapter using the string array and a default spinner
        ArrayAdapter<CharSequence> EndAdapter = ArrayAdapter
                .createFromResource(this, R.array.End_Station_Array,
                        android.R.layout.simple_spinner_item);
        // Specify the layout to use when the list of choices appears
        EndAdapter
                .setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        // Apply the adapter to the spinner
        EndStationDropDown.setAdapter(EndAdapter);

        EndStationDropDown.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view,
                                       int position, long id) {
                //Log.v("item", (String) parent.getItemAtPosition(position));
                Toast.makeText(ReservationActivity.this, "Item " + (String) parent.getItemAtPosition(position), Toast.LENGTH_SHORT).show();
                Config.END_STATION=(String) parent.getItemAtPosition(position);
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                // TODO Auto-generated method stub
            }
        });


        Spinner SelectClassDropDown = (Spinner) findViewById(R.id.select_class_dropdown);
        // Create an ArrayAdapter using the string array and a default spinner
        ArrayAdapter<CharSequence> ClassAdapter = ArrayAdapter
                .createFromResource(this, R.array.Class_Array,
                        android.R.layout.simple_spinner_item);
        // Specify the layout to use when the list of choices appears
        ClassAdapter
                .setDropDownViewResource(android.R.layout.simple_spinner_dropdown_item);
        // Apply the adapter to the spinner
        SelectClassDropDown.setAdapter(ClassAdapter);

        SelectClassDropDown.setOnItemSelectedListener(new AdapterView.OnItemSelectedListener() {
            @Override
            public void onItemSelected(AdapterView<?> parent, View view,
                                       int position, long id) {
                //Log.v("item", (String) parent.getItemAtPosition(position));
                ClassText.setText((String) parent.getItemAtPosition(position));
                Config.RESERVATION_CLASS = ClassText.getText().toString();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                // TODO Auto-generated method stub
            }
        });

        CardView SearchTrain = (CardView)findViewById(R.id.search_train);
        SearchTrain.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {


                Intent intent = new Intent(ReservationActivity.this, TrainListActivity.class);
                startActivity(intent);

            }
        });

        SelectDate = (Button)findViewById(R.id.select_date);
        DateText = (TextView) findViewById(R.id.date_text);

//        if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.JELLY_BEAN) {
//            calender.set(2018, 11, 14);
//        }

        SelectDate.setOnClickListener(new View.OnClickListener() {

            @TargetApi(Build.VERSION_CODES.N)
            @Override
            public void onClick(View view) {

                if (Build.VERSION.SDK_INT >= Build.VERSION_CODES.JELLY_BEAN) {
                    calender = Calendar.getInstance();
                }

                int Day = calender.get(Calendar.DAY_OF_MONTH);
                int Month = calender.get(Calendar.MONTH);
                int Year = calender.get(Calendar.YEAR);

                Datepickerdialog = new DatePickerDialog(ReservationActivity.this, new DatePickerDialog.OnDateSetListener() {
                    @Override
                    public void onDateSet(DatePicker datePicker, int day, int month, int year) {
                        DateText.setText(day + "/" + (month+1) + "/" + year);
                        Config.RESERVATION_DATE=DateText.getText().toString();
                    }
                },Day , Month , Year);
                Datepickerdialog.getDatePicker().setMinDate(System.currentTimeMillis() - 1000);
                Datepickerdialog.show();
            }
        });


    }


}
