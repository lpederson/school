/*
Title: Date.java
Author: Luke Pederson
Abstract: This class is just a date object. When I wrote it, I hadn't considered that Java already had a built in Date class.
		  Oh well, reinvented a small wheel.
ID: 9786
Date: 4/22/12
 */

public class Date 
{
	private int month;
	private int day;
	private int year;
	private int hour;
	private int minute;
	
	Date()
	{
		month=1;
		day=1;
		year=2012;
		hour=12;
		minute=00;
	}
	Date(int month,int day,int year,int hour,int minute)
	{
		this.month=month;
		this.day=day;
		this.year=year;
		this.minute=minute;
		this.hour=hour;
	}
	Date(Date newDate)
	{
		this.month=newDate.getMonth();
		this.day=newDate.getDay();
		this.year=newDate.getYear();
		this.hour=newDate.getHour();
		this.minute=newDate.getMinute();
	}
	public void setDate(int month,int day,int year,int hour,int minute)
	{
		this.month=month;
		this.day=day;
		this.year=year;
		this.minute=minute;
		this.hour=hour;
	}
	public int getMonth()
	{
		return month;
	}
	public int getDay()
	{
		return day;
	}
	public int getYear()
	{
		return year;
	}
	public int getHour()
	{
		return hour;
	}
	public int getMinute()
	{
		return minute;
	}
	public boolean equals(Date newDate)
	{
		if(this.month != newDate.getMonth())
			return false;
		if(this.day != newDate.getDay())
			return false;
		if(this.year != newDate.getYear())
			return false;
		if(this.hour != newDate.getHour())
			return false;
		if(this.minute != newDate.getMinute())
			return false;
		return true;
	}
	public String toString()
	{
		String Shour;
		if(hour < 10)
			Shour = "0" + hour;
		else
			Shour = "" + hour;
		String Sminute;
		if(minute < 10)
			Sminute = "0" + minute;
		else
			Sminute = "" + minute;	
		
		return(month+"/"+day+"/"+year+" "+Shour+":"+Sminute);
	}
	
}
