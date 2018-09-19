package com.snov.traintracking.activities;

import android.Manifest;
import android.content.Intent;
import android.content.pm.PackageManager;
import android.graphics.BitmapFactory;
import android.graphics.Color;
import android.location.Location;
import android.location.LocationManager;
import android.os.AsyncTask;
import android.os.Build;
import android.provider.Settings;
import android.support.v4.app.ActivityCompat;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.text.TextWatcher;
import android.view.View;
import android.widget.AdapterView;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.Spinner;
import android.widget.TextView;
import android.widget.Toast;

import com.firebase.client.DataSnapshot;
import com.firebase.client.Firebase;
import com.firebase.client.FirebaseError;
import com.firebase.client.ValueEventListener;

import android.location.LocationListener;

import com.snov.traintracking.R;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;

import br.com.simplepass.loading_button_lib.customViews.CircularProgressButton;

public class SharingActivity extends AppCompatActivity {

    public static TextView Latitude;
    public static TextView Longitude;
    TextView LocationData;

    private Firebase RefLat;
    private Firebase RefLong;

    private Firebase SendRefLatitude;
    private Firebase SendRefLongitude;

    private Button SendData;
    private CardView ShareLocation;

    private LocationManager locationManager;
    private LocationListener locationListener;

    CircularProgressButton ShareLoadingButton;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sharing);

        Toast.makeText(SharingActivity.this, Config.TRAIN_ID , Toast.LENGTH_SHORT).show();


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
                Toast.makeText(SharingActivity.this, "Item " + (String) parent.getItemAtPosition(position), Toast.LENGTH_SHORT).show();
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
                Toast.makeText(SharingActivity.this, "Item " + (String) parent.getItemAtPosition(position), Toast.LENGTH_SHORT).show();
            }

            @Override
            public void onNothingSelected(AdapterView<?> parent) {
                // TODO Auto-generated method stub
            }
        });

        Firebase.setAndroidContext(this);

        Latitude = (TextView) findViewById(R.id.latitude);
        Longitude = (TextView) findViewById(R.id.longitude);
        LocationData = (TextView) findViewById(R.id.location_data);

        GetFirebaseData(RefLat, Latitude, Config.JSON_PATH + "/Latitude");
        GetFirebaseData(RefLong, Longitude, Config.JSON_PATH + "/Longitude");

        //Toast.makeText(SharingActivity.this, Constants.FIREBASE_DATABASE_URL + Config.JSON_PATH + "/Latitude" , Toast.LENGTH_SHORT).show();

        SendData = (Button) findViewById(R.id.send_button);

        SendRefLatitude = new Firebase("https://train-tracking-app.firebaseio.com/" + Config.JSON_PATH + "/Latitude");
        SendRefLongitude = new Firebase("https://train-tracking-app.firebaseio.com/" + Config.JSON_PATH + "/Longitude");
//        SendData.setOnClickListener(new View.OnClickListener() {
//            public void onClick(View v) {
//                SendRefLatitude.setValue("This is Latitude");
//            }
//        });

        //RequestPermission();


        ShareLoadingButton = (CircularProgressButton)findViewById(R.id.share_loading_button);
        ShareLocation = (CardView) findViewById(R.id.share_location);
        LocationData = (TextView) findViewById(R.id.location_data);

        //get device location coodinates and send them to firebase
        locationManager = (LocationManager) getSystemService(LOCATION_SERVICE);
        locationListener = new LocationListener() {
            @Override
            public void onLocationChanged(Location location) {
                LocationData.setText(location.getLatitude() + " " + location.getLongitude());
                SendRefLatitude.setValue(location.getLatitude() + "," + location.getLongitude());
                SendRefLongitude.setValue(location.getLongitude());
            }

            @Override
            public void onStatusChanged(String s, int i, Bundle bundle) {

            }

            @Override
            public void onProviderEnabled(String s) {

            }

            @Override
            public void onProviderDisabled(String s){
                Intent intent = new Intent(Settings.ACTION_LOCATION_SOURCE_SETTINGS);
                startActivity(intent);
            }
        };
        configureButton();

        if(Build.VERSION.SDK_INT>=Build.VERSION_CODES.M){
            if (ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_FINE_LOCATION) != PackageManager.PERMISSION_GRANTED && ActivityCompat.checkSelfPermission(this, Manifest.permission.ACCESS_COARSE_LOCATION) != PackageManager.PERMISSION_GRANTED) {
                configureButton();
                requestPermissions(new String[]{
                        Manifest.permission.ACCESS_FINE_LOCATION, Manifest.permission.ACCESS_COARSE_LOCATION,
                        Manifest.permission.INTERNET
                }, 10);

                return;

            }
        }else{
            configureButton();
        }

        CardView StopSharing = (CardView) findViewById(R.id.stop_sharing);
        StopSharing.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                locationManager.removeUpdates(locationListener);
            }
        });

    }

    @Override
    public void onRequestPermissionsResult(int requestCode, String[] permissions, int[] grantResults){
        switch(requestCode){
            case 10:
                if(grantResults.length>0 && grantResults[0] == PackageManager.PERMISSION_GRANTED)
                    configureButton();
                return;
        }
    }

    private void configureButton(){

        


        ShareLocation.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                try {
                    //Toast.makeText(SharingActivity.this, "Show Location", Toast.LENGTH_SHORT).show();
                    locationManager.requestLocationUpdates("gps",1000,0,locationListener);
                }catch(Exception e){
                    e.printStackTrace();
                }
                Intent intent = new Intent(SharingActivity.this, MapsActivity.class);
                startActivity(intent);

            }
        });

    }

//    private void RequestPermission(){
//        ActivityCompat.requestPermissions(this, new String[]{android.Manifest.permission.ACCESS_FINE_LOCATION}, 1);
//    }

    public void GetFirebaseData(Firebase mRef, final TextView textView, String path){
        try {

            mRef = new Firebase(Constants.FIREBASE_DATABASE_URL + path);

            mRef.addValueEventListener(new ValueEventListener() {
                @Override
                public void onDataChange(DataSnapshot dataSnapshot) {
                    String value = dataSnapshot.getValue(String.class);
                    textView.setText(value);
                }

                @Override
                public void onCancelled(FirebaseError firebaseError) {

                }
            });

        }catch(Exception e){
            e.printStackTrace();

        }
    }

//    @Override
//    public void onBackPressed() {
//        locationManager.removeUpdates(locationListener);
//        finish();
//    }
}
