package com.snov.traintracking.activities;

import android.app.ProgressDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.EmailHelpers.GMailSender;

public class SendMailActivity extends AppCompatActivity {

    EditText etContent, etRecipient;
    Button btnSend;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_send_mail);

        etRecipient = (EditText)findViewById(R.id.mail_id);
        etContent = (EditText) findViewById(R.id.mail_text);
        btnSend = (Button) findViewById(R.id.mail_submit);
        btnSend.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                sendMessage();
            }
        });
    }

    private void sendMessage() {
        final ProgressDialog dialog = new ProgressDialog(SendMailActivity.this);
        dialog.setTitle("Sending Email");
        dialog.setMessage("Please wait");
        dialog.show();
        Thread sender = new Thread(new Runnable() {
            @Override
            public void run() {
                try {
                    GMailSender sender = new GMailSender("ps4.snov@gmail.com", "0713631082");
                    sender.sendMail("Train Tracking & Reservation",
                            etContent.getText().toString(),
                            "ps4.snov@gmail.com",
                            etRecipient.getText().toString());
                    dialog.dismiss();
                } catch (Exception e) {
                    Log.e("mylog", "Error: " + e.getMessage());
                }
            }
        });
        sender.start();
    }
}
