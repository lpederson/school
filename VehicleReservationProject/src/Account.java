/*
Title: Account.java
Author: Luke Pederson
Abstract: This class holds account information and an array of reservations
		  An account can have a max of 5 reservations by default
ID: 9786
Date: 4/22/12
 */
import java.util.Scanner;

public class Account extends Reservation
{
	private String firstName;
	private String lastName;
	private String userName;
	private String password;
	private Reservation reservations[] = new Reservation[5];
	private int numReservations = 0;
	
	Account(String firstName,String lastName,String userName,String password)
	{
		this.firstName = firstName;
		this.lastName = lastName;
		this.userName = userName;
		this.password = password;
	}
	Account()
	{
		super();
		firstName = "";
		lastName = "";
		userName = "";
		password = "";	
	}
	public Reservation getLastReservation()
	{ 
		if(numReservations <= 0)
		{
			return null;
		}
		return reservations[numReservations-1];
	}
	public void setFirstName(String firstName)
	{
		this.firstName = firstName;
	}
	public void setLastName(String lastName)
	{
		this.lastName = lastName;
	}
	public void setUserName(String userName)
	{
		this.userName = userName;
	}
	public String getUserName()
	{
		return this.userName;
	}
	public void setPassword(String password)
	{
		this.password = password;
	}
	public String getPassword()
	{
		return this.password;
	}
	public void displayAccountInfo()
	{
		System.out.print("First Name: "+firstName+
					     "Last Name: "+lastName+
					     "UserName: "+userName+
					     "Password: "+password);
	}
	public void addReservation(Reservation pReservation)
	{		
		reservations[numReservations] = new Reservation(pReservation);
		numReservations++;
		System.out.println("Reservation added!");
	}
	public void cancelReservation()
	{
		System.out.println("Closing Reservation...");
		
		if(numReservations ==  0)
		{
			System.out.println("No Reservations!");
			return;
		}
		
		this.displayReservations();

		Scanner input = new Scanner(System.in);
		boolean validInput = false;
		do
		{
			try
			{
				System.out.print("Which account (eg \"2\"): ");
				String sAccountNumber = "";
				sAccountNumber = input.next();
				int accountNumber = Integer.parseInt(sAccountNumber);
				if(accountNumber < 1 || accountNumber > numReservations)
				{
					System.out.println("Invalid Account!");
				}
				else
				{
					validInput = true;
				}
			}
			catch(Exception e)
			{
				System.out.println("Unexpected Error");
			}
		}while(!validInput);
		
		validInput = false;
		String confirm = "";
		do
		{
			try
			{
				System.out.print("Are you sure? (y/n): ");
				confirm = input.next();
			}
			catch(Exception e)
			{
				System.out.println("Unexpected error!");
			}
			if(confirm.equalsIgnoreCase("y"))
			{
				validInput = true;
			}else if(confirm.equalsIgnoreCase("n"))
			{
				System.out.println("Cancellation cancelled");
				return;
			}else
			{
				System.out.println("Invalid input!");
			}
		}while(!validInput);
		
		for(int i=0;i<numReservations-1;i++)
		{
			if(i == numReservations-1)
				break;
			if((i+1) <= numReservations)
			{
				reservations[i] = reservations[i+1];
			}
		}
		numReservations--;
	}
	public void displayReservations()
	{
		if(numReservations == 0)
		{
			System.out.println("No reservations!");
			return;
		}
		for(int i=0;i<numReservations;i++)
		{
			System.out.println("--- Reservation " + (i+1)+":\n"+reservations[i]);
		}
		System.out.println();
	}
	public String toString()
	{
		String oString = "";
		System.out.println("\tFirst Name: " + firstName + "\n" +
						   "\tLast Name : " + lastName + "\n" +
						   "\tUsername  : " + userName);
		for(int i=0;i<numReservations;i++)
		{
			oString += reservations[i];
		}
		return(oString);
	}
	public boolean hasNoReservations()
	{
		if(numReservations <= 0)
		{
			return true;
		}
		else
		{
			return false;
		}
	}
}
