package com.snov.traintracking.activities;

import android.app.IntentService;
import android.content.Intent;
import android.support.annotation.Nullable;
import android.text.TextUtils;
import android.widget.Toast;

import com.google.android.gms.location.Geofence;
import com.google.android.gms.location.GeofencingEvent;

import java.util.ArrayList;
import java.util.List;

public class GeofenceTransitionService extends IntentService {



    public GeofenceTransitionService(String name) {
        super(name);
    }

    @Override
    protected void onHandleIntent(@Nullable Intent intent) {
        GeofencingEvent geofencingEvent = GeofencingEvent.fromIntent(intent);

        if(geofencingEvent.hasError()){
            String error = String.valueOf(geofencingEvent.getErrorCode());
            Toast.makeText(getApplicationContext(), "Error Code = " + error, Toast.LENGTH_SHORT).show();
            return;
        }

        int geofenceTransition = geofencingEvent.getGeofenceTransition();

        if(geofenceTransition == Geofence.GEOFENCE_TRANSITION_ENTER || geofenceTransition == Geofence.GEOFENCE_TRANSITION_EXIT){
            List<Geofence> triggeringGeofence = geofencingEvent.getTriggeringGeofences();

            String geoTransDetails = getGeofenceTransitionDetails(geofenceTransition, triggeringGeofence);
            Toast.makeText(GeofenceTransitionService.this, geoTransDetails, Toast.LENGTH_SHORT).show();
        }

    }

    private String getGeofenceTransitionDetails(int geofenceTransition, List<Geofence> triggeringGeofence) {
        ArrayList<String> triggerfenceList = new ArrayList<>();

        for(Geofence geofence: triggeringGeofence){
            triggerfenceList.add(geofence.getRequestId());
        }

        String status = null;

        if(geofenceTransition==Geofence.GEOFENCE_TRANSITION_ENTER){
            status = "ENTERING";
            Toast.makeText(GeofenceTransitionService.this, "Entered", Toast.LENGTH_SHORT).show();
        }else if(geofenceTransition==Geofence.GEOFENCE_TRANSITION_EXIT){
            status = "EXITING";
            Toast.makeText(GeofenceTransitionService.this, "Exited", Toast.LENGTH_SHORT).show();
        }

        return status + TextUtils.join(", ",triggerfenceList);
    }
}
