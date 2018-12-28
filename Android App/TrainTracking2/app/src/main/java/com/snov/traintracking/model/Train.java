package com.snov.traintracking.model;

/**
 * Created by Shamalka Navod on 2018-11-13.
 */
public class Train {

    public String Name;
    public String Type;
    public String StartStation;
    public String EndStation;
    public String DepartureTime;
    public String ArrivalTime;
    public Integer NumberOfSeats;
    public Integer TicketPrice;

    void Train(String Name, String Type, String StartStation, String EndStation, String DepartureTime, String ArrivalTime, Integer NumberOfSeats, Integer TicketPrice){
        this.Name = Name;
        this.Type = Type;
        this.StartStation = StartStation;
        this.EndStation = EndStation;
        this.DepartureTime = DepartureTime;
        this.ArrivalTime = ArrivalTime;
        this.NumberOfSeats = NumberOfSeats;
        this.TicketPrice = TicketPrice;
    }




}
