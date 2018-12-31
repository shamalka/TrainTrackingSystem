package com.snov.traintracking.activities;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.utilities.Constants;

import java.io.BufferedWriter;
import java.io.IOException;
import java.io.InputStream;
import java.io.OutputStream;
import java.io.OutputStreamWriter;
import java.net.HttpURLConnection;
import java.net.MalformedURLException;
import java.net.URL;
import java.net.URLEncoder;

/**
 * Created by Shamalka Navod on 2018-09-15.
 */
public class BackgroundTask extends AsyncTask<String,Void,String> {

    Context context;


    BackgroundTask(Context context){
        this.context = context;

    }

    @Override
    protected void onPreExecute() {
        super.onPreExecute();
    }

    @Override
    protected String doInBackground(String... params) {

        String RegisterUrl = Constants.REGISTER_SERVER_URL;
        String LoginUrl = Constants.SERVER_URL;

        String method = params[0];
        if(method.equals("register")){
            String Name = params[1];
            String Email = params[2];
            String Password = params[3];
            String PhoneNumber = params[4];
            String NIC = params[5];

            try {
                URL url = new URL(RegisterUrl);
                HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                httpURLConnection.setRequestMethod("POST");
                httpURLConnection.setDoOutput(true);
                OutputStream OS = httpURLConnection.getOutputStream();
                BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(OS,"UTF-8"));

                String data = URLEncoder.encode("name","UTF-8") + "=" + URLEncoder.encode(Name,"UTF-8") + "&" +
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
                return "Registration Succesful..!!";
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
