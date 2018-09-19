package com.snov.traintracking.activities;

import android.app.ProgressDialog;
import android.content.DialogInterface;
import android.content.Intent;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.view.View;
import android.view.Window;
import android.widget.Button;
import android.widget.EditText;
import android.widget.ProgressBar;

import com.snov.traintracking.R;

public class SignUpActivity extends AppCompatActivity {

    EditText SignUpName;
    EditText SignUpEmail;
    EditText SignUpPassword;
    EditText SignUpPasswordConfirm;

    String Name;
    String Email;
    String Password;




    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_sign_up);


        SignUpName = (EditText)findViewById(R.id.signup_name);
        SignUpEmail = (EditText)findViewById(R.id.signup_email);
        SignUpPassword = (EditText)findViewById(R.id.signup_password);
        SignUpPasswordConfirm = (EditText)findViewById(R.id.signup_password_confirm);




    }

    public void UserRegistration(View view){
        Name = SignUpName.getText().toString();
        Email = SignUpEmail.getText().toString();
        Password = SignUpPassword.getText().toString();


        String Method = "register";


        BackgroundTask backgroundTask = new BackgroundTask(this);
        backgroundTask.execute(Method,Name,Email,Password);

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
    }
}
