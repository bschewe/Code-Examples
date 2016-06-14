/**
 * birthdays.cpp
 *
 * <#Name#> Blake Schewe
 * <#Uniqname#> bschewe
 *
 * EECS 183: Project 2
 *
 * <The purpose of this program is for the user to enter a birthdate,
    and the program will return what day of the week the birthdate took place
    on.>
 */

#include <iostream>
#include <cmath>
using namespace std;


/**
 * Requires: Nothing.
 * Modifies: cout.
 * Effects:  Prints out the initial heading for the program.
 */
void printHeading();


/**
 * Requires: year is a Gregorian year.
 * Modifies: Nothing.
 * Effects:  Returns true if the year is a leap year, otherwise returns false.
 */
bool isLeapYear(int year);


/**
 * Requires: Month, day and year are positive integers representing a
 *           valid calendar date.
 * Modifies: Nothing.
 * Effects:  Returns true if the date is on or after September 14, 1752,
 *           otherwise returns false. Remember that if input violates the
 *           Requires clause, the behavior of a function is undefined.
 */
bool isGregorian(int month, int day, int year);


/**
 * Requires: month, day, year may represent a date.
 * Modifies: Nothing.
 * Effects:  Returns true if the date is valid, otherwise returns false.
 */
bool isValidDate(int month, int day, int year);


/**
 * Requires: month, day, year form a valid date.
 * Modifies: Nothing.
 * Effects:  Returns the value that Zeller's formula calculates.
 */
int determineDay(int month, int day, int year);


/**
 * Requires: 0 <= day and day <= 6.
 * Modifies: cout.
 * Effects:  Prints the day you were born on. day 0 is Sat, day 1 is Sun, etc.
 * Example:  You were born on a: Sunday
 */
void printDayBornOn(int day);


int main() {
    int month;
    int day;
    int year;
    printHeading();
    cout << "Enter your date of birth -->";
    cin >> month;
    cin.get();
    cin >> day;
    cin.get();
    cin >> year;
    cin.get();
    cout << endl;
    // Makes sure the date is valid, otherwise prints "Invalid date"
    if (!isValidDate(month, day, year))
    {
        cout << "Invalid date" << endl;
    }
    // Calculates the day of the date entered, if the date is valid
    if (isValidDate(month, day, year))
    { 
        printDayBornOn(determineDay(month, day, year));
        cout << endl << "Have a great birthday!!!";
    }
    return 0;
}

void printHeading() {
    // Prints the heading for user output
    cout << "*******************************" << endl;
    cout << "      Birthday Calculator      " << endl;
    cout << "*******************************" << endl << endl;
}

bool isLeapYear(int year) {
    // Checking the conditions for a leap year
    if ((year % 4) == 0)
    {
        if ((year % 100) == 0)
        {
            return ((year % 400) == 0);
        }
        else
        {
            return true;
        }
    }
    else
    {
        return false;
    }   
}

bool isGregorian(int month, int day, int year) {
    // makes sure the date is in Gregorian form
    if (year <= 1752)
    {
        if (month <= 9)
        {
            return (month == 9 && day >= 14);
        }
        else
        {
            return true;
        }
    }
    else
    {
        return true;
    }
}

bool isValidDate(int month, int day, int year) {
    /* This entire section is validating the date, checking
       the values of all 3 variables day, month, and year */
    if ((month <= 12) && (month >= 1))
    {
        if (month == 9 || month == 4 || month == 6 || month == 11)
        {
            if (day >= 1 && day <= 30)
            {
                return isGregorian(month, day, year);
            }
            else
            {
                return false;
            }
        }
        else if (month == 1 || month == 3 || month == 5 || month == 7 ||
            month == 8 || month == 10 || month == 12)
        {
            if (day >= 1 && day <= 31)
            {
                return isGregorian(month, day, year);
            }
            else
            {
                return false;
            }
        }
        else if (month == 2)
        {
            if (isLeapYear(year))
            {
                if (day >= 1 && day <= 29)
                {
                    return isGregorian(month, day, year);
                }
            }
            else
            {
                if (day >= 1 && day <= 28)
                {
                    return isGregorian(month, day, year);
                }
            }
        }
        else
        {
            return false;
        }
    }
}


int determineDay(int month, int day, int year) {
    if (month == 1)
    {
        month = 13;
        year--;
    }
    if (month == 2)
    {
        month = 14;
        year--;
    }
    // calculates the first two digits of the year
    int century = (year / 100);
    // calculates the last two digits of the year
    int year2 = (year % 100);
    // using the equation given, this is the Zeller formula to get day of week
    int zellerNum = ((day) + (int(floor((13 * (month + 1)) / 5))) + (year2) + 
        (int(floor(year2 / 4))) + (int(floor(century / 4))) + (5) * (century)) % 7;
    return zellerNum;

}


void printDayBornOn(int zellerNum) {
    if (zellerNum == 0)
    {
        cout << "You were born on a: Saturday" << endl;
    }
    else if (zellerNum == 1)
    {
        cout << "You were born on a: Sunday" << endl;
    }
    else if (zellerNum == 2)
    {
        cout << "You were born on a: Monday" << endl;
    }
    else if (zellerNum == 3)
    {
        cout << "You were born on a: Tuesday" << endl;
    }
    else if (zellerNum == 4)
    {
        cout << "You were born on a: Wednesday" << endl;
    }
    else if (zellerNum == 5)
    {
        cout << "You were born on a: Thursday" << endl;
    }
    else if (zellerNum == 6)
    {
        cout << "You were born on a: Friday" << endl;
    }
    else
    {
        cout << "Error" << endl;
    }
}

