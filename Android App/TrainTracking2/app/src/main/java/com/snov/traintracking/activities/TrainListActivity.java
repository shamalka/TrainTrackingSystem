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

import com.snov.traintracking.R;
import com.snov.traintracking.activities.Reservation.ReservationHomeActivity;
import com.snov.traintracking.activities.Reservation.SelectSeatsActivity;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class TrainListActivity extends AppCompatActivity {

    String[] TrainName;
    String[] StartStation;
    String[] EndStation;
    String[] Time;
    ListView listView;
    BufferedInputStream bis;
    String line = null;
    String result = null;

    String SendStartStation = Config.START_STATION;
    String SendEndStation = Config.END_STATION;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_train_list);

        listView = (ListView)findViewById(R.id.TrainList);

        StrictMode.setThreadPolicy((new StrictMode.ThreadPolicy.Builder().permitNetwork().build()));
        collectData();

        TrainListAdapter trainListAdapter = new TrainListAdapter(this, TrainName, StartStation, EndStation, Time);
        listView.setAdapter(trainListAdapter);


    }

    private void collectData(){
        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ "get_trains=" + SendStartStation + "&" + "name=" + SendEndStation);
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
            TrainName = new String[jsonarray.length()];
            StartStation = new String[jsonarray.length()];
            EndStation = new String[jsonarray.length()];
            Time = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);
                TrainName[i]=jsonobject.getString("name");
                StartStation[i]=jsonobject.getString("start_station");
                EndStation[i]=jsonobject.getString("end_station");
                Time[i]=jsonobject.getString("time");



            }


        }catch(Exception e){
            e.printStackTrace();

        }
    }

    private class TrainListAdapter extends ArrayAdapter<String> {

        private String[] TrainName;
        private String[] StartStation;
        private String[] EndStation;
        private String[] Time;
        private Activity context;

        private TrainListAdapter(Activity context, String[] TrainName, String[] StartStation, String[] EndStation, String[] Time) {
            super(context, R.layout.activity_train_list, TrainName);
            this.context = context;
            this.TrainName = TrainName;
            this.StartStation = StartStation;
            this.EndStation = EndStation;
            this.Time = Time;
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
            viewHolder.start_st.setText(StartStation[position]);
            viewHolder.end_st.setText(EndStation[position]);
            viewHolder.train_time.setText(Time[position]);
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

}
