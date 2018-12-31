package com.snov.traintracking.activities;

import android.app.Activity;
import android.content.Intent;
import android.os.StrictMode;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.Reservation.ReservationHomeActivity;
import com.snov.traintracking.activities.Reservation.SelectSeatsActivity;
import com.snov.traintracking.model.Train;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;
import java.util.Arrays;
import java.util.List;

public class TrainListActivity extends AppCompatActivity {

    String[] TrainName;
    String[] ArrivalTime;
    String[] DepartureTime;
    ListView listView;
    BufferedInputStream bis;
    String line = null;
    String result = null;

    String SendStartStation = Config.START_STATION;
    String SendEndStation = Config.END_STATION;

    String[] TrainIDList;
    String[] StationList;

    String[] TrainIDForAdapter;

    String[] TrainIDForAdapterArray;
    String[] TrainNameArray;
    String[] ArrivalTimeArray;
    String[] DepartureTimeArray;

    List<String> TempList = new ArrayList<String>();
    List<String> TrainNameList = new ArrayList<String>();
    List<String> ArrivalTimeList = new ArrayList<String>();
    List<String> DepartureTimeList = new ArrayList<String>();

    List<String> TrainIDListForAdapter = new ArrayList<String>();

    List<String> TrainIDFinalList = new ArrayList<String>();
    String[] StationTempArray;
    List<String> StationTempArrayList = new ArrayList<String>();

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_train_list);

        listView = (ListView)findViewById(R.id.TrainList);

        StrictMode.setThreadPolicy((new StrictMode.ThreadPolicy.Builder().permitNetwork().build()));




        try{
            SearchTrains();

            //4.SearchTrains() eken ena train_id gaanata adalawa CollectTrainData eka loop karanawa
            //ethakota e e train ekata adaala name,arrival,departure time enawa
            for(int i=0; i<TempList.size(); i++){
                CollectTrainData(TempList.get(i), Config.START_STATION);
                //Toast.makeText(TrainListActivity.this, "Name: " + TrainNameList.get(i), Toast.LENGTH_SHORT).show();
            }

            //5.adapter ekata daanna puluwan arrays witharai so, array walata size set karanawa
            TrainIDForAdapterArray = new String[TrainNameList.size()];
            TrainNameArray = new String[TrainNameList.size()];
            ArrivalTimeArray = new String[TrainNameList.size()];
            DepartureTimeArray = new String[TrainNameList.size()];

            //6.uda loop eken aapu ewa arrays walata danawa
            for(int i=0; i<TrainNameList.size(); i++){
                //CollectTrainData(TrainNameList.get(i), Config.START_STATION);
                TrainIDForAdapterArray[i]=TrainIDListForAdapter.get(i);
                TrainNameArray[i]=TrainNameList.get(i);
                ArrivalTimeArray[i]=ArrivalTimeList.get(i);
                DepartureTimeArray[i]=DepartureTimeList.get(i);
                //Toast.makeText(TrainListActivity.this, "Name: " + TrainNameArray[i] + "," + ArrivalTimeArray[i] + "," + DepartureTimeArray[i], Toast.LENGTH_SHORT).show();
            }

            //7.arrays walin apuwa adapater ekata danawa
            TrainListAdapter trainListAdapter = new TrainListAdapter(this, TrainNameArray, TrainIDForAdapterArray, ArrivalTimeArray, DepartureTimeArray);
            listView.setAdapter(trainListAdapter);

        }catch(Exception e){
            Toast.makeText(TrainListActivity.this, "Try Again.!", Toast.LENGTH_SHORT).show();
        }



    }




    //1.Stations dekata adaala train_id deka stations table eken ganna
    public void SearchTrains(){
        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?" + "select_stations&start=" + SendStartStation + "&end=" + SendEndStation);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("GET");
            bis = new BufferedInputStream(con.getInputStream());
        } catch (Exception e) {
            e.printStackTrace();
        }

        //content
        try {
            BufferedReader bufferedReader = new BufferedReader((new InputStreamReader(bis)));
            StringBuilder stringBuilder = new StringBuilder();
            while((line = bufferedReader.readLine())!=null){
                stringBuilder.append(line+"\n");
            }
            bis.close();
            result = stringBuilder.toString();
            Log.d("data", result);
        }catch (Exception e){
            e.printStackTrace();
        }

        //JSON
        try {
            JSONArray jsonarray = new JSONArray(result);
            JSONObject jsonobject = null;
            TrainIDList = new String[jsonarray.length()];
            StationList = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){
                jsonobject = jsonarray.getJSONObject(i);
                TrainIDList[i]=jsonobject.getString("train_id");
                StationList[i]=jsonobject.getString("stations");





                //Toast.makeText(TrainListActivity.this, "Test: " + TrainName[i], Toast.LENGTH_SHORT).show();

            }


        }catch(Exception e){
            e.printStackTrace();

        }

        for(int i=0; i<StationList.length;i++){
            //Toast.makeText(TrainListActivity.this, "Stations: " + StationList[i], Toast.LENGTH_SHORT).show();
            StationTempArray=StationList[i].split(",");
            for(int j=0; j<StationTempArray.length; j++){
                StationTempArrayList.add(StationTempArray[j]);
            }

            int StartIndex = Arrays.asList(StationTempArray).indexOf(Config.START_STATION);
            int EndIndex = Arrays.asList(StationTempArray).indexOf(Config.END_STATION);

            Toast.makeText(TrainListActivity.this, "Indexus: " + StartIndex + "," + EndIndex , Toast.LENGTH_SHORT).show();
            //Toast.makeText(TrainListActivity.this, "Test: " + StationTempArrayList.indexOf(Config.START_STATION) + "," + StationTempArrayList.indexOf(Config.END_STATION), Toast.LENGTH_SHORT).show();
            if(StartIndex<EndIndex){
                TrainIDFinalList.add(TrainIDList[i]);

            }
        }


        for(int i=0; i<TrainIDFinalList.size();i++){
            TempList.add(TrainIDFinalList.get(i));
        }

//        for(int i=0; i<TrainIDList.length; i++){
//            Toast.makeText(TrainListActivity.this, "Path: " + TrainIDList[i], Toast.LENGTH_SHORT).show();
//            Toast.makeText(TrainListActivity.this, "Path: " + StationList[i], Toast.LENGTH_SHORT).show();
//        }



    }

    //2.train_id and Start station ekakata adaala name,arival time,departure time ganna
    //meken 1 row ekai enne, okkoma ganna loop ekak one
    private void CollectTrainData(String TrainID, String Station){
        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ "get_train_details&train_id=" + TrainID + "&start_station="+ Station);
            HttpURLConnection con = (HttpURLConnection)url.openConnection();
            con.setRequestMethod("GET");
            bis = new BufferedInputStream(con.getInputStream());
        } catch (Exception e) {
            e.printStackTrace();
        }

        //content
        try {
            BufferedReader bufferedReader = new BufferedReader((new InputStreamReader(bis)));
            StringBuilder stringBuilder = new StringBuilder();
            while((line = bufferedReader.readLine())!=null){
                stringBuilder.append(line+"\n");
            }
            bis.close();
            result = stringBuilder.toString();
            Log.d("data", result);
        }catch (Exception e){
            e.printStackTrace();
        }

        //JSON
        try {
            JSONArray jsonarray = new JSONArray(result);
            JSONObject jsonobject = null;
            TrainIDForAdapter = new String[jsonarray.length()];
            TrainName = new String[jsonarray.length()];
            ArrivalTime = new String[jsonarray.length()];
            DepartureTime = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);
                TrainIDForAdapter[i]=jsonobject.getString("train_id");
                TrainName[i]=jsonobject.getString("name");
                ArrivalTime[i]=jsonobject.getString("arrival_time");
                DepartureTime[i]=jsonobject.getString("departure_time");

                //3.ena ena eka mutable lists walta add karanawa
                TrainIDListForAdapter.add(TrainIDForAdapter[i]);
                TrainNameList.add(TrainName[i]);
                ArrivalTimeList.add(ArrivalTime[i]);
                DepartureTimeList.add(DepartureTime[i]);
            }


        }catch(Exception e){
            e.printStackTrace();

        }
    }

    private class TrainListAdapter extends ArrayAdapter<String> {

        private String[] TrainID;
        private String[] TrainName;
        private String[] ArrivalTime;
        private String[] DepartureTime;
        private Activity context;

        private TrainListAdapter(Activity context, String[] TrainName, String[] TrainID, String[] ArrivalTime, String[] DepartureTime) {
            super(context, R.layout.activity_train_list, TrainName);
            this.context = context;
            this.TrainName = TrainName;
            this.TrainID = TrainID;
            this.ArrivalTime = ArrivalTime;
            this.DepartureTime = DepartureTime;
        }



        @NonNull
        @Override

        public View getView(final int position, @Nullable View convertView, @NonNull ViewGroup parent){
            View r = convertView;
            ViewHolder viewHolder = null;

            if(r==null){
                LayoutInflater layoutInflater = context.getLayoutInflater();
                r = layoutInflater.inflate(R.layout.trains_list_item,null,true);
                r.setOnClickListener(new View.OnClickListener() {
                    public void onClick(View v) {
                        // Toast.makeText(getContext(), "Go to  " + TrainName[position], Toast.LENGTH_SHORT).show();

                        //CHECK_TRAIN_LIST_REQUEST=0 if you share your location
                        //CHECK_TRAIN_LIST_REQUEST=1 if you view shared location
                        //CHECK_TRAIN_LIST_REQUEST=2 if you are in reservation(to_do)
                        if(Config.CHECK_TRAIN_LIST_REQUEST=="0"){
                            Intent intent = new Intent(TrainListActivity.this, SharingActivity.class);
                            startActivity(intent);
                        }else if(Config.CHECK_TRAIN_LIST_REQUEST=="1"){
                            Intent intent = new Intent(TrainListActivity.this, MapsActivity.class);
                            startActivity(intent);
                        }else{
                            Config.SELECTED_TRAIN_ID=TrainID[position];
                            Intent intent = new Intent(TrainListActivity.this, SelectSeatsActivity.class);
                            startActivity(intent);
                        }

                        //JSON_PATH is used to connect with firebase realtime db
                        Config.TRAIN_ID=TrainName[position];
                        Config.JSON_PATH="rajarata_rajini";
                    }
                });
                viewHolder = new ViewHolder(r);
                r.setTag(viewHolder);
            }else{
                viewHolder = (ViewHolder)r.getTag();
            }

            viewHolder.train_name.setText(TrainName[position]);
            viewHolder.start_st.setText(ArrivalTime[position]);
            viewHolder.end_st.setText(DepartureTime[position]);
            viewHolder.train_type.setText("wat?");


            return r;

        }

        class ViewHolder{
            TextView train_name;
            TextView start_st;
            TextView end_st;
            TextView train_time;
            TextView train_type;


            ViewHolder(View v){
                train_name = (TextView)v.findViewById(R.id.name);
                start_st = (TextView)v.findViewById(R.id.start);
                end_st = (TextView)v.findViewById(R.id.end);
                train_time = (TextView)v.findViewById(R.id.time);
                train_type = (TextView)v.findViewById(R.id.type);

            }


        }
    }

    //To_do
    //end station ekata adala ticket price aragena adapter ekata set karanna

}
