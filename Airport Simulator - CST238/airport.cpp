#include <iostream>
#include <time>
#include <stdio>
#include <stdlib>
using namespace std;

#include "airport.h"

Airport::Airport()
{
	numberOfTakeOffs = 0;
	numberOfLandings = 0;
	totalTakeOffs = 0;
	totalLandings = 0;
	totalQueueLength = 0;
	planeOnRunway = NULL;
}

void Airport::setFreeRunway()
{
	planeOnRunway = NULL;
}

bool Airport::freeRunway()
{
	if(planeOnRunway == NULL)
		return true;
	else
		return false;
}

void Airport::setRunwayPlane()
{
	if(!takeOff.empty())
	{
		if(takeOff.front() >= 180 || landing.empty()) //3 hours
		{
			planeOnRunway = takeOff.qFront->plane; 
			takeOff.dequeue();
			numberOfTakeOffs++;
			totalTakeOffs++;
			return;
		}
	}
	
	if(!landing.empty())
	{
		planeOnRunway = landing.qFront->plane;
		landing.dequeue();
		numberOfLandings++;
		totalLandings++;
		return;
	}
	
	planeOnRunway = NULL;
}

void Airport::setNumberOfTakeOffs(myInt value);
{
	numberOfTakeOffs = value;
}
myInt Airport::getNumberOfTakeOffs() const
{
	return numberOfTakeOffs;
}
void Airport::setNumberOfLandings(myInt value)
{
	numberOfLandings = value;
}
myInt Airport::getNumberOfLandings() const
{
	return numberOfLandings;
}
myInt Airport::getAvgTakeOff() const
{
	return getNumberOfTakeOffs/60;
}
myInt Airport::getAvgLanding() const
{
	return getNumberOfLandings/60;
}
void Airport::setAvgQueueLength(myInt value)
{
	avgQueueLength = value;
}
myInt Airport::getAvgQueueLength() const
{
	return avgQueueLength;
}
myInt Airport::getTotalTakeOffs() const
{
	return totalTakeOffs;
}
myInt Airport::getTotalLandings() const
{
	return totalLandings;
}

//I don't know how to code this function, vague instructions
//As it is currently written no planes will ever be added.
//The problem is (numberOfTakeOffs/60)
void Airport::addPlanes(int myClock)
{
	srand(time(NULL));
	
	int takeOffRand = rand() % 100 + 1;
	if(takeOffRand < (numberOfTakeOffs/60))
	{
		//New plane!
		this.takeOff.enqueue(new Plane plane,myClock);
	}
	int landRand = rand() % 100 + 1;
	if(landRand < (numberOfLandings/60))
	{
		this.landing.enqueue(new Plane plane,myClock);
	}	
}