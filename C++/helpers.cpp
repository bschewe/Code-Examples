/**
 * helpers.cpp
 *
 * <#Names#>
 * <#Uniqnames#>
 *
 * EECS 183: Project 3
 *
 * <#description#>
 */

#include "helpers.h"
#include <iostream>

// ASCII Art

void printLeftAlignedTriangle(int height)
{
    int i;
    int j = 0;

    // nested loops end each line of asterisks when appropriate to form triangle
    while (j < height)
    {
        for (i = 0; i <= j; i++)
        {
            cout << "*";
        }
        cout << endl;
        j++;
    }
}


void printRightAlignedTriangle(int height)
{
    int i;
    int j = 0;

    // nested loops similar to printLeftAlignedTriangle function
    while (j < height)
    {
        for (i = 1; i <= height; i++)
        {
            // if/else indents first '*' in each row so triangle goes right
            if (i < (height - j))
            {
                cout << " ";
            }
            else
            {
                cout << "*";
            }
        }

        cout << endl;
        j++;
    }
}


void printIsosceles(int height)
{
    int i;
    int j;
    int k;

    // This outside loop is the row of the triangle
    for (i = 1; i <= height; i++)
    {
        // Displays spaces on outside if necessary
        for (j = 1; j <= (height - i); j++)
        {
            cout << " ";
        }
        // Displays asterisks centered such that an isosceles triangle is formed
        for (k = 1; k <= ((i * 2) - 1); k++)
        {
            cout << "*";
        }
        cout << endl;
    }
}


// Ciphers

char shiftAlphaCharacter(char c, int n)
{
    int i;

    // if character is lowercase
    if ((c >= 97) && (c <= 122))
    {
        // if n is negative, program works backward
        if (n < 0)
        {
            for (i = -1; i >= n; i--)
            {
                // if c == 'a', resets it to 'z'
                if (c == 97)
                {
                    c = 122;
                }
                else
                {
                    c = c - 1;
                }
            }
        }
        else if (n >= 0)
        {
            for (i = 1; i <= n; i++)
            {
                // if c == 'z', resets it to 'a'
                if (c == 122)
                {
                    c = 97;
                }
                else
                {
                    c = c + 1;
                }
            }
        }
    }


    // exact same code as above but 65-90 represents uppercase values
    else if ((c >= 65) && (c <= 90))
    {
        if (n < 0)
        {
            for (i = -1; i >= n; i--)
            {
                if (c == 65)
                {
                    c = 90;
                }
                else
                {
                    c = c - 1;
                }
            }
        }
        else if (n >= 0)
        {
            for (i = 1; i <= n; i++)
            {
                if (c == 90)
                {
                    c = 65;
                }
                else
                {
                    c = c + 1;
                }
            }
        }
    }
    return c;
}


string caesarCipher(string original, int key, bool encrypt)
{
    int i;
    char value = 'a';
    int number = 0;

    // Finds length of original and stores to number
    while (value != 0)
    {
        value = original[number];
        number++;
    }

    if (encrypt)
    {
        for (i = 0; i < number; i++)
        {
            // Lower case
            if ((original[i] <= 122) && (original[i] >= 97))
            {
                // Positive key = forward encryption
                if (key >= 0)
                {
                    //
                    // key is large enough that original[i] has to reset to 'a'
                    if ((original[i] + key) > 122)
                    {
                        int posCheck = (123 - original[i]);
                        int keyNew = key - posCheck;
                        int y;
                        int keyIt = 0;
                        while ((keyNew / 26) >= 1)
                        {
                            keyIt++;
                            keyNew = keyNew - 26;
                        }
                        original[i] = 97;
                        original[i] += keyNew;
                    }
                    // key doesn't cause original[i] to go thru the whole alphabet
                    else
                    {
                        original[i] = original[i] + (key);
                    }
                }

                // Negative key = backward encryption (or forward decryption)
                else
                {
                    // key is large enough that original[i] resets to 'z'
                    if ((original[i] + (key)) < 97)
                    {
                        int posCheck = (96 - original[i]);
                        int keyNew = posCheck - key;
                        int y;
                        int keyIt = 0;
                        while ((keyNew / 26) >= 1)
                        {
                            keyIt++;
                            keyNew = keyNew - 26;
                        }
                        original[i] = 122;
                        original[i] -= keyNew;
                    }
                    // key doesn't cause original[i] to go thru the whole alphabet
                    else
                    {
                        original[i] = original[i] + (key);
                    }
                }
            }

            // Same, but with upper case characters
            if ((original[i] >= 65) && (original[i] <= 90))
            {
                // Forward encryption
                if (key >= 0)
                {
                    if ((original[i] + key) > 90)
                    {
                        int posCheck = (91 - original[i]);
                        int keyNew = key - posCheck;
                        int y;
                        int keyIt = 0;
                        while ((keyNew / 26) >= 1)
                        {
                            keyIt++;
                            keyNew = keyNew - 26;
                        }
                        original[i] = 65;
                        original[i] += keyNew;
                    }
                    else
                    {
                        original[i] = original[i] + (key);
                    }
                }
                // Backward encryption (or forward decryption)
                else
                {
                    if ((original[i] + key) < 65)
                    {
                        int posCheck = (64 - original[i]);
                        int keyNew = posCheck - key;
                        int y;
                        int keyIt = 0;
                        while ((keyNew / 26) >= 1)
                        {
                            keyIt++;
                            keyNew = keyNew - 26;
                        }
                        original[i] = 90;
                        original[i] -= keyNew;
                    }
                    else
                    {
                        original[i] = original[i] + (key);
                    }
                }
            }

        }
        return original;
    }

    // If user chooses decrypt
    if (!encrypt)
    {
        for (i = 0; i < number; i++)
        {
            // upper case characters
            if ((original[i] <= 122) && (original[i] >= 97))
            {
                if (key >= 0)
                {
                    // if alphabet must reset because key is too big
                    if ((original[i] - key) < 97)
                    {
                        int posCheck = (original[i] - 96);
                        int keyNew = key - posCheck;
                        int y;
                        int keyIt = 0;
                        while ((keyNew / 26) >= 1)
                        {
                            keyIt++;
                            keyNew = keyNew - 26;
                        }
                        original[i] = 122;
                        original[i] -= keyNew;
                    }
                    // if original[i] doesn't need to reset the alphabet
                    else
                    {
                        original[i] = original[i] - (key);
                    }
                }

                // negative decryption (same as positive encryption)
                else
                {
                    if ((original[i] + key) > 122)
                    {
                        int posCheck = (123 - original[i]);
                        int keyNew = key - posCheck;
                        int y;
                        int keyIt = 0;
                        while ((keyNew / 26) >= 1)
                        {
                            keyIt++;
                            keyNew = keyNew - 26;
                        }
                        original[i] = 97;
                        original[i] += keyNew;
                    }
                    else
                    {
                        original[i] = original[i] - (key);
                    }
                }
            }

            // Upper case character decryption
            if ((original[i] >= 65) && (original[i] <= 90))
            {
                // positive key = going backward in alphabet
                if (key >= 0)
                {
                    // key causes original[i] to go thru whole alphabet
                    if ((original[i] - key) < 65)
                    {
                        int posCheck = (original[i] - 64);
                        int keyNew = key - posCheck;
                        int y;
                        int keyIt = 0;
                        while ((keyNew / 26) >= 1)
                        {
                            keyIt++;
                            keyNew = keyNew - 26;
                        }
                        original[i] = 90;
                        original[i] -= keyNew;
                    }
                    // original[i] doesn't make it thru whole alphabet
                    else
                    {
                        original[i] = original[i] - (key);
                    }
                }
                // negative key causes decrypt to work like encrypt with a positive key
                else
                {
                    if ((original[i] - (key)) > 90)
                    {
                        int posCheck = (91 - original[i]);
                        int keyNew = posCheck + key;
                        int y;
                        int keyIt = 0;
                        while ((-keyNew / 26) >= 1)
                        {
                            keyIt++;
                            keyNew = keyNew + 26;
                        }
                        original[i] = 65;
                        original[i] -= keyNew;
                    }
                    else
                    {
                        original[i] = original[i] - (key);
                    }
                }
            }
        }
        return original;
    }
    return original;
}


string removeNonAlphas(string original)
{
    int i;
    int j = 0;

    // initializes string to be returned
    string newstring = " ";

    // runs loop until the last character in the string original
    for (i = 0; i < original.length(); i++)
    {
        // If character is alphabetical, add it to string to be returned
        if (((original[i] >= 65) && (original[i] <= 90)) || ((original[i] >= 97)
            && (original[i] <= 122)))
        {
            newstring[j] = original[i];
            newstring = newstring + " ";
            j++;
        }
    }
    newstring = newstring.substr(0, newstring.length() - 1);
    return newstring;
}


string toUpperCase(string original)
{
    int i;
    char value = 'a';
    int k = 0;

    // finds length of original and stores it to k
    while (value != 0)
    {
        value = original[k];
        k++;
    }

    for (i = 0; i < k; i++)
    {
        // If character is lowercase, changes ASCII to make it lowercase
        if ((original[i] <= 122) && (original[i] >= 97))
        {
            original[i] = original[i] - 32;
        }
    }
    return original;
}