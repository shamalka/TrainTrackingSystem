package com.snov.traintracking.activities;

import android.app.ProgressDialog;
import android.content.Context;
import android.content.DialogInterface;
import android.content.Intent;
import android.os.AsyncTask;
import android.support.v7.app.AlertDialog;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.text.format.DateFormat;
import android.view.View;
import android.widget.EditText;
import android.widget.LinearLayout;
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
import java.text.SimpleDateFormat;
import java.util.Date;
import java.util.Locale;

public class PostNewsActivity extends AppCompatActivity {

    EditText NewsTitle;
    EditText NewsDescription;

    String Title;
    String Description;
    String Author;
    String NewsDate;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_post_news);

        NewsTitle = (EditText)findViewById(R.id.news_title);
        NewsDescription = (EditText)findViewById(R.id.news_description);



    }

    //method to execute onclick of the submit button
    public void AddNews(View view){
        Title = NewsTitle.getText().toString();
        Description = NewsDescription.getText().toString();
        Author = "User";
        //get current date and time
        NewsDate = new SimpleDateFormat("yyyy-MM-dd", Locale.getDefault()).format(new Date());
        String mytime = (DateFormat.format("hh:mm:ss", new java.util.Date()).toString());

        //method identifire
        String Method = "add_news";

        AddNewsTask addNewsTask = new AddNewsTask(this);
        addNewsTask.execute(Method,Title,Description,Author,NewsDate,mytime);
    }

    //AsyncTask enables proper and easy use of the UI thread.
    // This class allows you to perform background operations and publish results on the UI thread without having to manipulate threads and/or handlers.
    private class AddNewsTask extends AsyncTask<String,Void,String> {
        Context context;
        LinearLayout linlaHeaderProgress = (LinearLayout) findViewById(R.id.linlaHeaderProgress);
        AddNewsTask(Context context){
            this.context = context;

        }
        @Override
        protected void onPreExecute() {
            super.onPreExecute();
            linlaHeaderProgress.setVisibility(View.VISIBLE);
        }

        @Override
        protected String doInBackground(String... params) {

            String PostNewsURL = Constants.POST_NEWS_SERVER_URL;
            String LoginUrl = Constants.SERVER_URL;

            String method = params[0];
            if(method.equals("add_news")){
                String Title = params[1];
                String Description = params[2];
                String Author = params[3];
                String NewsDate = params[4];
                String Time = params[5];


                try {
                    URL url = new URL(PostNewsURL);
                    HttpURLConnection httpURLConnection = (HttpURLConnection)url.openConnection();
                    httpURLConnection.setRequestMethod("POST");
                    httpURLConnection.setDoOutput(true);
                    OutputStream OS = httpURLConnection.getOutputStream();
                    BufferedWriter bufferedWriter = new BufferedWriter(new OutputStreamWriter(OS,"UTF-8"));

                    String data = URLEncoder.encode("title","UTF-8") + "=" + URLEncoder.encode(Title,"UTF-8") + "&" +
                            URLEncoder.encode("description","UTF-8") + "=" + URLEncoder.encode(Description,"UTF-8") + "&" +
                            URLEncoder.encode("author","UTF-8") + "=" + URLEncoder.encode(Author,"UTF-8") + "&" +
                            URLEncoder.encode("dates","UTF-8") + "=" + URLEncoder.encode(NewsDate,"UTF-8") + "&" +
                            URLEncoder.encode("time","UTF-8") + "=" + URLEncoder.encode(Time,"UTF-8");

                    bufferedWriter.write(data);
                    bufferedWriter.flush();
                    bufferedWriter.close();
                    OS.close();
                    InputStream inputStream = httpURLConnection.getInputStream();
                    inputStream.close();
                    return "News Added Successfully.!!";



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
            linlaHeaderProgress.setVisibility(View.GONE);


            AlertDialog alertDialog = new AlertDialog.Builder(PostNewsActivity.this).create();
            alertDialog.setTitle("News Posted");
            alertDialog.setMessage("Wait for the confirmation by Admin");
            alertDialog.setIcon(R.drawable.done);
            alertDialog.setButton(AlertDialog.BUTTON_POSITIVE, "OK",
                    new DialogInterface.OnClickListener() {
                        public void onClick(DialogInterface dialog, int which) {
                            Intent intent = new Intent(PostNewsActivity.this, NewsActivity.class);
                            startActivity(intent);
                            finish();
                        }
                    });
            alertDialog.show();
        }
    }




}

