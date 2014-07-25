#include <iostream>
#include <time>

using namespace std;

#include "airport.h"

void wait(int seconds);
void doReport(Airport myAirport,int myClock);
void doProgram(Airport myAirport,int myClock);

int main()
{
	int runLength = 0;
	int reportTime = 0;
	int myClock = 0;
	
	cout << "What is the length of the run (minutes [scaled to seconds]): ";
	cin >> runLength;
	
	if(runLength < 0)
	{
		cerr << "ERROR: Invalid Run Length\n";
		exit(1);
	}
	
	cout << "What is the time between reports: ";
	cin >> reportTime;
	
	if(reportTime < 0 || reportTime > runLength)
	{
		cerr << "ERROR: Invalid Report Time\n";
		exit(1);
	}

	Airport myAirport;
	
	for(int i = 0 ; i < runLength ; i++)
	{
		//Do program here
		doProgram(myAirport,myClock);
		
		//Do report - if time and every hour -> (60 sec)
		if( myClock % reportTime == 0 || myClock % 60 == 0)
		{
			doReport(myAirport);
		}
		wait(1);
		myClock++;
	}
	
	cout << "Thank you for using our program!\n";
	cout << "Created by: Luke Pederson and Drew Callan\n";
	
	return 0;
}

// The Clock System - Counts seconds - Treat as minutes.
void wait(int seconds)
{
  clock_t endwait;
  endwait = clock () + seconds * CLOCKS_PER_SEC ;
  while (clock() < endwait) {}
}

void doReport(Airport myAirport,int myClock)
{
	cout << "Number of Take Offs (since last report): " << myAirport.getNumberOfTakeOffs() << endl;
	cout << "Number of Landings (since last report): " << myAirport.getNumberOfLandings() << endl;
	cout << "Total number of Take Offs: " << myAirport.getTotalTakeOffs() << endl;
	cout << "Total number of Landings: " << myAirport.getTotalLandings() << endl;
	cout << "Average Take Off Time: " << myAirport.getAvgTakeOff() << endl;
	cout << "Average Landing Time: " << myAirport.getAvgLanding() << endl;
	cout << "Take Off Queue Length: " << myAirport.takeOff.countNodes() << endl;
	cout << "Landing Queue Length: " << myAirport.landing.countNodes() << endl;
	cout << "First plane in Take Off Queue has been waiting: " << myClock - myAirport.takeOff.front() << " minutes\n";
	cout << "First plane in Landing Queue has been waiting: " << myClock - myAirport.landing.front() << " minutes\n";
	myAirport.setNumberOfTakeOffs(0);
	myAirport.setNumberOfLandings(0);
}

void doProgram(Airport myAirport,int myClock)
{
	//Runway Check
	if(!myAirport.freeRunway())
	{
		if(myAirport.planeOnRunway.getTakeOffTime() >= 0)
		{
			myAirport.planeOnRunway.setTakeOffTime(myAirport.planeOnRunway.getTakeOffTime() - 1);
		}
		//Add plane to runway - Check takeOff and landing Queues
		else
		{
			myAirport.setFreeRunway();
			myAirport.setRunwayPlane();	
		}
	}
	else
	{
		cout << "Runway is FREE and no planes in either queue!\n"
	}
	
	/******************************************************************************************/
	//The code within this function is wrong, program WILL NOT WORK
	//Add planes to queues via Random Generator
	myAirport.addPlanes(myClock);
	//Also, do all planes have the same take off and landing times???
	//Both are currently set to 0 for all planes
	//Needs work - Check "plane.cpp"
	/******************************************************************************************/
}