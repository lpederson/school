/*
Title: Project2App.java
Author: Luke Pederson
Abstract: This program runs a car reservation system simulator - Using subclasses
		  There is a lot of interconnectivity with the "Account.java" class so it's hard to follow.
		  This class handles a lot of the work. The whole class is run in it's constructor, not main.
		  P.S. When I was first writing this, I'd thought it would be the main... So the class name is weird.
ID: 9786
Date: 4/21/12
 */

import java.util.Scanner;
import java.util.Date;
import java.text.DateFormat;
import java.text.SimpleDateFormat;
import java.util.Calendar;

public class Project2App //extends JPanel implements ActionListener
{			
	private static String log = "";
	private static int numTransactions = 0;
	
	private Account adminAccount = new Account("Luke","Pederson","admin2","admin2");
	
	private int numTrucks = 3;
	private int numCars = 3;
	private int numVans = 3;
	
	private double costTruck = 35.00;
	private double costCar = 25.00;
	private double costVan = 50.00;
	
	private Account accounts [] = new Account[10];
	private int numAccounts = 0;
	
	Scanner input = new Scanner(System.in);
		
	Project2App()
	{
		super();
		String Schoice = "";
		int choice = 0;
		
		System.out.println("Hello to our car reservation system.");
		boolean flag = false;
		do
		{
			printMenu();
			try
			{
				System.out.print("Choice: ");
				Schoice = input.next();
				//choice = input.nextInt();
				choice = Integer.parseInt(Schoice);
			}
			catch(Exception e)
			{
				//System.out.println("\nError: Unexpected Input");
				choice = 0;
			}
			if(choice == 1)
			{
				createAccount();
			}
			else if(choice == 2)
			{
				addReservation();
			}
			else if(choice == 3)
			{
				cancelReservation();
			}
			else if(choice == 4)
			{
				System.out.println("Goodbye!");
				System.exit(1);
			}
			else
			{
				System.out.println("Invalid Choice...");
			}
			System.out.println();
		}
		while(!flag);
	}
	public void printAccounts()
	{
		if(numAccounts == 0)
		{
			System.out.println("No accounts exist!");
			return;
		}
		for(int i=0;i<numAccounts;i++)
		{
			System.out.println("Account Number "+(i+1)+":");
			System.out.print(accounts[i]);
		}
		System.out.println();
	}
	public void printMenu()
	{
		System.out.println("Main Menu\n"+
                "Enter your choice...\n"+
                "1: Create Account\n" +
				"2: Add reservation\n" +
				"3: Cancel reservation\n" +
				"4: Exit");
	}
	public static void printLog()
	{
		if(log.equals(""))
		{
			System.out.println("Log is empty!");
			return;
		}
		System.out.println(log);
		return;
	}
	public void createAccount()
	{
		String firstName = "";
		String lastName = "";
		String userName = "";
		String password = "";
		
		boolean validInput = false;
		int numberOfTries = 0;

		System.out.println("Creating Account - Enter Account Info...");
		
		//Get names
		do
		{
			try
			{
				System.out.print("Enter first name: ");
				firstName = input.next();
				System.out.print("Enter last name: ");
				lastName = input.next();
				validInput = true;
			}
			catch(Exception e)
			{
				System.out.println("Unexpected Error");
			}
		} while(!validInput);
		validInput = false;
		
		//Get username
		do
		{
			try
			{
				numberOfTries++;
				System.out.print("Enter username: ");
				userName = input.next();
				
				boolean hasDigit = false;
				boolean hasChar = false;
				for(int i=0;i<userName.length();i++)
				{
					if(Character.isDigit(userName.charAt(i)))
					{
						hasDigit = true;
					}
					if(Character.isLetter(userName.charAt(i)))
					{
						hasChar = true;
					}
				}
				if(hasChar /*&& hasDigit*/)
				{	
					validInput = true;
				}
				if(userName.equals("admin2"))
				{	
					System.out.println("That username is taken.");
					validInput = false;
				}
				if(userName.length() < 5)
				{
					System.out.println("Username must be at least 5 characters.");
					validInput = false;
				}
				for(int i=0;i<numAccounts;i++)
				{
					if(userName.equals(accounts[i].getUserName()))
					{
						System.out.println("That username is taken.");
						validInput = false;
						break;
					}
				}
			}
			catch(Exception e)
			{
				System.out.println("Unexpected Error!");
			}
		}while(!validInput && numberOfTries < 2);
		if(!validInput)
		{
			System.out.println("Failed to create account...");
			return;
		}
		validInput = false;
		numberOfTries = 0;
		
		//Get password
		do
		{
			try
			{
				numberOfTries++;
				System.out.print("Password must contain:\n\tat least 1 digit\n\tand 1 character\n\t"+
								"5 characters in length\nPassword: ");	
				password = input.next();
				
				boolean hasDigit = false;
				boolean hasChar = false;
				for(int i=0;i<password.length();i++)
				{
					if(Character.isDigit(password.charAt(i)))
					{
						hasDigit = true;
					}
					if(Character.isLetter(password.charAt(i)))
					{
						hasChar = true;
					}
				}
				if(hasDigit && hasChar)
				{
					validInput = true;
				}
			}
			catch(Exception e)
			{
				System.out.println("Unexpected Error!");
			}
		}while(!validInput && numberOfTries < 2);
		if(!validInput)
		{
			System.out.println("Failed to create account...");
			return;
		}
		
		accounts[numAccounts] = new Account(firstName,lastName,userName,password);
		numAccounts++;
		
	    //log += 
		System.out.println("Account Created...");
		System.out.println(accounts[numAccounts-1]);
		
		numTransactions++;
		concatToLog("Transaction " + numTransactions + ": Account created --- "  
									+ "Username: " + userName + ", " + generateTimeStamp() + "\n");
	}
	public void addReservation()
	{
		System.out.println("\nAdding reservation...");
		boolean validReservation = false;
		Scanner input = new Scanner(System.in);

		//Possible reservation
		Reservation pReservation = new Reservation();
		
		do{
			System.out.println("Setting Start Date: ");
			
			boolean flag = false;
			int month = 0;
			int day = 0;
			int year = 0;
			int hour = 0;
			int minute = 0;
			
			do
			{
				//Add StartDate
				try
				{
					System.out.print("Enter date (eg. \"03/12/2012\"): ");
					String dateAsString = input.next();
					String dateSplit[] = dateAsString.split("/");
					
					if(dateSplit.length != 3)
					{
						System.out.println("Invalid Input.");
						continue;
					}
					
					month = Integer.parseInt(dateSplit[0]);
					day = Integer.parseInt(dateSplit[1]);
					year = Integer.parseInt(dateSplit[2]);
					
					if(month != 6 || day < 1 || day > 30 || year != 2012)
					{
						System.out.println("Invalid Input");
						continue;
					}
					else
					{
						flag = true;
					}
				}
				catch(Exception e)
				{
					System.out.print("Invalid Input!\nError code: "+e);
				}		
			} while(!flag);
			flag = false;
			
			do
			{
				try
				{
					//Add Time
					System.out.print("Enter time (eg. \"14:00\"): ");
					String timeAsString = input.next();
					String timeSplit[] = timeAsString.split(":");
					
					if(timeSplit.length != 2)
					{
						System.out.println("Invalid Input.");
						continue;
					}
					
					hour = Integer.parseInt(timeSplit[0]);
					minute = Integer.parseInt(timeSplit[1]);
	
					if(hour < 0 || hour > 23 || minute < 0 || minute > 59)
					{
						System.out.println("Invalid Input");
						continue;
					}
					else
					{
						flag = true;
					}
				}
				catch(Exception e)
				{
					System.out.print("Invalid Input!\nError code: "+e);
				}
			}while(!flag);
			flag = false;
			
			pReservation.setStartDate(month,day,year,hour,minute);
			System.out.println();
			
			
			//Add endDate
			System.out.println("Setting End Date: ");
				
			month = 0;
			day = 0;
			year = 0;
			hour = 0;
			minute = 0;
			
			do
			{
				//Add StartDate
				try
				{
					System.out.print("Enter date (eg. \"03/12/2012\"): ");
					String dateAsString = input.next();
					String dateSplit[] = dateAsString.split("/");
					
					if(dateSplit.length != 3)
					{
						System.out.println("Invalid Input.");
						continue;
					}
					
					month = Integer.parseInt(dateSplit[0]);
					day = Integer.parseInt(dateSplit[1]);
					year = Integer.parseInt(dateSplit[2]);
					
					if(month != 6 || day < 1 || day > 30 || year != 2012)
					{
						System.out.println("Invalid Input");
						continue;
					}
					else
					{
						flag = true;
					}
				}
				catch(Exception e)
				{
					System.out.print("Invalid Input!\nError code: "+e);
				}		
			} while(!flag);
			flag = false;
			
			do
			{
				try
				{
					//Add Time
					System.out.print("Enter time (eg. \"14:00\"): ");
					String timeAsString = input.next();
					String timeSplit[] = timeAsString.split(":");
					
					if(timeSplit.length != 2)
					{
						System.out.println("Invalid Input.");
						continue;
					}
					
					hour = Integer.parseInt(timeSplit[0]);
					minute = Integer.parseInt(timeSplit[1]);
	
					if(hour < 0 || hour > 23 || minute < 0 || minute > 59)
					{
						System.out.println("Invalid Input");
						continue;
					}
					else
					{
						flag = true;
					}
				}
				catch(Exception e)
				{
					System.out.print("Invalid Input!\nError code: "+e);
				}
			}while(!flag);
			
			pReservation.setEndDate(month,day,year,hour,minute);
	
			if(pReservation.validReservation())
			{
				validReservation = true;
			}
			else
			{
				System.out.println("\nInvalid reservation due to time conflict.");
			}
		}while(!validReservation);
		
		System.out.println("\nAvailable Vehicles: \n1. Minivan - $50.00/day\n2. Sedan - $25.00/day" +
							"\n3. Truck - $35.00/day");
		System.out.print("What vehicle would you like?: ");
		boolean validInput = false;
		int vehicleType = -1;
		String sVehicleType = "";
		do
		{
			try
			{
				sVehicleType = input.next();
				vehicleType = Integer.parseInt(sVehicleType);
			}
			catch(Exception e)
			{
				System.out.println("Unexpected error!");
			}
			if(vehicleType < 1 || vehicleType > 3)
			{
				System.out.println("Invalid Selection!");
			}
			else
			{
				validInput = true;
			}
		}while(!validInput);
		validInput = false;
		
		//Generate bill
		double totalBill = 0.0;
		
		//Based on online source - http://stackoverflow.com/questions/8605393/java-initialize-an-calendar-in-a-constructor
		Calendar tempStartDate = Calendar.getInstance();
	    tempStartDate.set(Calendar.YEAR, pReservation.getStartDate().getYear());
	    tempStartDate.set(Calendar.MONTH, pReservation.getStartDate().getMonth());
	    tempStartDate.set(Calendar.DAY_OF_MONTH, pReservation.getStartDate().getDay());
	    tempStartDate.set(Calendar.MINUTE, pReservation.getStartDate().getMinute());
	    tempStartDate.set(Calendar.HOUR, pReservation.getStartDate().getHour());
	    
	    Calendar tempEndDate = Calendar.getInstance();
	    tempEndDate.set(Calendar.YEAR, pReservation.getEndDate().getYear());
	    tempEndDate.set(Calendar.MONTH, pReservation.getEndDate().getMonth());
	    tempEndDate.set(Calendar.DAY_OF_MONTH, pReservation.getEndDate().getDay());
	    tempEndDate.set(Calendar.MINUTE, pReservation.getEndDate().getMinute());
	    tempEndDate.set(Calendar.HOUR, pReservation.getEndDate().getHour());
		
	    //Snippet from online - http://tripoverit.blogspot.com/2007/07/java-calculate-difference-between-two.html 
		int daysBetween = 0;  
		while (tempStartDate.before(tempEndDate)) {  
			tempStartDate.add(Calendar.DAY_OF_MONTH, 1);  
			daysBetween++;  
		}  
		if(daysBetween == 0)
		{
			daysBetween = 1;
		}
		if(vehicleType == 1) //Minivan 50
		{
			pReservation.setVehicle(new Vehicle("Minivan",pReservation.getStartDate(),pReservation.getEndDate()));
			totalBill = daysBetween * 50.00;
		} else if(vehicleType == 2) // Sedan 25
		{
			pReservation.setVehicle(new Vehicle("Sedan",pReservation.getStartDate(),pReservation.getEndDate()));
			totalBill = daysBetween * 25.00;
		} else if(vehicleType == 3) // Truck 35
		{
			totalBill = daysBetween * 35.00;
			pReservation.setVehicle(new Vehicle("Truck",pReservation.getStartDate(),pReservation.getEndDate()));
		}
		
		//Get account
		//Get username
		String userName = "";
		String password = "";
		int accountNumberMatch = -1;
		int numberOfTries = 0;
		System.out.println();
		do
		{
			System.out.print("Username: ");
			try
			{
				userName = input.next();
			}
			catch(Exception e)
			{
				System.out.println("Unexpected error!");
			}
			for(int i=0;i<numAccounts;i++)
			{
				if(userName.equals(accounts[i].getUserName()))
				{
					validInput = true;
					accountNumberMatch = i;
					break;
				}
			}
			numberOfTries++;
		}
		while(!validInput && numberOfTries < 2);
		if(!validInput)
		{
			System.out.println("Failed to verify username...");
			return;
		}
		validInput = false;
		numberOfTries = 0;
		
		//Verify password
		do
		{
			System.out.print("Password: ");
			try
			{
				password = input.next();
			}
			catch(Exception e)
			{
				System.out.println("Unexpected error!");
			}
			if(password.equals(accounts[accountNumberMatch].getPassword()))
			{
				validInput = true;
			}
			numberOfTries++;
		}
		while(!validInput && numberOfTries < 2);
		if(!validInput)
		{
			System.out.println("Failed to verify password...");
			return;
		}
		validInput = false;

		System.out.println("Confirmation:");
		System.out.println("Username: " + userName +
							"\nStart Date: " + pReservation.getStartDate() + "\nEnd Date: " +
							pReservation.getEndDate() + "\n" +
							"Vehicle Type: " + pReservation.getVehicle().getType() +
							"\nTotal Due: $" + totalBill + "0");
		String confirmation = "";
		do
		{
			try
			{
				System.out.print("Confirm? (y/n): ");
				confirmation = input.next();
			}
			catch(Exception e)
			{
				System.out.println("Invalid Input!");
			}	
			if(confirmation.equalsIgnoreCase("y"))
			{
				validInput = true;
			}else if(confirmation.equalsIgnoreCase("n"))
			{
				System.out.println("Reservation cancelled!");
				return;
			}else
			{
				System.out.println("Invalid input!");
			}
		}while(!validInput);
		
		Account editAccount = accounts[accountNumberMatch];
		editAccount.addReservation(pReservation);
		numTransactions++;
		concatToLog("Transaction " + numTransactions + ": Add Reservation - " + pReservation + ", Amount: " + totalBill + ", " + generateTimeStamp());	
	}
	public void cancelReservation()
	{
		System.out.println("\nCancel Reservation...");
		boolean validInput = false;
		int accountNumberMatch = -1;
		
		//Get account
		String userName = "";
		String password = "";
		accountNumberMatch = -1;
		int numberOfTries = 0;
		try
		{
			do
			{
				//Get username
				System.out.print("Username: ");
				try
				{
					userName = input.next();
				}
				catch(Exception e)
				{
					System.out.println("Unexpected error!");
				}
				for(int i=0;i<numAccounts;i++)
				{
					if(userName.equals(accounts[i].getUserName()))
					{
						accountNumberMatch = i;
						validInput = true;
					}
				}
				if(userName.equals(adminAccount.getUserName()))
				{
					validInput = true;
				}
				numberOfTries++;
			}
			while(!validInput && numberOfTries < 2);
			if(!validInput)
			{
				System.out.println("Failed to verify username...");
				return;
			}
			validInput = false;
			numberOfTries = 0;
			
			//Verify password
			do
			{
				System.out.print("Password: ");
				try
				{
					password = input.next();
					
					if(userName.equals(adminAccount.getUserName()))
					{
						if(password.equals(adminAccount.getPassword()))
						{
							validInput = true;
						}
					}
					if(accountNumberMatch != -1)
						if(password.equals(accounts[accountNumberMatch].getPassword()))
						{
							validInput = true;
						}
				}
				catch(Exception e)
				{
					System.out.println("Unexpected error!");
				}
				numberOfTries++;
			}
			while(!validInput && numberOfTries < 2);
			if(!validInput)
			{
				System.out.println("Failed to verify password...");
				return;
			}
			if(userName.equals("admin2"))
			{
				printLog();
				boolean validInputAdmin = false;
				String exitConfirm = "";
				do
				{
					try
					{
						System.out.print("Exit? (y/n): ");
						exitConfirm = input.next();
						if(exitConfirm.equalsIgnoreCase("y"))
						{
							return;
						}
					}
					catch(Exception e)
					{
						System.out.println("Unexpected error!");
					}
				}
				while(!validInputAdmin);
				return;
			}
			if(accounts[accountNumberMatch].hasNoReservations())
			{
				System.out.println("No reservations!");
				return;
			}
			validInput = false;
			
		}
		catch(Exception e)
		{
			System.out.println("Unexpected Error!");
		}
		if(!userName.equals(adminAccount.getUserName()))
		{
			//accounts[accountNumberMatch].displayReservations();
			accounts[accountNumberMatch].cancelReservation();
			numTransactions++;
			concatToLog("Transaction " + numTransactions + ": Cancel Reservation - " + accounts[accountNumberMatch].getLastReservation() + ", " + generateTimeStamp());
		}
	}
	private void concatToLog(String s)
	{
		String s2 = s.replaceAll("\\n"," ");
		log += s2 + "\n";
	}
	private String generateTimeStamp()
	{
	   String s = "";
	   DateFormat dateFormat = new SimpleDateFormat("yyyy/MM/dd HH:mm:ss");
 
	   //get current date time with Calendar()
	   Calendar cal = Calendar.getInstance();
	   s += dateFormat.format(cal.getTime());
	   return s;
	}
}



