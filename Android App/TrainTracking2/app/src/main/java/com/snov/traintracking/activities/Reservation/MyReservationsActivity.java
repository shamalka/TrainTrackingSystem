package com.snov.traintracking.activities.Reservation;

import android.app.Activity;
import android.content.Intent;
import android.os.StrictMode;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.RecyclerView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.NewsActivity;
import com.snov.traintracking.activities.NewsViewActivity;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;
import com.snov.traintracking.utilities.JsonConfig;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;
import java.util.ArrayList;

public class MyReservationsActivity extends AppCompatActivity {

    //String[] ReservationID;
    String[] TrainID;
    String[] UserID;
    String[] StartStation;
    String[] EndStation;
    String[] FirstClassSeatNumbers;
    String[] SecondClassSeatNumbers;
    String[] ThirdClassSeatNumbers;
    String[] ArrivalTime;
    String[] TotalPrice;
    String[] Date;

    ListView listView;
    BufferedInputStream bis;
    String line = null;
    String result = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_my_reservations);

        listView = (ListView)findViewById(R.id.my_reservation_list);

        StrictMode.setThreadPolicy((new StrictMode.ThreadPolicy.Builder().permitNetwork().build()));


        collectData();
        Toast.makeText(MyReservationsActivity.this, TrainID[0], Toast.LENGTH_SHORT).show();
        Toast.makeText(MyReservationsActivity.this, StartStation[0], Toast.LENGTH_SHORT).show();
        Toast.makeText(MyReservationsActivity.this, EndStation[0], Toast.LENGTH_SHORT).show();
        Toast.makeText(MyReservationsActivity.this, FirstClassSeatNumbers[0], Toast.LENGTH_SHORT).show();
        Toast.makeText(MyReservationsActivity.this, SecondClassSeatNumbers[0], Toast.LENGTH_SHORT).show();
        Toast.makeText(MyReservationsActivity.this, ThirdClassSeatNumbers[0], Toast.LENGTH_SHORT).show();
        Toast.makeText(MyReservationsActivity.this, ArrivalTime[0], Toast.LENGTH_SHORT).show();
        Toast.makeText(MyReservationsActivity.this, TotalPrice[0], Toast.LENGTH_SHORT).show();
        Toast.makeText(MyReservationsActivity.this, Date[0], Toast.LENGTH_SHORT).show();


        //MyReservationsAdapter myReservationsAdapter = new MyReservationsAdapter(this, TrainID, StartStation, EndStation, FirstClassSeatNumbers, SecondClassSeatNumbers, ThirdClassSeatNumbers, ArrivalTime, TotalPrice, Date);
        //listView.setAdapter(myReservationsAdapter);

        NewsListAdapter newsListAdapter = new NewsListAdapter(this, TrainID, StartStation, EndStation, FirstClassSeatNumbers, SecondClassSeatNumbers, ThirdClassSeatNumbers, ArrivalTime, TotalPrice, Date);
        listView.setAdapter(newsListAdapter);

    }

    private void collectData(){
        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ "get_reservations&user_id=" + Config.USER_EMAIL);
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
           // ReservationID = new String[jsonarray.length()];
            TrainID = new String[jsonarray.length()];
            UserID = new String[jsonarray.length()];
            StartStation = new String[jsonarray.length()];
            EndStation = new String[jsonarray.length()];
            FirstClassSeatNumbers = new String[jsonarray.length()];
            SecondClassSeatNumbers = new String[jsonarray.length()];
            ThirdClassSeatNumbers = new String[jsonarray.length()];
            ArrivalTime = new String[jsonarray.length()];
            TotalPrice = new String[jsonarray.length()];
            Date = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);
               // ReservationID[i]=jsonobject.getString("reservation_id");
                TrainID[i]=jsonobject.getString("train_id");
                UserID[i]=jsonobject.getString("user_id");
                StartStation[i]=jsonobject.getString("start_station");
                EndStation[i]=jsonobject.getString("end_station");
                FirstClassSeatNumbers[i]=jsonobject.getString("first_class_seats");
                SecondClassSeatNumbers[i]=jsonobject.getString("second_class_seats");
                ThirdClassSeatNumbers[i]=jsonobject.getString("third_class_seats");
                ArrivalTime[i]=jsonobject.getString("arrival_time");
                TotalPrice[i]=jsonobject.getString("total_price");
                Date[i]=jsonobject.getString("date");



            }


        }catch(Exception e){
            e.printStackTrace();

        }
    }



    private class NewsListAdapter extends ArrayAdapter<String> {

        private String[] TrainID;
        //private String[] UserID;
        private String[] StartStation;
        private String[] EndStation;
        private String[] FirstClassSeatNumbers;
        private String[] SecondClassSeatNumbers;
        private String[] ThirdClassSeatNumbers;
        private String[] ArrivalTime;
        private String[] TotalPrice;
        private String[] Date;
        private Activity context;

        private NewsListAdapter(Activity context, String[] TrainID, String[] StartStation, String[] EndStation, String[] FirstClassSeatNumbers, String[] SecondClassSeatNumbers, String[] ThirdClassSeatNumbers, String[] ArrivalTime, String[] TotalPrice, String[] Date) {
            super(context, R.layout.activity_my_reservations, StartStation);
            this.context = context;
            //this.ReservationID = ReservationID;
            this.TrainID = TrainID;
            //this.UserID = UserID;
            this.StartStation = StartStation;
            this.EndStation = EndStation;
            this.FirstClassSeatNumbers = FirstClassSeatNumbers;
            this.SecondClassSeatNumbers = SecondClassSeatNumbers;
            this.ThirdClassSeatNumbers = ThirdClassSeatNumbers;
            this.ArrivalTime = ArrivalTime;
            this.TotalPrice = TotalPrice;
            this.Date = Date;
        }



        @NonNull
        @Override

        public View getView(final int position, @Nullable View convertView, @NonNull ViewGroup parent){
            View r = convertView;
            ViewHolder viewHolder = null;

            if(r==null){
                LayoutInflater layoutInflater = context.getLayoutInflater();
                r = layoutInflater.inflate(R.layout.my_reservation_item,null,true);
                r.setOnClickListener(new View.OnClickListener() {
                    public void onClick(View v) {
                        Config.MY_START_STATION=StartStation[position];
                        Config.MY_END_STATION=EndStation[position];
                        Config.MY_TRAIN_ID=TrainID[position];
                        Config.MY_DATE=Date[position];
                        Config.MY_SEAT_NUMBERS=FirstClassSeatNumbers[position]+SecondClassSeatNumbers[position]+ThirdClassSeatNumbers[position];
                        Config.MY_TIME=ArrivalTime[position];
//                        Toast.makeText(getContext(), "Go to  " + NewsID[position], Toast.LENGTH_SHORT).show();
//                        Config.NEWS_DESCRIPTION=NewsDescription[position];
//                        Config.NEWS_TITLE=NewsTitle[position];
//                        Config.NEWS_AUTHOR=NewsAuthor[position];
//                        Config.NEWS_DATE=NewsDate[position];
                        Intent intent = new Intent(MyReservationsActivity.this, MyReservationViewActivity.class);
                        startActivity(intent);
                    }
                });
                viewHolder = new ViewHolder(r);
                r.setTag(viewHolder);
            }else{
                viewHolder = (ViewHolder)r.getTag();
            }

            viewHolder.tTrainID.setText(TrainID[position]);
            viewHolder.tStartStation.setText(StartStation[position]);
            viewHolder.tEndStation.setText(EndStation[position]);
         //   viewHolder.tDate.setText(FirstClassSeatNumbers[position]);
         //   viewHolder.tTotalPrice.setText(TotalPrice[position]);
//            viewHolder.tArrivalTime.setText(ArrivalTime[position]);
      //      viewHolder.tSeatNumbers.setText(FirstClassSeatNumbers[position]);


            return r;

        }

        class ViewHolder{
            TextView tTrainID;
            TextView tStartStation;
            TextView tEndStation;
         //   TextView tDate;
//            TextView tArrivalTime;
        //    TextView tSeatNumbers;
     //       TextView tTotalPrice;


            ViewHolder(View v){
                tTrainID = (TextView)v.findViewById(R.id.mr_train_id);
                tStartStation = (TextView)v.findViewById(R.id.mr_start_station);
                tEndStation = (TextView)v.findViewById(R.id.mr_end_station);
             //bn     tDate = (TextView)findViewById(R.id.mr_date);
//                tArrivalTime = (TextView)findViewById(R.id.mr_arrival_time);
               // tSeatNumbers = (TextView)findViewById(R.id.mr_seat_numbers);
             //   tTotalPrice = (TextView)findViewById(R.id.mr_total_price);
            }


        }
    }



}
