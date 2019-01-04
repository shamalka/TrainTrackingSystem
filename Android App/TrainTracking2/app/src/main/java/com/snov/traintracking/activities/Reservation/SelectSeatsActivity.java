package com.snov.traintracking.activities.Reservation;

import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.CheckBox;
import android.widget.CompoundButton;
import android.widget.GridView;
import android.widget.LinearLayout;
import android.widget.RadioGroup;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.BackgroundTask;
import com.snov.traintracking.activities.SharingActivity;
import com.snov.traintracking.activities.SharingTrainListActivity;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.InputStreamReader;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;
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
    String PriceJsonPath;

    List<String> FinalSeatList = new ArrayList<String>();
    List<String> FinalReservedSeatList = new ArrayList<String>();
    List<String> FinalAvailableSeatList = new ArrayList<String>();

    List<String> SelectedSeatList = new ArrayList<String>();

    String[] TempSeatList;
    String[] Temp;

    Button SubmitButton;

    String SelectedSeats;

    String[] TicketPriceArray;

    String[] SeatsArray;
    Integer TotalTicketPrice;

    Boolean SimilarSeats=false;

    //Checking Similar seats GetReservedSeats Method
    String CheckReservedClassJsonPath;
    String[] CheckReservedSeats;

    String TimeJsonPath;
    String[] ArrivalTimeArray;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_select_seats);




        //Toast.makeText(SelectSeatsActivity.this, "Train: " + Config.TRAIN_ID, Toast.LENGTH_SHORT).show();

        TrainID = (TextView)findViewById(R.id.train_id);
        ReservationClass = (TextView)findViewById(R.id.resevation_class);
        ReservationDate = (TextView)findViewById(R.id.date);
        SeatCount = (TextView)findViewById(R.id.seat_count);

        TrainID.setText(Config.TRAIN_ID);
        ReservationClass.setText(Config.RESERVATION_CLASS);
        ReservationDate.setText(Config.RESERVATION_DATE);

        SelectedSeats="";
        Config.SELECTED_SEATS="";

        CollectSeatData();
        CollectReservationData();
        BuildCheckBox();
        GetTicketPrice();
        GetArrivalTime();

        Config.ARRIVAL_TIME=ArrivalTimeArray[0];
       // Toast.makeText(SelectSeatsActivity.this, ArrivalTimeArray[0], Toast.LENGTH_SHORT).show();

        SeatCount.setText(TicketPriceArray[0]);
        Config.SELECTED_TICKET_PRICE=TicketPriceArray[0];

        SubmitButton = (Button)findViewById(R.id.done_seats_button);
        SubmitButton.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                // Perform action on click
                MergeList();
                Config.SELECTED_SEATS=SelectedSeats;
                CheckSimilerSeats();
                //Toast.makeText(SelectSeatsActivity.this, "Similar Seats: " + SimilarSeats, Toast.LENGTH_SHORT).show();

                if(SimilarSeats){
                    Toast.makeText(SelectSeatsActivity.this, "Seats are taken.", Toast.LENGTH_SHORT).show();
                }else if(SelectedSeats.equals("")){
                    Toast.makeText(SelectSeatsActivity.this, "Please Select Seats", Toast.LENGTH_SHORT).show();
                }else{
                    SetTempReservation();
                    Intent intent = new Intent(SelectSeatsActivity.this, PlaceOrderActivity.class);
                    startActivity(intent);
                }
                //
//                Intent intent = new Intent(SelectSeatsActivity.this, PlaceOrderActivity.class);
//                startActivity(intent);


            }
        });



        //
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
            URL url = new URL(Constants.SERVER_URL+"?"+ ClassJsonPath + "&train_id=" + Config.SELECTED_TRAIN_ID);
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

      //  Toast.makeText(SelectSeatsActivity.this, "Train: " + SeatNumberList[0], Toast.LENGTH_SHORT).show();



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
            URL url = new URL(Constants.SERVER_URL+"?"+ ReservedClassJsonPath +"&date=" + Config.RESERVATION_DATE +"&train_id=" + Config.SELECTED_TRAIN_ID);
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
//        for(int i=0; i<ReservedSeatNumber.length; i++){
//            Toast.makeText(SelectSeatsActivity.this, "Train: " + ReservedSeatNumber[i], Toast.LENGTH_LONG).show();
//
//        }


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

//        for(int i=0; i<FinalReservedSeatList.size(); i++){
//            Toast.makeText(SelectSeatsActivity.this, "Reserved: " + FinalReservedSeatList.get(i), Toast.LENGTH_LONG).show();
//
//        }


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
            final CheckBox cb = new CheckBox(this);
            cb.setText(FinalSeatList.get(i));
            l1.addView(cb);
//            cb.setOnClickListener(new View.OnClickListener() {
//
//                @Override
//                public void onClick(View v) {
//                    // TODO Auto-generated method stub
//                    if(cb.isChecked()){
//                        SelectedSeatList.add(FinalSeatList.get(finalI));
//
//                        Toast.makeText(SelectSeatsActivity.this, "Added: " + SelectedSeatList.get(finalI), Toast.LENGTH_SHORT).show();
//                    }
//                    else if(SelectedSeatList.contains(FinalSeatList.get(finalI))){
//                        SelectedSeatList.remove(FinalSeatList.get(finalI));
//                        Toast.makeText(SelectSeatsActivity.this, "Removed: " + SelectedSeatList.get(finalI), Toast.LENGTH_SHORT).show();
//                    }
//                }
//            });

            cb.setOnCheckedChangeListener(new CompoundButton.OnCheckedChangeListener() {
                @Override
                public void onCheckedChanged(CompoundButton buttonView, boolean isChecked) {
                    if (buttonView.isChecked()) {
                        SelectedSeatList.add((String) cb.getText());
                        Toast.makeText(SelectSeatsActivity.this, "Added: " + (String) cb.getText(), Toast.LENGTH_SHORT).show();
                    }else{
                        if(SelectedSeatList.contains((String) cb.getText())){
                            SelectedSeatList.remove((String) cb.getText());
                            //Toast.makeText(SelectSeatsActivity.this, "Removed: " + (String) cb.getText(), Toast.LENGTH_SHORT).show();
                        }else{
                            //Toast.makeText(SelectSeatsActivity.this, "Unchecked", Toast.LENGTH_SHORT).show();
                        }
                    }

                }

            });
        }
    }

    //Merge SelectedSeatList to one string
    public void MergeList(){
        for(int i=0; i<SelectedSeatList.size(); i++){
            if(!SelectedSeats.contains(SelectedSeatList.get(i))){
                if(SelectedSeats.equals("")){
                    SelectedSeats=SelectedSeatList.get(i);
                }else{
                    SelectedSeats=SelectedSeats+","+SelectedSeatList.get(i);
                }
            }
        }
        //Toast.makeText(SelectSeatsActivity.this, "Selected Seats: " + SelectedSeats, Toast.LENGTH_LONG).show();
    }

    public void GetTicketPrice(){
        if(ReservationClass.getText().equals("1st Class")){
            PriceJsonPath="get_first_class_ticket_price";
            // ReservedClassJsonPath="get_first_class_reserved_seats";
            //Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }else if(ReservationClass.getText().equals("2nd Class")){
            PriceJsonPath="get_second_class_ticket_price";
            // ReservedClassJsonPath="get_second_class_reserved_seats";
            // Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }else{
            PriceJsonPath="get_third_class_ticket_price";
            // ReservedClassJsonPath="get_third_class_reserved_seats";
            // Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }

        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ PriceJsonPath + "&train_id=" + Config.SELECTED_TRAIN_ID + "&end_station=" + Config.END_STATION);
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
            TicketPriceArray = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);

                if(Config.RESERVATION_CLASS.equals("1st Class")){
                    TicketPriceArray[i]=jsonobject.getString("first_class_price");
                }else if(Config.RESERVATION_CLASS.equals("2nd Class")){
                    TicketPriceArray[i]=jsonobject.getString("second_class_price");
                }else{
                    TicketPriceArray[i]=jsonobject.getString("third_class_price");
                }

            }

        }catch(Exception e){
            e.printStackTrace();

        }

    }

    public void SetTempReservation(){
        CalculateTotalTicketPrice();

        String Method = "reserve_temp";

        String TrainID = Config.SELECTED_TRAIN_ID;
        String UserID = Config.USER_EMAIL;
        String Seats = SelectedSeats;
        String TicketPrice = TotalTicketPrice.toString();
        String StartStation = Config.START_STATION;
        String EndStation = Config.END_STATION;
        String ArrivalTime = Config.ARRIVAL_TIME;
        String Date = Config.RESERVATION_DATE;
        String Status = "Pending";
        String Empty="";

        ReservationTask reservationTask = new ReservationTask(this);
        if(Config.RESERVATION_CLASS.equals("1st Class")){
            reservationTask.execute(Method,TrainID,UserID,Seats,Empty,Empty,TicketPrice,StartStation,EndStation,ArrivalTime,Date,Status);
        }else if(Config.RESERVATION_CLASS.equals("2nd Class")){
            reservationTask.execute(Method,TrainID,UserID,Empty,Seats,Empty,TicketPrice,StartStation,EndStation,ArrivalTime,Date,Status);
        }else{
            reservationTask.execute(Method,TrainID,UserID,Empty,Empty,Seats,TicketPrice,StartStation,EndStation,ArrivalTime,Date,Status);
        }
    }

    public class ReservationTask extends AsyncTask<String,Void,String> {

        Context context;


        ReservationTask(Context context){
            this.context = context;

        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected String doInBackground(String... params) {

            String TempReserveUrl = Constants.TEMP_RESERVE_URL;
            String LoginUrl = Constants.SERVER_URL;

            String method = params[0];
            if(method.equals("reserve_temp")){
                String TrainID = params[1];
                String UserID = params[2];
                String FirstClassSeats = params[3];
                String SecondClassSeats = params[4];
                String ThirdClassSeats = params[5];
                String TotalPrice = params[6];
                String StartStation = params[7];
                String EndStation = params[8];
                String ArrivalTime = params[9];
                String Date = params[10];
                String Status = params[11];

                try {
                    URL url = new URL(TempReserveUrl);
                    HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoOutput(true);
                    OutputStream OS = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(OS,"UTF-8"));

                    String data = URLEncoder.encode("train_id","UTF-8") + "=" + URLEncoder.encode(TrainID,"UTF-8") + "&" +
                            URLEncoder.encode("user_id","UTF-8") + "=" + URLEncoder.encode(UserID,"UTF-8") + "&" +
                            URLEncoder.encode("first_class_seats","UTF-8") + "=" + URLEncoder.encode(FirstClassSeats,"UTF-8") + "&" +
                            URLEncoder.encode("second_class_seats","UTF-8") + "=" + URLEncoder.encode(SecondClassSeats,"UTF-8") + "&" +
                            URLEncoder.encode("third_class_seats","UTF-8") + "=" + URLEncoder.encode(ThirdClassSeats,"UTF-8") + "&" +
                            URLEncoder.encode("total_price","UTF-8") + "=" + URLEncoder.encode(TotalPrice,"UTF-8") + "&" +
                            URLEncoder.encode("start_station","UTF-8") + "=" + URLEncoder.encode(StartStation,"UTF-8") + "&" +
                            URLEncoder.encode("end_station","UTF-8") + "=" + URLEncoder.encode(EndStation,"UTF-8") + "&" +
                            URLEncoder.encode("arrival_time","UTF-8") + "=" + URLEncoder.encode(ArrivalTime,"UTF-8") + "&" +
                            URLEncoder.encode("date","UTF-8") + "=" + URLEncoder.encode(Date,"UTF-8") + "&" +
                            URLEncoder.encode("status","UTF-8") + "=" + URLEncoder.encode(Status,"UTF-8");

                    bufferedWriter.write(data);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    OS.close();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    inputStream.close();
                    return "Succesful..!!";
                } catch (MalformedURLException e) {
                    e.printStackTrace();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }

            return null;
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }

        @Override
        protected void onPostExecute(String result) {
            Toast.makeText(context,result,Toast.LENGTH_SHORT).show();

        }
    }

    public void CalculateTotalTicketPrice(){
        SeatsArray=SelectedSeats.split(",");
        //Toast.makeText(SelectSeatsActivity.this, "Selected Seats: " + SeatsArray.length, Toast.LENGTH_LONG).show();
        TotalTicketPrice = (SeatsArray.length)*Integer.parseInt(Config.SELECTED_TICKET_PRICE);
    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Intent intent = new Intent(SelectSeatsActivity.this, ReservationActivity.class);
        startActivity(intent);
    }

    public void GetReservedSeats(){

        if(ReservationClass.getText().equals("1st Class")){
            //ClassJsonPath="get_first_class_seat_numbers";
            CheckReservedClassJsonPath="get_first_class_reserved_seats";
            //Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }else if(ReservationClass.getText().equals("2nd Class")){
            //ClassJsonPath="get_second_class_seat_numbers";
            CheckReservedClassJsonPath="get_second_class_reserved_seats";
            // Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }else{
            //ClassJsonPath="get_third_class_seat_numbers";
            CheckReservedClassJsonPath="get_third_class_reserved_seats";
            // Toast.makeText(SelectSeatsActivity.this, "Path: " + ReservationClass.getText(), Toast.LENGTH_SHORT).show();
        }
        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ CheckReservedClassJsonPath +"&date=" + Config.RESERVATION_DATE +"&train_id=" + Config.SELECTED_TRAIN_ID);
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
            CheckReservedSeats = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);

                if(Config.RESERVATION_CLASS.equals("1st Class")){
                    CheckReservedSeats[i]=jsonobject.getString("first_class_seats");
                }else if(Config.RESERVATION_CLASS.equals("2nd Class")){
                    CheckReservedSeats[i]=jsonobject.getString("second_class_seats");
                }else{
                    CheckReservedSeats[i]=jsonobject.getString("third_class_seats");
                }

            }


        }catch(Exception e){
            e.printStackTrace();

        }

    }

    public void CheckSimilerSeats(){
        GetReservedSeats();
        String[] TempArray;
        List<String> TempList = new ArrayList<String>();
        for(int i=0; i<CheckReservedSeats.length; i++){
            TempArray=CheckReservedSeats[i].split(",");
            for(int j=0; j<TempArray.length; j++){
                TempList.add(TempArray[j]);
            }
//            if(CheckReservedSeats[i].contains(SelectedSeats) || CheckReservedSeats[i].equals(SelectedSeats)){
//                Toast.makeText(SelectSeatsActivity.this, "seats: " + CheckReservedSeats[i], Toast.LENGTH_SHORT).show();
//                SimilarSeats=true;
//            }else{
//                Toast.makeText(SelectSeatsActivity.this, "seats: " + CheckReservedSeats[i], Toast.LENGTH_SHORT).show();
//                SimilarSeats=false;
//            }
        }

        if(TempList.containsAll(SelectedSeatList)){
            SimilarSeats=true;
        }else{
            SimilarSeats=false;
        }
    }

    public void GetArrivalTime(){

        TimeJsonPath="get_arrival_time";


        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ TimeJsonPath + "&train_id=" + Config.SELECTED_TRAIN_ID + "&start_station=" + Config.START_STATION);
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
            ArrivalTimeArray = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);


                ArrivalTimeArray[i]=jsonobject.getString("arrival_time");


            }

        }catch(Exception e){
            e.printStackTrace();

        }

    }


}
