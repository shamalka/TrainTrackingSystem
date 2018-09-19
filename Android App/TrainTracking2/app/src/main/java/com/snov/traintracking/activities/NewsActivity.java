package com.snov.traintracking.activities;

import android.content.Intent;
import android.os.StrictMode;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.View;
import android.widget.Button;
import android.widget.ListView;

import com.snov.traintracking.R;
import com.snov.traintracking.adapters.NewsListAdapter;
import com.snov.traintracking.utilities.Constants;
import com.snov.traintracking.utilities.JsonConfig;

import org.json.JSONArray;
import org.json.JSONObject;

import java.io.BufferedInputStream;
import java.io.BufferedReader;
import java.io.InputStreamReader;
import java.net.HttpURLConnection;
import java.net.URL;

public class NewsActivity extends AppCompatActivity {

    String[] NewsTitle;
    String[] NewsAuthor;
    String[] NewsDate;
    ListView listView;
    BufferedInputStream bis;
    String line = null;
    String result = null;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_news);

        listView = (ListView)findViewById(R.id.NewsList);

        StrictMode.setThreadPolicy((new StrictMode.ThreadPolicy.Builder().permitNetwork().build()));
        collectData();

        NewsListAdapter newsListAdapter = new NewsListAdapter(this, NewsTitle, NewsAuthor, NewsDate);
        listView.setAdapter(newsListAdapter);

        FloatingActionButton AddNews = findViewById(R.id.add_news);
        AddNews.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Intent intent = new Intent(NewsActivity.this, PostNewsActivity.class);
                startActivity(intent);
            }
        });

    }

    private void collectData(){
        //connection
        try {
            URL url = new URL(Constants.SERVER_URL+"?"+ JsonConfig.GET_NEWS_TITLE);
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
            NewsTitle = new String[jsonarray.length()];
            NewsAuthor = new String[jsonarray.length()];
            NewsDate = new String[jsonarray.length()];
            Log.d("data", "received");


            for(int i=0;i<=jsonarray.length();i++){

                jsonobject = jsonarray.getJSONObject(i);
                NewsTitle[i]=jsonobject.getString("title");
                NewsAuthor[i]=jsonobject.getString("author");
                NewsDate[i]=jsonobject.getString("date");



            }


        }catch(Exception e){
            e.printStackTrace();

        }
    }
}
