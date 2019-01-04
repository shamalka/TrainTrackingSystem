package com.snov.traintracking.activities;

import android.os.Bundle;
import android.support.design.widget.FloatingActionButton;
import android.support.design.widget.Snackbar;
import android.support.v7.app.AppCompatActivity;
import android.support.v7.widget.Toolbar;
import android.view.View;
import android.widget.TextView;

import com.snov.traintracking.R;
import com.snov.traintracking.utilities.Config;

public class NewsViewActivity extends AppCompatActivity {

    TextView NewsDesription;
    TextView NewsTitle;
    TextView NewsAuthor;
    TextView NewsDate;

    @Override
    protected void onCreate(Bundle savedInstanceState) {
        super.onCreate(savedInstanceState);
        setContentView(R.layout.activity_news_view);
        Toolbar toolbar = (Toolbar) findViewById(R.id.toolbar);
        setSupportActionBar(toolbar);

        FloatingActionButton fab = (FloatingActionButton) findViewById(R.id.fab);
        fab.setOnClickListener(new View.OnClickListener() {
            @Override
            public void onClick(View view) {
                Snackbar.make(view, "Replace with your own action", Snackbar.LENGTH_LONG)
                        .setAction("Action", null).show();
            }
        });

        NewsDesription = (TextView)findViewById(R.id.news_text);
        NewsTitle = (TextView)findViewById(R.id.news_view_title);
        NewsAuthor = (TextView)findViewById(R.id.news_view_author);
        NewsDate = (TextView)findViewById(R.id.news_view_date);

        NewsDesription.setText(Config.NEWS_DESCRIPTION);
        NewsTitle.setText(Config.NEWS_TITLE);
        NewsAuthor.setText(Config.NEWS_AUTHOR);
        NewsDate.setText(Config.NEWS_DATE);

    }

    @Override
    public void onBackPressed() {
        super.onBackPressed();
        Config.NEWS_DESCRIPTION="";
    }
}
