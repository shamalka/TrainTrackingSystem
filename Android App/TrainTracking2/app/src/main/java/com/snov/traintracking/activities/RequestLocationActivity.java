package com.snov.traintracking.activities;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.widget.Button;
import android.widget.TextView;
import android.widget.Toast;

import com.firebase.client.DataSnapshot;
import com.firebase.client.Firebase;
import com.firebase.client.FirebaseError;
import com.firebase.client.ValueEventListener;
import com.google.android.gms.maps.CameraUpdateFactory;
import com.google.android.gms.maps.model.BitmapDescriptorFactory;
import com.google.android.gms.maps.model.LatLng;
import com.google.android.gms.maps.model.MarkerOptions;
import com.snov.traintracking.R;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;

public class RequestLocationActivity extends AppCompatActivity {

    private Firebase RequestRef;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_request_location);

        Firebase.setAndroidContext(this);

        RequestRef = new Firebase("https://train-tracking-app.firebaseio.com/"+ Config.SELECTED_TRAIN_ID +"/Requested");

        final Button Request = (Button)findViewById(R.id.Request);
        Request.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                RequestRef.setValue(true);
            }
        });

        TextView RequestText = (TextView)findViewById(R.id.Request_txt);
        GetFirebaseData(RequestRef,RequestText,Config.SELECTED_TRAIN_ID+"/Requested");

    }

    public void GetFirebaseData(Firebase mRef, final TextView textView, final String path){
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
}
