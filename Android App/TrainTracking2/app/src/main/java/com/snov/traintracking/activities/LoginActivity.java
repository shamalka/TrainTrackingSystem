package com.snov.traintracking.activities;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.content.SharedPreferences;
import android.graphics.Color;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.Reservation.SelectSeatsActivity;
import com.snov.traintracking.utilities.Config;
import com.snov.traintracking.utilities.Constants;

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

public class LoginActivity extends AppCompatActivity {

    TextView GotoSignUp;

    EditText LoginEmail;
    EditText LoginPassword;

    AlertDialog alertDialog;

    ProgressDialog progressDialog;



    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_login);

        LoginEmail = (EditText)findViewById(R.id.login_email);
        LoginPassword = (EditText)findViewById(R.id.login_password);


        GotoSignUp = (TextView)findViewById(R.id.signup_text);
        GotoSignUp.setOnClickListener(new View.OnClickListener() {
            public void onClick(View v) {
                // Perform action on click
                Intent intent = new Intent(LoginActivity.this, SignUpActivity.class);
                startActivity(intent);
            }
        });

        progressDialog = new ProgressDialog(this);
        progressDialog.setMessage("Loading...");
        progressDialog.setCancelable(false);



    }

    public void OnLogin(View view){
        String UserEmail = LoginEmail.getText().toString();
        String UserPassword = LoginPassword.getText().toString();

        if(UserEmail.contains("@")){
            if(UserPassword.length()>=8){
                String method = "login";
                LoginTask loginTask = new LoginTask(this);
                loginTask.execute(method,UserEmail,UserPassword);
            }else{
                AlertDialog.Builder builder = new AlertDialog.Builder(LoginActivity.this);
                builder.setTitle("Login Failed");
                builder.setMessage("Passwords must be at least 8 characters");
                builder.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
                    public void onClick(DialogInterface dialog, int id) {
                        //do things
                    }
                });
                builder.show();
            }
        }else{
            AlertDialog.Builder builder = new AlertDialog.Builder(LoginActivity.this);
            builder.setTitle("Login Failed");
            builder.setMessage("Invalid Email Address");
            builder.setPositiveButton("Ok", new DialogInterface.OnClickListener() {
                public void onClick(DialogInterface dialog, int id) {
                    //do things
                }
            });
            builder.show();
        }



    }

    private class LoginTask extends AsyncTask<String,Void,String>{
        Context context;
        LoginTask(Context context){
            this.context = context;
        }

        @Override
        protected void onPreExecute() {
            progressDialog.show();
        }

        @Override
        protected String doInBackground(String... params) {
            String method = params[0];
            String LoginUrl = Constants.USER_LOGIN_SERVER_URL;
            if(method.equals("login")){
                try{
                    String user_email = params[1];
                    String user_password = params[2];

                    URL url = new URL(LoginUrl);
                    HttpURLConnection httpURLConnection = (HttpURLConnection) url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoOutput(true);
                    httpURLConnection.setDoInput(true);
                    OutputStream outputStream = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(outputStream, "UTF-8"));
                    String PostData = URLEncoder.encode("user_email","UTF-8") + "=" + URLEncoder.encode(user_email,"UTF-8") + "&" +
                                      URLEncoder.encode("user_password","UTF-8") + "=" + URLEncoder.encode(user_password,"UTF-8");

                    bufferedWriter.write(PostData);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    outputStream.close();

                    InputStream inputStream = httpURLConnection.getInputStream();
                    BufferedReader bufferedReader = new BufferedReader(new InputStreamReader(inputStream,"iso-8859-1"));
                    String result = "";
                    String line;
                    while((line=bufferedReader.readLine())!=null){
                        result+=line;
                    }
                    bufferedReader.close();
                    inputStream.close();
                    httpURLConnection.disconnect();
                    return result;


                }catch (MalformedURLException e){
                    e.printStackTrace();
                } catch (IOException e) {
                    e.printStackTrace();
                }
            }
            return null;
        }

        @Override
        protected void onPostExecute(String result) {

            if(progressDialog.isShowing()) {
                progressDialog.dismiss();
            }

            //Toast.makeText(LoginActivity.this, result , Toast.LENGTH_SHORT).show();
            if(result.contains("Success")){
                SetSharedPref("1", LoginEmail.getText().toString());
                Intent intent = new Intent(LoginActivity.this, MainActivity.class);
                startActivity(intent);
            }else{
                SetSharedPref("0", "");
                Toast.makeText(LoginActivity.this, "Login Failed", Toast.LENGTH_SHORT).show();
//                alertDialog.setMessage(result);
//                alertDialog.show();
            }
        }

        @Override
        protected void onProgressUpdate(Void... values) {
            super.onProgressUpdate(values);
        }
    }

    public void SetSharedPref(String Flag, String Email){
        SharedPreferences sharedPreferences = getSharedPreferences(Config.SHARED_PREFS, MODE_PRIVATE);
        SharedPreferences.Editor editor = sharedPreferences.edit();

        editor.putString(Config.CHECK_LOGIN_PREFS, Flag);
        editor.putString(Config.USER_EMAIL, Email);
        editor.commit();
    }
}
