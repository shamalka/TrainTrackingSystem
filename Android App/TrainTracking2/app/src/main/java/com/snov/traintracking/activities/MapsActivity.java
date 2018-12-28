package com.snov.traintracking.activities;

import android.annotation.TargetApi;
import android.app.Notification;
import android.app.NotificationManager;
import android.app.PendingIntent;
import android.content.Context;
import android.content.Intent;
import android.graphics.Color;
import android.location.Location;
import android.os.Build;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v4.app.FragmentActivity;
import android.os.Bundle;
import android.text.Editable;
import android.text.TextWatcher;
import android.util.Log;
import android.widget.TextView;
import android.widget.Toast;

import com.firebase.client.DataSnapshot;
import com.firebase.client.Firebase;
import com.firebase.client.FirebaseError;
import com.firebase.client.ValueEventListener;
import com.firebase.geofire.GeoFire;
import com.firebase.geofire.GeoLocation;
import com.firebase.geofire.GeoQuery;
import com.firebase.geofire.GeoQueryEventListener;
import com.google.android.gms.common.ConnectionResult;
import com.google.android.gms.common.api.GoogleApiClient;
import com.google.android.gms.location.LocationListener;
import com.google.android.gms.location.LocationRequest;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.GoogleMap;
import com.google.android.gms.maps.OnMapReadyCallback;
import com.google.android.gms.maps.SupportMapFragment;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.Circle;
import com.google.android.gms.maps.model.CircleOptions;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.Marker;
import com.google.android.gms.maps.model.MarkerOptions;
import com.google.firebase.database.DatabaseError;
import com.snov.traintracking.R;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;

import java.util.Random;

public class MapsActivity extends FragmentActivity implements OnMapReadyCallback, GoogleApiClient.ConnectionCallbacks, GoogleApiClient.OnConnectionFailedListener, LocationListener {

    private GoogleMap mMap;
    GoogleApiClient mGoogleApiClient;
    Location mLastLocation;
    LocationRequest mLocationRequest;
    float lati;
    float longi;
    LatLng sydney;

    TextView latitxt;
    TextView longtxt;

    private Firebase RefLat;
    private Firebase RefLong;

    public double latt;
    public double longg;

    Marker myMarker;

    GeoFire geoFire;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_maps);
        // Obtain the SupportMapFragment and get notified when the map is ready to be used.
        SupportMapFragment mapFragment = (SupportMapFragment) getSupportFragmentManager()
                .findFragmentById(R.id.map);
        mapFragment.getMapAsync(this);



        Toast.makeText(MapsActivity.this, Config.TRAIN_ID , Toast.LENGTH_SHORT).show();

        latitxt = (TextView)findViewById(R.id.lati_t);
        longtxt = (TextView)findViewById(R.id.longi_t);

        Firebase.setAndroidContext(this);

        GetFirebaseData(RefLat, latitxt, Config.JSON_PATH + "/Latitude");
        //GetFirebaseData(RefLong, longtxt, Config.JSON_PATH + "/Longitude");

//        lati = Float.parseFloat((String) latitxt.getText());
//        longi = Float.parseFloat((String) longtxt.getText());
//
//        latt = Double.parseDouble((String) latitxt.getText());
//        longg = Double.parseDouble((String) longtxt.getText());



        latitxt.addTextChangedListener(new TextWatcher() {
            @Override
            public void beforeTextChanged(CharSequence charSequence, int i, int i1, int i2) {

            }

            @Override
            public void onTextChanged(CharSequence charSequence, int i, int i1, int i2) {
//                sydney = new LatLng(lati, longi);
//
//                mMap.addMarker(new MarkerOptions().position(sydney).title("Marker in Sydney"));
//
//                latt = Double.parseDouble((String) latitxt.getText());
//                longg = Double.parseDouble((String) longtxt.getText());
//
//





            }

            @Override
            public void afterTextChanged(Editable editable) {

            }
        });



//        String latitudeString = (String) latitxt.getText();
//        String longitudeString = (String) longtxt.getText();

        //Toast.makeText(MapsActivity.this, latitudeString + " " + longi , Toast.LENGTH_SHORT).show();


    }


    /**
     * Manipulates the map once available.
     * This callback is triggered when the map is ready to be used.
     * This is where we can add markers or lines, add listeners or move the camera. In this case,
     * we just add a marker near Sydney, Australia.
     * If Google Play services is not installed on the device, the user will be prompted to install
     * it inside the SupportMapFragment. This method will only be triggered once the user has
     * installed Google Play services and returned to the app.
     */
    @Override
    public void onMapReady(GoogleMap googleMap) {

        mMap = googleMap;

        LatLng InvalidArea = new LatLng(6.738947,79.9734234);
        mMap.addCircle(new CircleOptions()
                    .center(InvalidArea)
                    .radius(30000)
                    .strokeColor(Color.BLUE)
                    .fillColor(0x22000FF)
                    .strokeWidth(5.0f)
        );

//        GeoQuery geoQuery = geoFire.queryAtLocation(new GeoLocation(InvalidArea.latitude,InvalidArea.longitude), 0.5f);
//        geoQuery.addGeoQueryEventListener(new GeoQueryEventListener() {
//            @Override
//            public void onKeyEntered(String key, GeoLocation location) {
//                SendNotification("Train Tracking App", String.format("%s Invalid Location"),key);
//            }
//
//            @Override
//            public void onKeyExited(String key) {
//
//            }
//
//            @Override
//            public void onKeyMoved(String key, GeoLocation location) {
//
//            }
//
//            @Override
//            public void onGeoQueryReady() {
//
//            }
//
//            @Override
//            public void onGeoQueryError(DatabaseError error) {
//
//            }
//        });

//        Circle circle = mMap.addCircle(new CircleOptions()
//                .center(new LatLng(6, 79))
//                .radius(10000)
//                .strokeColor(Color.RED)
//                .fillColor(Color.BLUE));

        // Add a marker in Sydney and move the camera
//        sydney = new LatLng(8.552161651991246, 79.94052328405958);
//
//        mMap.addMarker(new MarkerOptions().position(sydney).title("Marker in Sydney"));
//        mMap.moveCamera(CameraUpdateFactory.newLatLng(sydney));



        //mMap.setMinZoomPreference(11);





    }

    @TargetApi(Build.VERSION_CODES.M)
    private void SendNotification(String title, String content, String key) {
        Notification.Builder builder = new Notification.Builder(this)
                .setSmallIcon(R.mipmap.ic_launcher)
                .setContentTitle(title)
                .setContentText(content);
        NotificationManager notificationManager = (NotificationManager)this.getSystemService(Context.NOTIFICATION_SERVICE);
        Intent intent = new Intent(this,MapsActivity.class);
        PendingIntent contentIntent = PendingIntent.getActivity(this,0,intent,PendingIntent.FLAG_IMMUTABLE);
        builder.setContentIntent(contentIntent);
        Notification notification = builder.build();


        notificationManager.notify(new Random().nextInt(),notification);

    }


    @Override
    public void onConnected(@Nullable Bundle bundle) {
        mLocationRequest = new LocationRequest();
        mLocationRequest.setInterval(1000);
        mLocationRequest.setFastestInterval(1000);
        mLocationRequest.setPriority(LocationRequest.PRIORITY_HIGH_ACCURACY);


    }

    @Override
    public void onConnectionSuspended(int i) {

    }

    @Override
    public void onLocationChanged(Location location) {
        lati = Float.parseFloat((String) latitxt.getText());
        longi = Float.parseFloat((String) longtxt.getText());
        //mMap.clear();
        UpdateMap();


    }


    //Retrieve realtime data from firebase and set them into textview
    public void GetFirebaseData(Firebase mRef, final TextView textView, final String path){
        try {

            mRef = new Firebase(Constants.FIREBASE_DATABASE_URL + path);

            mRef.addValueEventListener(new ValueEventListener() {
                @Override
                public void onDataChange(DataSnapshot dataSnapshot) {
                    String value = dataSnapshot.getValue(String.class);
                    textView.setText(value);

                    String[] locationArray = value.split(",");
//
                    double latiDouble = Double.parseDouble(locationArray[0]);
                    double lngDouble = Double.parseDouble(locationArray[1]);

                      Toast.makeText(MapsActivity.this,  locationArray[0] , Toast.LENGTH_SHORT).show();

                    LatLng latlng = new LatLng(latiDouble, lngDouble);

                    MarkerOptions MapMarker = new MarkerOptions().position(latlng).title("Marker in Sydney");
                    MapMarker.icon(BitmapDescriptorFactory.fromResource(R.drawable.train_marker));
                    mMap.addMarker(MapMarker);
                    mMap.moveCamera(CameraUpdateFactory.newLatLng(latlng));



                }

                @Override
                public void onCancelled(FirebaseError firebaseError) {

                }
            });

        }catch(Exception e){
            e.printStackTrace();

        }
    }



    @Override
    public void onConnectionFailed(@NonNull ConnectionResult connectionResult) {

    }




    private void UpdateMap(){
        //Toast.makeText(MapsActivity.this, lati + " " + longi, Toast.LENGTH_SHORT).show();
        Log.d("data", lati + " " + longi );
//        sydney = new LatLng(lati, longi);
//        mMap.addMarker(new MarkerOptions().position(sydney).title("Marker in Sydney"));
//        mMap.moveCamera(CameraUpdateFactory.newLatLng(sydney));
    }


}
