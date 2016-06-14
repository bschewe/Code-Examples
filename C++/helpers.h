/**
 * helpers.h
 *
 * <#Names#>
 * <#Uniqnames#>
 *
 * EECS 183: Project 3
 *
 * <#description#>
 */

#ifndef __helpers__
#define __helpers__

#include <string>
using namespace std;

// ASCII Art

/**
 * Requires: height > 0.
 * Modifies: cout.
 * Effects:  Prints a left-aligned triangle of stars with length and height
 *           equal to the value of height.
 */
void printLeftAlignedTriangle(int height);


/**
 * Requires: height > 0.
 * Modifies: cout.
 * Effects:  Prints a right-aligned triangle of stars with length and height
 *           equal to the value of height.
 */
void printRightAlignedTriangle(int height);


/**
 * Requires: height > 0.
 * Modifies: cout.
 * Effects:  Prints a isosceles triangle of stars whose height is equal to
 *           the value of height.
 */
void printIsosceles(int height);


// Ciphers

/**
 * Requires: c is an alphabetical character.
 * Modifies: Nothing.
 * Effects:  Returns c shifted by n characters.
 *           If c is lowercase, it will remain lowercase.
 *           If c is uppercase, it will remain uppercase.
 */
char shiftAlphaCharacter(char c, int n);


/**
 * Requires: Nothing.
 * Modifies: Nothing.
 * Effects:  If encrypt is true, returns string encrypted with Caesar cipher
 *           using key. If encrypt is false, returns string decrypted with
 *           Caesar cipher using key.
 */
string caesarCipher(string original, int key, bool encrypt);


/**
 * Requires: Nothing.
 * Modifies: Nothing.
 * Effects:  Returns a copy of original string with all non-alphabetical
 *           characters (numbers, symbols, spaces, punctuation marks, etc.)
 *           removed.
 */
string removeNonAlphas(string original);


/**
 * Requires: Nothing.
 * Modifies: Nothing.
 * Effects:  Returns a copy of original string with all alphabetical
 *           characters converted to uppercase. All other characters (numbers,
 *           symbols, spaces, punctuation marks, etc.) are unchanged.
 */
string toUpperCase(string original);


/**
 * Requires: keyword contains at least one alphabetical character.
 * Modifies: Nothing.
 * Effects:  If encrypt is true, returns original string encrypted with
 *           Vigenere cipher using keyword. If encrypt is false, returns
 *           original string decrypted with Vigenere cipher using keyword.
 */
string vigenereCipher(string original, string keyword, bool encrypt);


#endif /* defined(__helpers__) */

