package com.snov.traintracking.activities;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.os.StrictMode;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;
import android.widget.Toast;

import com.snov.traintracking.R;
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
import java.util.concurrent.Executors;

public class SignUpActivity extends AppCompatActivity {

    EditText SignUpName;
    EditText SignUpEmail;
    EditText SignUpPassword;
    EditText SignUpPasswordConfirm;
    EditText SignUpPhoneNumber;
    EditText SignUpNIC;

    String Name;
    String Email;
    String Password;
    String PhoneNumber;
    String NIC;
    String PasswordConfirm;

    String EmailJsonPath;
    BufferedInputStream bis;
    String line = null;
    String result = null;

    String[] EmailArray;
    List<String> EmailArrayList = new ArrayList<String>();

    Boolean EmailCheck=true;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);

        //Toast.makeText(SignUpActivity.this, "1: ", Toast.LENGTH_SHORT).show();
        SignUpName = (EditText)findViewById(R.id.signup_name);
        SignUpEmail = (EditText)findViewById(R.id.signup_email);
        SignUpPassword = (EditText)findViewById(R.id.signup_password);
        SignUpPasswordConfirm = (EditText)findViewById(R.id.signup_password_confirm);
        SignUpPhoneNumber = (EditText)findViewById(R.id.phone_number);
        SignUpNIC = (EditText)findViewById(R.id.nic);


        int SDK_INT = android.os.Build.VERSION.SDK_INT;
        if (SDK_INT > 8)
        {
            StrictMode.ThreadPolicy policy = new StrictMode.ThreadPolicy.Builder()
                    .permitAll().build();
            StrictMode.setThreadPolicy(policy);
            GetEmail();
            FillEmailList();


        }

        //Toast.makeText(SignUpActivity.this, "2: ", Toast.LENGTH_SHORT).show();
       // FillEmailList();


    }

    public void UserRegistration(View view){
        Name = SignUpName.getText().toString();
        Email = SignUpEmail.getText().toString();
        Password = SignUpPassword.getText().toString();
        PasswordConfirm = SignUpPasswordConfirm.getText().toString();
        PhoneNumber = SignUpPhoneNumber.getText().toString();
        NIC = SignUpNIC.getText().toString();
        char V = NIC.charAt(NIC.length()-1);

        String Method = "register";

        if(Password.length()>=8 && Password.equals(PasswordConfirm) && Email.contains("@") && !EmailArrayList.contains(Email) && (V=='v' || V=='x')){
            BackgroundTask backgroundTask = new BackgroundTask(this);
            backgroundTask.execute(Method,Name,Email,Password,PhoneNumber,NIC);

            AlertDialog alertDialog = new AlertDialog.Builder(SignUpActivity.this).create();
            alertDialog.setTitle("Sign Up");
            alertDialog.setMessage("Successfully signed up");
            alertDialog.setIcon(R.drawable.done);
            alertDialog.setButton(AlertDialog.BUTTON_POSITIVE, "OK",
                    new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            Intent intent = new Intent(SignUpActivity.this, LoginActivity.class);
                            startActivity(intent);
                            finish();
                        }
                    });
            alertDialog.show();
        }else if(EmailArrayList.contains(Email)){
            Snackbar.make(view, "Already signed up with this email", Snackbar.LENGTH_LONG)
                    .setAction("Action", null).show();
        }else if(!Email.contains("@")){
            Snackbar.make(view, "Invalid Email address", Snackbar.LENGTH_LONG)
                    .setAction("Action", null).show();
        }else if(!(V=='v' || V=='x')){
            Snackbar.make(view, "Invalid NIC", Snackbar.LENGTH_LONG)
                    .setAction("Action", null).show();
        }else if(!Password.equals(PasswordConfirm)){
            Snackbar.make(view, "Passwords did not match", Snackbar.LENGTH_LONG)
                    .setAction("Action", null).show();
        }else if(Password.length()<8){
            Snackbar.make(view, "Password should have at least 8 characters", Snackbar.LENGTH_LONG)
                    .setAction("Action", null).show();
        }
    }

    public void GetEmail(){

        EmailJsonPath="get_email";
        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ EmailJsonPath);
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
            EmailArray = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);
                EmailArray[i]=jsonobject.getString("email");
                Toast.makeText(SignUpActivity.this, "Seat: " + EmailArray[i], Toast.LENGTH_SHORT).show();



            }


        }catch(Exception e){
            e.printStackTrace();

        }

    }




    public void FillEmailList(){
        for(int i=0; i<EmailArray.length; i++){
            EmailArrayList.add(EmailArray[i]);
        }
    }
}
