/*
Title: Reservation.java
Author: Luke Pederson 
Abstract: This class extends Date. It has a start & end date (objects), and a vehicle object. 
		  I also used Calendar to verify validity of date. Its pretty messy, but it works. I cited some example code.
ID: 9786
Date: 4/22/12
*/

import java.util.Calendar;
import java.util.Scanner;

public class Reservation extends Vehicle
{
	private Date startDate;
	private Date endDate;
	private Vehicle vehicle;
	
	
	Reservation()
	{
		super();
		startDate = new Date();
		endDate = new Date();
		vehicle = new Vehicle();
	}
	Reservation(Date startDate,Date endDate,Vehicle vehicle)
	{
		this.startDate = new Date(startDate);
		this.endDate = new Date(endDate);
		this.vehicle = new Vehicle(vehicle);
	}
	Reservation(Reservation r)
	{
		this.startDate = r.getStartDate();
		this.endDate = r.getEndDate();
		this.vehicle = r.getVehicle();
	}
	public void setStartDate(int month,int day,int year,int hour,int minute)
	{
		startDate = new Date(month,day,year,hour,minute);
	}
	public void setEndDate(int month,int day,int year,int hour,int minute)
	{
		endDate = new Date(month,day,year,hour,minute);
	}
	public Date getStartDate()
	{
		return new Date(startDate);
	}
	public Date getEndDate()
	{
		return new Date(endDate);
	}
	public void setVehicle(Vehicle v)
	{
		this.vehicle = new Vehicle(v);
	}
	public boolean validReservation()
	{
		//Based on online source - http://stackoverflow.com/questions/8605393/java-initialize-an-calendar-in-a-constructor
		Calendar tempStartDate = Calendar.getInstance();
	    tempStartDate.set(Calendar.YEAR, getStartDate().getYear());
	    tempStartDate.set(Calendar.MONTH, getStartDate().getMonth());
	    tempStartDate.set(Calendar.DAY_OF_MONTH, getStartDate().getDay());
	    tempStartDate.set(Calendar.MINUTE, getStartDate().getMinute());
	    tempStartDate.set(Calendar.HOUR, getStartDate().getHour());
	    
	    Calendar tempEndDate = Calendar.getInstance();
	    tempEndDate.set(Calendar.YEAR, getEndDate().getYear());
	    tempEndDate.set(Calendar.MONTH, getEndDate().getMonth());
	    tempEndDate.set(Calendar.DAY_OF_MONTH, getEndDate().getDay());
	    tempEndDate.set(Calendar.MINUTE, getEndDate().getMinute());
	    tempEndDate.set(Calendar.HOUR, getEndDate().getHour());
		
	    //Snippet from online - http://tripoverit.blogspot.com/2007/07/java-calculate-difference-between-two.html 
		if(tempStartDate.before(tempEndDate))
		{
			return true;
		}
		else
		{
			return false;
		}
	}
	public boolean equals(Reservation r)
	{
		if(!this.startDate.equals(r.getStartDate()))
		{
			return false;
		}
		if(!this.endDate.equals(r.getEndDate()))
		{
			return false;
		}
		if(!vehicle.equals(r.getVehicle()))
		{
			return false;
		}
		return true;
	}
	public String toString()
	{
		return(">>>> Start Date: "+startDate+"\n>>>> End Date: "+endDate+"\n>>>> Vehicle Type: " + vehicle.getType());
	}
	public Vehicle getVehicle()
	{
		return new Vehicle(vehicle);
	}
}
