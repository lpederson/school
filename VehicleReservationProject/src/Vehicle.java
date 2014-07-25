//Title: Vehicle.java
//Author: Luke Pederson
//Abstract: I made this class late in the project because I had originally forgot about the vehicles... in a car reservation system
//			So, it's just used for the String "type"... I think I got rid of the dates since the owning class "Reservation.java" 
//			already has dates.
//ID: 9786
//Date: 5/9/2012

public class Vehicle extends Date
{
	private String type;
	private Date startDate;
	private Date endDate;
	
	Vehicle()
	{
		super();
		type = "";
		startDate = new Date();
		endDate = new Date();
	}
	Vehicle(String type,Date startDate,Date endDate)
	{
		this.type = type;
		this.startDate = new Date(startDate);
		this.endDate = new Date(endDate);
	}
	Vehicle(Vehicle v)
	{
		this.type = v.getType();
	}
	public String getType()
	{
		return this.type;
	}
	public Date getStartDate()
	{
		return new Date(startDate);
	}
	public Date getEndDate()
	{
		return new Date(endDate);
	}
	public boolean equals(Vehicle v)
	{
		if(!type.equals(v.getType()))
		{
			return false;
		}
		if(!startDate.equals(v.getStartDate()))
		{
			return false;
		}
		if(!endDate.equals(v.getStartDate()))
		{
			return false;
		}
		return true;
	}
	public String toString()
	{
		return ("Type: " + type/* + ", Start Date: " + startDate + ", End Date: " + endDate*/);
	}
}
