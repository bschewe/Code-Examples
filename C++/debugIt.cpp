/**
 * debugIt.cpp
 *
 * NAME: <#Blake Schewe#>
 * UNIQNAME: <#bschewe#>
 *
 * EECS 183: Project 2, Winter 2015
 *
 * Due Date: 6 Feb 2015
 *
 * SUMMARY:
 *    This program does ???? -- that's a really good question
 * We do NOT believe this code is good, appropriate, nor acceptable
 * However, it is good for debugging purposes
 *
 */

#include <iostream> 
#include <cstdio>
using namespace std; 

typedef int (* f_p)(int);
static int k = 0;

int add (int x);
f_p addn (int n);
int foo (int, int);
int bar (int, int);

int main ( int argv, char** argc )
{
   printf("Calling (*addn(12))(13): %d\n",
           (addn(12))(13));
   printf("Calling (*addn(1))(3): %d\n",
           (addn(1))(3));
  
   cout << foo(-2,1) << endl;
   cout << foo(4,2) << endl;
   bar(3, 4);
   bar(-3,2);

return 0;
}


int foo( int num1, int num2 )
{
    int bar;

    if( num1 == num2 || num1 < 0 || num2 < 0 ) 
    {
        if (num1 == num2)
           bar = num1;
		else if (num1 < 0)
           bar = num2;
		else
		   bar = num1;
    }
    else
    {
        bar = (num1 > num2)
                 ? foo( num1-num2, num2 )
                 : foo( num1, num2-num1 );
    }
    return bar;
}

int bar( int num1, int num2 )
{
    while( num1 != num2 && num1 > 0 && num2 > 0 )
    {
	   if ( num1 > num2 ) 
	   {
	      num1 -= num2; 
	   }
	   else
	   {   
		   num2 -= num1;
	   }
    }
    return (num1>0) 
		       ? num1-1 
			   : num2+2;
}

f_p addn(int n)
{
   k = n;
   return add ; 
}

int add (int x) 
{ 
	return k + x; 
}

