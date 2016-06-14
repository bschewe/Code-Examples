/**
 * ciphers.cpp
 *
 * <# Blake Schewe and Mitch Mohr #>
 * <# bschewe and mohrmi #>
 *
 * EECS 183: Project 3
 *
 * Encrypts messages using Caesar and Vigenere ciphers.
 * 
 * Not required for submission.
 * How can this program be improved?
 */

#include <iostream>
#include <string>
#include "helpers.h"
using namespace std;

/**
 * Requires: Nothing.
 * Modifies: cout, cin.
 * Effects:  Prints prompt, then reads a line from standard input until '\n'
 *           and returns that line.
 */
string getString(string prompt);

int main() {
    
    // get cipher type, message and mode from user
    string cipher = getString("Choose a cipher (Caesar or Vigenere): ");
    string message = getString("Enter a message: ");
    string mode = toUpperCase(getString("Encrypt or decrypt? "));
    
    if (toUpperCase(cipher) == "CAESAR") {
        
        // get key from user
        cout << "What is your key? ";
        int key = 0;
        cin >> key;
        
        cout << caesarCipher(message, key, mode == "ENCRYPT") << endl;
        
    } else {
        
        // get keyword from user
        string keyword = getString("What is your keyword? ");
        
        // check if keyword is not empty
        if (!keyword.length())
        {
            cout << "Invalid key" << endl;
            return 1;
        }
        
        cout << vigenereCipher(message, keyword, mode == "ENCRYPT") << endl;
    }
    system("PAUSE");
    return 0;
}

string getString(string prompt)
{
    cout << prompt;
    
    // read line
    string input;
    getline(cin, input);
    
    return input;
}

