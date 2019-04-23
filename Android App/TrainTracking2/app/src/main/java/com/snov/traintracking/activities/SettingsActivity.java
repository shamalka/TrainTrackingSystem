package com.snov.traintracking.activities;

import android.app.Activity;
import android.content.Context;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.StrictMode;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.support.v7.widget.CardView;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.Reservation.PaymentActivity;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;
import com.snov.traintracking.utilities.JsonConfig;

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

public class SettingsActivity extends AppCompatActivity {

    EditText UserName, PhoneNumber, NIC, Email, Password;

    String[] UserNameArray;
    String[] PhoneNumberArray;
    String[] NICArray;
    String[] EmailArray;
    String[] PasswordArray;
    ListView listView;
    BufferedInputStream bis;
    String line = null;
    String result = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_settings);



        UserName = (EditText)findViewById(R.id.st_signup_name);
        PhoneNumber = (EditText)findViewById(R.id.st_phone_number);
        NIC = (EditText)findViewById(R.id.st_nic);
        Email = (EditText)findViewById(R.id.st_signup_email);
        Password = (EditText)findViewById(R.id.st_signup_password);
        CardView UpdateButton = (CardView)findViewById(R.id.update_btn);

        int SDK_INT = android.os.Build.VERSION.SDK_INT;
        if (SDK_INT > 8)
        {
            StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                    .permitAll().build();
            StrictMode.setThreadPolicy(policy);

            collectData();
            UpdateButton.setOnClickListener(new View.OnClickListener() {
                @Override
                public void onClick(View v) {
                    UpdateUser();
                    Intent intent = new Intent(SettingsActivity.this, MainActivity.class);
                    startActivity(intent);
                    finish();
                }
            });
//            UserName.setText(UserNameArray[0]);
//            PhoneNumber.setText(PhoneNumberArray[0]);
//            NIC.setText(NICArray[0]);
//            Password.setText(PasswordArray[0]);

        }

        //Toast.makeText(SettingsActivity.this, "Selected Seats: " + UserNameArray[0] + " " + PhoneNumberArray[0] + " " + NICArray[0] + " " + PasswordArray[0], Toast.LENGTH_LONG).show();




    }

    private void collectData(){
        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ "get_user_settings&user_id=" + Config.USER_EMAIL);
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
            UserNameArray = new String[jsonarray.length()];
            PhoneNumberArray = new String[jsonarray.length()];
            NICArray = new String[jsonarray.length()];
            EmailArray = new String[jsonarray.length()];
            //PasswordArray = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);
                UserNameArray[i]=jsonobject.getString("name");
                PhoneNumberArray[i]=jsonobject.getString("phone_number");
                NICArray[i]=jsonobject.getString("nic");
                EmailArray[i]=jsonobject.getString("email");
                //PasswordArray[i]=jsonobject.getString("date");

                UserName.setText(UserNameArray[i]);
                PhoneNumber.setText(PhoneNumberArray[i]);
                NIC.setText(NICArray[i]);
                Email.setText(EmailArray[i]);

                //Toast.makeText(SettingsActivity.this, "Selected Seats: " + UserNameArray[i], Toast.LENGTH_LONG).show();

            }

            Toast.makeText(SettingsActivity.this,   UserNameArray[0] + " " + PhoneNumberArray[0] + " " + NICArray[0] + " " + PasswordArray[0], Toast.LENGTH_LONG).show();


        }catch(Exception e){
            e.printStackTrace();

        }
    }

    public void UpdateUser(){
        String Method = "update_user";

        String UserID = Config.USER_EMAIL;

        UpdateUserTask updateUserTask = new UpdateUserTask(this);
        updateUserTask.execute(Method,UserName.getText().toString(),Email.getText().toString(),Password.getText().toString(),PhoneNumber.getText().toString(),NIC.getText()
                .toString());
    }

    public class UpdateUserTask extends AsyncTask<String,Void,String> {

        Context context;


        UpdateUserTask(Context context){
            this.context = context;

        }

        @Override
        protected void onPreExecute() {
            super.onPreExecute();
        }

        @Override
        protected String doInBackground(String... params) {

            String TempReserveUrl = Constants.UPDATE_USER_URL;
            String LoginUrl = Constants.SERVER_URL;

            String method = params[0];
            if(method.equals("update_user")){
                String Name = params[1];
                String Email = params[2];
                String Password = params[3];
                String PhoneNumber = params[4];
                String NIC = params[5];
                //String UserID = params[6];

                try {
                    URL url = new URL(TempReserveUrl);
                    HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoOutput(true);
                    OutputStream OS = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(OS,"UTF-8"));

                    String data =  URLEncoder.encode("name","UTF-8") + "=" + URLEncoder.encode(Name,"UTF-8") + "&" +
                            URLEncoder.encode("email","UTF-8") + "=" + URLEncoder.encode(Email,"UTF-8") + "&" +
                            URLEncoder.encode("password","UTF-8") + "=" + URLEncoder.encode(Password,"UTF-8") + "&" +
                            URLEncoder.encode("phone_number","UTF-8") + "=" + URLEncoder.encode(PhoneNumber,"UTF-8") + "&" +
                            URLEncoder.encode("nic","UTF-8") + "=" + URLEncoder.encode(NIC,"UTF-8");

                    bufferedWriter.write(data);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    OS.close();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    inputStream.close();
                    return "Update Success";
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


}
