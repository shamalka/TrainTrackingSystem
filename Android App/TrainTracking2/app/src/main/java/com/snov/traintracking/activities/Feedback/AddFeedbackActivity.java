package com.snov.traintracking.activities.Feedback;

import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.Editable;
import android.view.View;
import android.widget.Button;
import android.widget.EditText;
import android.widget.LinearLayout;
import android.widget.RatingBar;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
import com.snov.traintracking.activities.MainActivity;
import com.snov.traintracking.activities.NewsActivity;
import com.snov.traintracking.activities.PostNewsActivity;
import com.snov.traintracking.utilities.Config;
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
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class AddFeedbackActivity extends AppCompatActivity {

    RatingBar ratingBar;
    TextView Stations;
    EditText FeedbackDescription;
    String FeedbackRating;
    String Description;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_add_feedback);

        Stations = (TextView)findViewById(R.id.stations);
        FeedbackDescription = (EditText)findViewById(R.id.feedback_description);

        addListenerOnRatingBar();

        Description = FeedbackDescription.getText().toString();

        Button SubmitButton = (Button)findViewById(R.id.feedback_submit);
        SubmitButton.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View v) {
                Description = FeedbackDescription.getText().toString();
                //Toast.makeText(AddFeedbackActivity.this,   Description, Toast.LENGTH_SHORT).show();
                try{
                    AddRating();
                }catch(Exception e){
                    Snackbar.make(v, "Already Rated this train", Snackbar.LENGTH_LONG)
                            .setAction("Action", null).show();
                }

            }
        });



    }

    public void addListenerOnRatingBar() {

        ratingBar = (RatingBar) findViewById(R.id.rating_bar);


        //if rating value is changed,
        //display the current rating value in the result (textview) automatically
        ratingBar.setOnRatingBarChangeListener(new RatingBar.OnRatingBarChangeListener() {
            public void onRatingChanged(RatingBar ratingBar, float rating,
                                        boolean fromUser) {

                Stations.setText(String.valueOf(rating));
                FeedbackRating=String.valueOf(rating);

            }
        });
    }

    //function to call asynctask related to sending ratings and descrition to database
    public void AddRating(){


        String Method = "add_rating";

        AddRatingTask addRatingTask = new AddRatingTask(this);
        addRatingTask.execute(Method,Config.SELECTED_TRAIN_ID,Config.USER_EMAIL,FeedbackRating,Description);
    }

    //AsyncTask enables proper and easy use of the UI thread.
    // This class allows you to perform background operations and publish results on the UI thread without having to manipulate threads and/or handlers.
    private class AddRatingTask extends AsyncTask<String,Void,String> {
        Context context;
        LinearLayout linlaHeaderProgress = (LinearLayout) findViewById(R.id.rating_linlaHeaderProgress);
        AddRatingTask(Context context){
            this.context = context;

        }
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            linlaHeaderProgress.setVisibility(View.VISIBLE);
        }

        @Override
        protected String doInBackground(String... params) {

            String AddNewsURL = Constants.ADD_RATING_URL;
            String LoginUrl = Constants.SERVER_URL;

            //Asynctask parameters
            String method = params[0];
            if(method.equals("add_rating")){
                String TrainID = params[1];
                String UserID = params[2];
                String Rating = params[3];
                String RatingDescription = params[4];


                try {
                    URL url = new URL(AddNewsURL);
                    HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoOutput(true);
                    OutputStream OS = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(OS,"UTF-8"));

                    //binding parameters to php POST request
                    String data = URLEncoder.encode("train_id","UTF-8") + "=" + URLEncoder.encode(TrainID,"UTF-8") + "&" +
                            URLEncoder.encode("email","UTF-8") + "=" + URLEncoder.encode(UserID,"UTF-8") + "&" +
                            URLEncoder.encode("train_rating","UTF-8") + "=" + URLEncoder.encode(Rating,"UTF-8") + "&" +
                            URLEncoder.encode("comments","UTF-8") + "=" + URLEncoder.encode(RatingDescription,"UTF-8");

                    bufferedWriter.write(data);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    OS.close();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    inputStream.close();
                    return "Rating Added Successfully.!!";



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

            //Show result on success
            Toast.makeText(context,result,Toast.LENGTH_SHORT).show();
            linlaHeaderProgress.setVisibility(View.GONE);

            AlertDialog alertDialog = new AlertDialog.Builder(AddFeedbackActivity.this).create();
            alertDialog.setTitle("Rating Added");
            alertDialog.setMessage("Thankyou for your contibution.!");
            alertDialog.setIcon(R.drawable.done);
            alertDialog.setButton(AlertDialog.BUTTON_POSITIVE, "OK",
                    new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            Intent intent = new Intent(AddFeedbackActivity.this, MainActivity.class);
                            startActivity(intent);
                            finish();
                        }
                    });
            alertDialog.show();
        }
    }

}
