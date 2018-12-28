package com.snov.traintracking.activities;

import android.app.Activity;
import android.content.Intent;
import android.os.StrictMode;
import android.support.annotation.NonNull;
import android.support.annotation.Nullable;
import android.support.design.widget.FloatingActionButton;
import android.support.v7.app.AppCompatActivity;
import android.os.Bundle;
import android.util.Log;
import android.view.LayoutInflater;
import android.view.View;
import android.view.ViewGroup;
import android.widget.ArrayAdapter;
import android.widget.Button;
import android.widget.ListView;
import android.widget.TextView;
import android.widget.Toast;

import com.snov.traintracking.R;
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

    private class NewsListAdapter extends ArrayAdapter<String> {

        private String[] NewsTitle;
        private String[] NewsAuthor;
        private String[] NewsDate;
        private Activity context;

        private NewsListAdapter(Activity context, String[] NewsTitle, String[] NewsAuthor, String[] NewsDate) {
            super(context, R.layout.activity_news, NewsTitle);
            this.context = context;
            this.NewsTitle = NewsTitle;
            this.NewsAuthor = NewsAuthor;
            this.NewsDate = NewsDate;
        }



        @NonNull
        @Override

        public View getView(final int position, @Nullable View convertView, @NonNull ViewGroup parent){
            View r = convertView;
            ViewHolder viewHolder = null;

            if(r==null){
                LayoutInflater layoutInflater = context.getLayoutInflater();
                r = layoutInflater.inflate(R.layout.news_list_item,null,true);
                r.setOnClickListener(new View.OnClickListener() {
                    public void onClick(View v) {
                        Toast.makeText(getContext(), "Go to  " + NewsTitle[position], Toast.LENGTH_SHORT).show();
                    }
                });
                viewHolder = new ViewHolder(r);
                r.setTag(viewHolder);
            }else{
                viewHolder = (ViewHolder)r.getTag();
            }

            viewHolder.news_title.setText(NewsTitle[position]);
            viewHolder.news_author.setText(NewsAuthor[position]);
            viewHolder.news_date.setText(NewsDate[position]);


            return r;

        }

        class ViewHolder{
            TextView news_title;
            TextView news_author;
            TextView news_date;


            ViewHolder(View v){
                news_title = (TextView)v.findViewById(R.id.title);
                news_author = (TextView)v.findViewById(R.id.author);
                news_date = (TextView)v.findViewById(R.id.date);
            }


        }
    }

}
