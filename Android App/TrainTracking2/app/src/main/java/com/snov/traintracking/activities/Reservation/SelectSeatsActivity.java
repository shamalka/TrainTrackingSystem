package com.snov.traintracking.activities.Reservation;

import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.widget.CheckBox;
import android.widget.GridView;
import android.widget.LinearLayout;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
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
import java.util.List;

public class SelectSeatsActivity extends AppCompatActivity {

    TextView TrainID;
    TextView ReservationClass;
    TextView ReservationDate;
    TextView SeatCount;

    BufferedInputStream bis;
    String line = null;
    String result = null;

    String[] SeatNumberList;
    String[] SeatNumbers;
    String[] ReservedSeatNumber;
    String[] AvailableSeatNumbers;

    String ClassJsonPath;
    String ReservedClassJsonPath;

    List<String> FinalSeatList = new ArrayList<String>();
    List<String> FinalReservedSeatList = new ArrayList<String>();
    List<String> FinalAvailableSeatList = new ArrayList<String>();

    String[] TempSeatList;
    String[] Temp;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_select_seats);




        Toast.makeText(SelectSeatsActivity.this, "Train: " + Config.TRAIN_ID, Toast.LENGTH_SHORT).show();

        TrainID = (TextView)findViewById(R.id.train_id);
        ReservationClass = (TextView)findViewById(R.id.resevation_class);
        ReservationDate = (TextView)findViewById(R.id.date);

        TrainID.setText(Config.TRAIN_ID);
        ReservationClass.setText(Config.RESERVATION_CLASS);
        ReservationDate.setText(Config.RESERVATION_DATE);





        CollectSeatData();
        CollectReservationData();
        BuildCheckBox();

    }


    //Get data from php api
    private void CollectSeatData(){

        if(ReservationClass.getText().equals("1st Class")){
            ClassJsonPath="get_first_class_seat_numbers";
           // ReservedClassJsonPath="get_first_class_reserved_seats";
            //Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }else if(ReservationClass.getText().equals("2nd Class")){
            ClassJsonPath="get_second_class_seat_numbers";
           // ReservedClassJsonPath="get_second_class_reserved_seats";
            // Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }else{
            ClassJsonPath="get_third_class_seat_numbers";
           // ReservedClassJsonPath="get_third_class_reserved_seats";
            // Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }

        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ ClassJsonPath + "&train_id=T001");
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
            SeatNumberList = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);

                if(Config.RESERVATION_CLASS.equals("1st Class")){
                    SeatNumberList[i]=jsonobject.getString("first_class_seats");
                }else if(Config.RESERVATION_CLASS.equals("2nd Class")){
                    SeatNumberList[i]=jsonobject.getString("second_class_seats");
                }else{
                    SeatNumberList[i]=jsonobject.getString("third_class_seats");
                }



            }


        }catch(Exception e){
            e.printStackTrace();

        }

        Toast.makeText(SelectSeatsActivity.this, "Train: " + SeatNumberList[0], Toast.LENGTH_SHORT).show();



        TempSeatList = SeatNumberList[0].split(",");

        for(int i=0; i<TempSeatList.length; i++){
            FinalSeatList.add(TempSeatList[i]);
            //Toast.makeText(SelectSeatsActivity.this, "The Seat: " + FinalSeatList.get(i), Toast.LENGTH_SHORT).show();
        }

//        SeatNumbers = SeatNumberList[0].split(",");
//        Toast.makeText(SelectSeatsActivity.this, "Seat: " + SeatNumbers[0], Toast.LENGTH_SHORT).show();

        //Build checkboxus
//        LinearLayout l1 = (LinearLayout)findViewById(R.id.linear_view);
//        for(int i = 0; i < SeatNumber.length; i++) {
//            CheckBox cb = new CheckBox(this);
//            cb.setText(SeatNumber[i]);
//            l1.addView(cb);
//        }
    }

    private void CollectReservationData(){

        if(ReservationClass.getText().equals("1st Class")){
            //ClassJsonPath="get_first_class_seat_numbers";
            ReservedClassJsonPath="get_first_class_reserved_seats";
            //Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }else if(ReservationClass.getText().equals("2nd Class")){
            //ClassJsonPath="get_second_class_seat_numbers";
            ReservedClassJsonPath="get_second_class_reserved_seats";
            // Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }else{
            //ClassJsonPath="get_third_class_seat_numbers";
            ReservedClassJsonPath="get_third_class_reserved_seats";
            // Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }
        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ ReservedClassJsonPath +"&date=2018/12/30&train_id=T001");
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
            ReservedSeatNumber = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);

                if(Config.RESERVATION_CLASS.equals("1st Class")){
                    ReservedSeatNumber[i]=jsonobject.getString("first_class_seats");
                }else if(Config.RESERVATION_CLASS.equals("2nd Class")){
                    ReservedSeatNumber[i]=jsonobject.getString("second_class_seats");
                }else{
                    ReservedSeatNumber[i]=jsonobject.getString("third_class_seats");
                }

            }


        }catch(Exception e){
            e.printStackTrace();

        }

        //Toast.makeText(SelectSeatsActivity.this, "Train: " + ReservedSeatNumber[0], Toast.LENGTH_LONG).show();
        //Toast.makeText(SelectSeatsActivity.this, "Seat: " + SeatNumber[0], Toast.LENGTH_SHORT).show();
        for(int i=0; i<ReservedSeatNumber.length; i++){
            Toast.makeText(SelectSeatsActivity.this, "Train: " + ReservedSeatNumber[i], Toast.LENGTH_LONG).show();

        }


        try{
            for(int i=0; i<ReservedSeatNumber.length; i++){
                if(ReservedSeatNumber[i].contains(",") && !ReservedSeatNumber[i].equals("")){
                    Temp = ReservedSeatNumber[i].split(",");
                    for(int j=0; j<Temp.length; j++){
                        FinalReservedSeatList.add(Temp[j]);
                        //Toast.makeText(SelectSeatsActivity.this, "Reserved: " + FinalReservedSeatList.get(j), Toast.LENGTH_SHORT).show();
                    }
                }else if(!ReservedSeatNumber[i].equals("")){
                    FinalReservedSeatList.add(ReservedSeatNumber[i]);
                    //Toast.makeText(SelectSeatsActivity.this, "Reserved: " + ReservedSeatNumber[i], Toast.LENGTH_SHORT).show();
                }

            }

        }catch(Exception e){

        }

        for(int i=0; i<FinalReservedSeatList.size(); i++){
            Toast.makeText(SelectSeatsActivity.this, "Reserved: " + FinalReservedSeatList.get(i), Toast.LENGTH_LONG).show();

        }


//        SeatCount = (TextView)findViewById(R.id.seat_count);
//
//        String Seat1=SeatNumber[0];
//        String Seat2=ReservedSeatNumber[0];
//
//        if(Seat1!=Seat2){
//            SeatCount.setText(SeatNumber.length);
//        }else{
//            SeatCount.setText("Error");
//        }



//        try {
//            AvailableSeatNumbers = new String[SeatNumber.length-ReservedSeatNumber.length];
//            for(int i = 0; i < SeatNumber.length; i++) {
//                for(int j = 0; j < ReservedSeatNumber.length; j++) {
//                    if(SeatNumber[i]!=ReservedSeatNumber[j]){
//                        AvailableSeatNumbers[i]=SeatNumber[i];
//                       // Toast.makeText(SelectSeatsActivity.this, "Available: " + AvailableSeatNumbers[i], Toast.LENGTH_SHORT).show();
//                    }
//                }
//            }
//
//            LinearLayout l1 = (LinearLayout)findViewById(R.id.linear_view);
//            for(int i = 0; i < AvailableSeatNumbers.length; i++) {
//                CheckBox cb = new CheckBox(this);
//                cb.setText(AvailableSeatNumbers[i]);
//                l1.addView(cb);
//            }
//        }catch(Exception e){
//            Toast.makeText(SelectSeatsActivity.this, "Error", Toast.LENGTH_SHORT).show();
//        }




        //SeatNumber[SeatNumber.length]="SS";

        //Build checkboxus

//
//        for(int i = 0; i < ReservedSeatNumber.length; i++) {
//            CheckBox cb = new CheckBox(this);
//            cb.setText(ReservedSeatNumber[i]);
//            l1.addView(cb);
//        }
    }

    public void BuildCheckBox(){

        //Remove reserved seats froms seatlist
//        for(int i=0; i<FinalSeatList.size(); i++){
//            for(int j=0; j<FinalReservedSeatList.size(); j++){
//                if(FinalSeatList.get(i).equals(FinalReservedSeatList.get(j))){
//                    Toast.makeText(SelectSeatsActivity.this, "Equals", Toast.LENGTH_SHORT).show();
//                }else{
//                    FinalAvailableSeatList.add(FinalSeatList.get(i));
//                }
//            }
//        }

        FinalSeatList.removeAll(FinalReservedSeatList);

        //Build checkboxus
        LinearLayout l1 = (LinearLayout)findViewById(R.id.linear_view);
        for(int i = 0; i < FinalSeatList.size(); i++) {
            CheckBox cb = new CheckBox(this);
            cb.setText(FinalSeatList.get(i));
            l1.addView(cb);
        }
    }
}
