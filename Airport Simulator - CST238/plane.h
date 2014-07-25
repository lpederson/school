#include <iostream>
using namespace std;

#ifndef PLANE
#define PLANE

class Plane
{
private:
	int landingTime;
	int takeOffTime;

public:
	Plane();
	Plane(int landingTime,int takeOffTime);
	
	void setLandingTime(int newLandingTime);
	int getLandingTime() const;	
	
	void setTakeOffTime(int newTakeOffTime);
	int getTakeOffTime() const;
};

#endif