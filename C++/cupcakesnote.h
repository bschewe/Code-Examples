/**
 * cupcakes.cpp
 *
 * <# Blake Schewe #>
 * <# bschewe #>
 *
 * EECS 183: Project 1
 *
 * <# The purpose of this program is create a list of ingredients in order to bake a certain amount of cupcakes, varying on the quantity of cupcakes the user wants to make. #>
 */
 
#include <iostream>
#include <cmath>
#include <string>
using namespace std;

/**
 * Pluralizes a word if needed.
 *
 * Requires: singular is the form of the word.
 *           plural is the plural form of the word.
 *           number determines how many things there are; must be >= 1.
 * Modifies: Nothing.
 * Effects:  Returns return the singular form of the word if number == 1.
 *           Otherwise, returns the plural form.
 * Examples:
 *           cout << pluralize("bag", "bags", 1);
 *           // prints "bag"
 *
 *           string temp = pluralize("pound", "pounds", 3);
 *           cout << temp;
 *           // prints "pounds"
 */
string pluralize(string singular, string plural, int number);

int main() {
    // TODO: implement. Write code here.

    //Declaring the constants of the ingredients for one batch of cupcakes.
    const double allPurposeFlour = 1.5;
    const double granulatedSugar = 1;
    const double bakingPowder = 1.5;
    const double tableSalt = 0.5;
    const double butter = 0.5; //1 stick
    const double sourCream = 0.5;
    const double largeEgg = 1;
    const double eggYolks = 2;
    const double vanillaExtract = 1.5;

    //Declaring the constants of the ingredients for the buttercream frosting, for one batch of cupcakes.
    const double buttercreamButter = 1;
    const double powderedSugar = 2.5;
    const double buttercreamVanillaExtract = 3;

    //Declaring the prices and amounts of each ingredient.
    const double flourCost = 3.09;
    const double flourAmount = 20;
    const double granulatedSugarCost = 2.98;
    const double granulatedSugarAmount = 10;
    const double butterCost = 2.50;
    const double butterAmount = 2;
    const double sourCreamCost = 1.29;
    const double sourCreamAmount = 1;
    const double eggsCost = 2.68;
    const double eggsAmount = 12;
    const double powderedSugarCost = 1.18;
    const double powderedSugarAmount = 5.5;
    const double vanillaCost = 4.12;
    const double vanillaAmount = 12;



    
	int numOfPeople;
	int numOfBatches;
	cout << "How many people do you need to serve? ";
	cin >> numOfPeople;
	numOfBatches = numOfPeople / 12; 
    cout << "You need to make: " << numOfBatches << " " << pluralize("batch", "batches", numOfBatches) << " of cupcakes." << endl;
    
    double flourPurchase = ((allPurposeFlour * numOfBatches) / flourAmount);
    double sugarPurchase = ((granulatedSugar * numOfBatches) / granulatedSugarAmount);
    double butterPurchase = ((butter * numOfBatches) / butterAmount);
    double sourCreamPurchase = ((sourCream * numOfBatches) / sourCreamAmount);
    double eggPurchase = ((largeEgg * numOfBatches) / eggsAmount);
    double powderedSugarPurchase = ((powderedSugar * numOfBatches) / powderedSugarAmount);
    double vanillaPurchase = ((vanillaExtract * numOfBatches) / vanillaAmount);
    double totalCost = (flourPurchase * flourCost) + (sugarPurchase * granulatedSugarCost) + (butterPurchase * butterCost) + (sourCreamPurchase * sourCreamCost) + (eggPurchase * eggsCost) + (powderedSugarPurchase * powderedSugarCost) + (vanillaPurchase * vanillaCost);
    
    cout << "Shopping List for \"Best Ever\" Vanilla Cupcakes" << endl;
    cout << "----------------------------------------------" << endl;
    cout << flourPurchase << " " << pluralize("bag", "bags", numOfBatches) << " of flour" << endl;
    cout << sugarPurchase << " " << pluralize("bag", "bags", numOfBatches) << " of granulated sugar" << endl;
    cout << butterPurchase << " " << pluralize("pound", "pounds", numOfBatches) << " of butter" << endl;
    cout << sourCreamPurchase << " " << pluralize("container", "containers", numOfBatches) << " of sour cream" << endl;
    cout << eggPurchase << " " << pluralize("dozen", "dozen", numOfBatches) << " eggs" << endl;
    cout << powderedSugarPurchase << " " << pluralize("bag", "bags", numOfBatches) << " of powdered sugar" << endl;
    cout << vanillaPurchase << " " << pluralize("bottle", "bottles", numOfBatches) << " of vanilla" << endl;

    cout << "Total exoected cost of ingredients: $" << totalCost << endl << endl;
    cout << "Have a great party!";
    return 0;

    
} 

string pluralize(string singular, string plural, int number) {
    if (number == 1) {
        return singular;
    }
    return plural;
 }


