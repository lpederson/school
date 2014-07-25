#include <iostream>
using namespace std;

#include "plane.h"

#ifndef LLQUEUE
#define LLQUEUE

typedef int QueueElementType;
typedef Plane PlaneType;
class LLQueue : Plane
{
private:
	class Node
	{
	public:
		QueueElementType time;
		PlaneType plane;
		Node * next;
		Node(PlaneType myPlane, QueueElementType value, Node * link = 0)
		{
			//Rather than an Integer, can we give each node a Clock?... Airport->global clock, Node->Local Clock
			//...
			//No, we give the Int the value of the global clock... to find wait time->global time - Int = wait time
			plane = myPlane;
			time = value;
			next = link;
		}
	};

	Node * qFront;
	Node * qRear;

public:
    LLQueue();
	LLQueue(const LLQueue & original); // copy constructor
	~LLQueue(); // destructor
	const LLQueue &operator= (const LLQueue & rhs); // assignment
    bool empty() const;
	bool full() const;
    void enqueue(const PlaneType plane,const QueueElementType & value);
    void display(ostream & out) const;
    QueueElementType front() const;
    void dequeue();   
	int countNodes();
};

#endif
