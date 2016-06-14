// Blake Schewe
// Mitch Mohr

// bschewe
// mohrmi

// Test file for helpers.cpp

#include <iostream>
#include "helpers.h"
using namespace std;



int main()
{
    int height = 3;
    string string1 = "diag @ 11 p.m.";
    string string2 = "ima play dat game,,,...!!! trick";
    string newstring;

    /*  The following cout statements will be calling
    the printLeftAlignedTriangle, printRightAlignedTriangle, and printIsosceles functions.
    This will be testing the function's ability to print
    the ASCII art based on the height given.*/

    if (height > 0)
    {
        printLeftAlignedTriangle(height);
    }

    if (height > 0)
    {
        printRightAlignedTriangle(height);
    }

    if (height > 0)
    {
        printIsosceles(height);
    }

    printIsosceles(10);
    printIsosceles(1);
    newstring = toUpperCase(string1);

    cout << newstring << endl;

    /*  The following cout statements will be calling
    the toUpperCase function, testing the function's ability to convert
    alpha characters to uppercase, while exculding all
    other non-alpha characters.*/

    cout << toUpperCase("this is A test 523432...") << endl;
    cout << toUpperCase("18274bLaKeScHeWe65854") << endl;
    cout << toUpperCase("^&$)%blakeschewe&%*(#)%") << endl;
    cout << toUpperCase("aDcfjhglFuroy") << endl;
    cout << toUpperCase("ABCDEFG") << endl;

    /*  The following cout statements will be calling
    the removeNonAlpha function, testing the function
    for strings that contain characters other than alpha characters.*/

    cout << shiftAlphaCharacter('a', 0) << endl;
    cout << shiftAlphaCharacter('b', 2) << endl;
    cout << shiftAlphaCharacter('X', -1) << endl;
    cout << shiftAlphaCharacter('X', 50) << endl;
    cout << shiftAlphaCharacter('Z', 1) << endl;

    /*  The following cout statements will be calling
    the removeNonAlpha function, testing the function 
    for strings that contain characters other than alpha characters.*/

    cout << removeNonAlphas(string2) << endl;
    cout << removeNonAlphas("Whats really good.") << endl;
    cout << removeNonAlphas("12345abcdz") << endl;

    /*  The following cout statements will be calling 
    the caesarCypher function, testing the function with
    encrypt, decrypt, postitive and negative keys,
    and also for strings that contain characters
    other than alpha characters.*/

    cout << caesarCipher("I love EECS", 25, true) << endl;
    cout << caesarCipher("I love EECS", 26, true) << endl;
    cout << caesarCipher("I love EECS", 27, true) << endl;
    cout << caesarCipher("I love EECS", 25, false) << endl;
    cout << caesarCipher("I love EECS", 26, false) << endl;
    cout << caesarCipher("I love EECS", 27, false) << endl;
    cout << caesarCipher("I love EECS", -25, true) << endl;
    cout << caesarCipher("I love EECS", -26, true) << endl;
    cout << caesarCipher("I love EECS", -27, true) << endl;
    cout << caesarCipher("I love EECS", -25, false) << endl;
    cout << caesarCipher("I love EECS", -26, false) << endl;
    cout << caesarCipher("I love EECS", -27, false) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , 25, true) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , 26, true) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , 27, true) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , 25, false) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , 26, false) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , 27, false) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , -25, true) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , -26, true) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , -27, true) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , -25, false) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , -26, false) << endl;
    cout << caesarCipher("This will test 12345679 numbers &^%#(A$8 and characters"
        , -27, false) << endl;

    return 0;
}