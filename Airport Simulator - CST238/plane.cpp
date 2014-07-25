#include <iostream>
using namespace std;

#include "plane.h"

Plane::Plane()
{
	landingTime = 0;
	takeOffTime = 0;
}
Plane(int newLandingTime,int newTakeOffTime)
{
	landingTime = newLandingTime;
	takeOffTime = newTakeOffTime;
}
void setLandingTime(int newLandingTime)
{
	landingTime = newLandingTime;
}
void setTakeOffTime(int newTakeOffTime)
{
	takeOffTime = newTakeOffTime;
}
int getLandingTime() const
{
	return landingTime;
}
int getTakeOffTime() const
{
	return takeOffTime;
}