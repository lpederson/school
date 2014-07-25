#include <iostream>
using namespace std;

#include "LLQueue.h"

#ifndef AIRPORT
#define AIRPORT

typedef int myInt;

class Airport : LLQueue //Forgot how to set derived class
{
	private:
	
		//Reporting 
		myInt numberOfTakeOffs;
		myInt numberOfLandings;
		myInt QueueLength;
		
		LLQueue takeOff;
		LLQueue landing;
		
		Plane * planeOnRunway;
		
		//Reporting at end of program
		myInt totalTakeOffs;
		myInt totalLandings;
		myInt totalQueueLength;
		
		
	public:
	
		Airport();
		
		void setFreeRunway();
		bool freeRunway() const;
		void setRunwayPlane();
		
		void setNumberOfTakeOffs();
		myInt getNumberOfTakeOffs() const;
		
		void setNumberOfLandings();
		myInt getNumberOfLandings() const;
		
		myInt getAvgTakeOff() const;
		
		myInt getAvgLanding() const;
		
		void setQueueLength();
		myInt getQueueLength() const;	
		
		myInt getTotalTakeOffs() const;
		myInt getTotalLandings() const;
		
		void addPlanes(int myClock);
};
#endif