package com.snov.traintracking.utilities;

import java.io.Serializable;

/**
 * Created by Shamalka Navod on 2018-09-05.
 */
public class Config implements Serializable {

    public static String TRAIN_ID = "T000";
    public static String JSON_PATH = "PATH";
    public static String CHECK_TRAIN_LIST_REQUEST = "0";



    public static String START_STATION = "Anuradhapura";
    public static String END_STATION = "Colombo";

    //Reservation
    public static String RESERVATION_START_STATION;
    public static String RESERVATION_END_STATION;
    public static String RESERVATION_DATE = "";
    public static String RESERVATION_CLASS;

        //Selected train for reservation, train_id
    public static String SELECTED_TRAIN;

    public static String SELECTED_SEATS;

    //Shared Preferences
    public static final String SHARED_PREFS = "sharedPrefs";
    public static final String CHECK_LOGIN_PREFS = "0";
    public static final String USER_EMAIL_PREFS="";

    //Not Shared Prefs
    public static String CHECK_LOGIN = "0";
    public static String USER_EMAIL = "";

    public static String SELECTED_TRAIN_ID = "T000";
    public static String SELECTED_TICKET_PRICE;

}
