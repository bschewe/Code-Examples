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

    //Declaring the constants of the ingredients for one batch of cupcakes, frosting included.
    const double allPurposeFlour = 1.5;
    const double granulatedSugar = 1;
    const double bakingPowder = 1.5;
    const double tableSalt = 0.5;
    const double butter = 1.5; // 0.5 cups for the cake batter, 1 cup for the frosting.
    const double sourCream = 0.5;
    const double largeEgg = 1;
    const double eggYolks = 2;
    const double vanillaExtract = 4.5; // from the cake batter (1.5 tsp) plus frosting vanilla (3.5 tsp)
    const double powderedSugar = 2.5; // this is the one ingredient that is solely in the frosting, not in the batter
    //Declaring the constants of the ingredients for the buttercream frosting, for one batch of cupcakes.


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

    //this section gets the input for how many people to serve, and also contains the cal
	int numOfPeople;
	int numOfBatches;
	cout << "How many people do you need to serve? ";
	cin >> numOfPeople;
	numOfBatches = static_cast<int>(numOfPeople / 12);
    if (numOfPeople % 12 > 0)
        numOfBatches++;
    cout << endl << endl;

    // these are the calculations that tell me how much of each ingredient I need to purchase.
    cout << "You need to make: " << numOfBatches << " " << pluralize("batch", "batches", numOfBatches) << " of cupcakes" << endl << endl;
    double flourPurchase = ceil(((allPurposeFlour * numOfBatches) / flourAmount));
    double sugarPurchase = ceil(((granulatedSugar * numOfBatches) / granulatedSugarAmount));
    double butterPurchase = ceil(((butter * numOfBatches) / butterAmount));
    double sourCreamPurchase = ceil(((sourCream * numOfBatches) / sourCreamAmount));
    double eggPurchase = ceil((((largeEgg + eggYolks) * numOfBatches) / eggsAmount));
    double powderedSugarPurchase = ceil(((powderedSugar * numOfBatches) / powderedSugarAmount));
    double vanillaPurchase = ceil(((vanillaExtract * numOfBatches) / vanillaAmount));

    // This algortihm computes the total cost of all of the ingredients.
    double totalCost = (flourPurchase * flourCost) + (sugarPurchase * granulatedSugarCost) + (butterPurchase * butterCost) + (sourCreamPurchase * sourCreamCost) + (eggPurchase * eggsCost) + (powderedSugarPurchase * powderedSugarCost) + (vanillaPurchase * vanillaCost);
    
    //Output for the complete shopping list, along with the header and it's underline
    cout << "Shopping List for \"Best Ever\" Vanilla Cupcakes" << endl;
    cout << "----------------------------------------------" << endl;
    cout << "  " << flourPurchase << " " << pluralize("bag", "bags", flourPurchase) << " of flour" << endl;
    cout << "  " << sugarPurchase << " " << pluralize("bag", "bags", sugarPurchase) << " of granulated sugar" << endl;
    cout << "  " << butterPurchase << " " << pluralize("pound", "pounds", butterPurchase) << " of butter" << endl;
    cout << "  " << sourCreamPurchase << " " << pluralize("container", "containers", sourCreamPurchase) << " of sour cream" << endl;
    cout << "  " << eggPurchase << " " << pluralize("dozen", "dozen", eggPurchase) << " eggs" << endl;
    cout << "  " << powderedSugarPurchase << " " << pluralize("bag", "bags", powderedSugarPurchase) << " of powdered sugar" << endl;
    cout << "  " << vanillaPurchase << " " << pluralize("bottle", "bottles", vanillaPurchase) << " of vanilla" << endl;

    cout << endl << "Total expected cost of ingredients: $" << totalCost << endl << endl;
    cout << "Have a great party!" << endl;
    return 0;

    
} 

//string pluralize function that allows me to pluralize the words for the shopping list
string pluralize(string singular, string plural, int number) {
    if (number == 1) {
        return singular;
    }
    return plural;
 }


