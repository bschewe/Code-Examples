## Problem Set 8
import test

## Please write your name here in a comment -- makes it easier for us grading!

## All graded problems are marked with [PROBLEM <#>].



###### Using urllib2 to get the contents of a web page

# [PROBLEM 1]

# First, point your web browser to the following URL:
#   http://services.faa.gov/airport/status/DTW?format=json
#
# You'll get something back that looks like a python dictionary. 
# It's actually in json format, which you'll learn about next week.

# Next, run the UNIX curl command to fetch the data from that same URL above. 
# Take a screenshot and submit it via cTools.

# Finally, write python code here to fetch the same webpage and 
# print out its contents. 
# (See the slides and code from Tuesday's class for how to do this.)

import urllib2
read = urllib2.urlopen('http://services.faa.gov/airport/status/DTW?format=json')
for i in read.readlines():
    print i

##### Try/except ###########

# [PROBLEM 2]

# The following code first checks to see if the list has at least three
# items, printing the third item if it exists, and an error message
# otherwise. Rewrite it to have exactly the same effect, but using a 
# try/except statement instead of an if/then.

def f(L):
    if len(L) >= 3:
        print L[2] 
    else:
        print "not enough items in L"

# write your code here      
try:
    if len(L) >= 3:
        print L[2]
except:
    print "not enough items in L"

###### String Interpolation Questions #######

# [PROBLEM 3]

# Complete the following string interpolation/formatting problems.

# convert this string interpolation to one using only the + operator, not %
# make t equal to the same thing as s, which should 
x = 12
y = 4
s = "You have $%d. If you spend $%d, you will have $%d left." % (x, y, x-y)
# fill in the next line to generate the same string using only the + operator, no 
t = "You have $" + str(x) + ". If you spend $" + str(y) + ", you will have $" + str(x-y) + " left."

# testing 
test.testEqual(t, s, "convert string interpolation to one using only the + operator, not %")

# Convert this string concatenation to one using string interpolation.
# Assign the result to the variable t.
x = 12
fname = "Joe"
our_email = "scammer@dontfallforthis.com"
s = "Hello, " + fname + ", you may have won $" + str(x) + " million dollars. Please send your bank account number to " + our_email + " and we will deposit your winnings."
t = "Hello, %s, you may have won $%d million dollars. Please send your bank account number to %s and we will deposit your winnings." % (fname, x, our_email)

# testing
test.testEqual(t, s, "convert string concatenation to one using string interpolation")

# Write code, using string interpolation and the variables nm, min_mt, and mile_amt, to produce the string 
# "Albert walked 0.67 miles today in 50 minutes." Assign it to albert_str.
nm = "Albert"
min_amt = 50
mile_amt = 0.673892
albert_str = "Albert walked %0.2f miles today in %d minutes." % (mile_amt, min_amt)


# testing
test.testEqual(albert_str, "Albert walked 0.67 miles today in 50 minutes.", "testing albert_str")

# Define a function called walk_reporter, which takes as input: 
#  - a string that represents someone's name, 
#  - a float that represents the number of miles they walked,
#  - and an integer that represents the number of minutes they spent walking.
#
# The function should RETURN a string in the format:
# "[NAME STR] walked [MILE FLOAT with TWO digits after the decimal] miles in [MINUTES INT] minutes."
# You MUST use string interpolation in the function. 
# You should NOT use raw_input to get the inputs; they are passed in as parameters.

def walk_reporter(nm, miles, mins):
    x = "%s walked %0.2f miles in %d minutes." % (nm, miles, mins)
    return x

# tests for the walk_reporter function
test.testEqual(walk_reporter("Jamie",5.233679,202), "Jamie walked 5.23 miles in 202 minutes.", "walk_reporter test 1")
test.testEqual(walk_reporter("Pythagoras",3.1415926,314),"Pythagoras walked 3.14 miles in 314 minutes.", "walk reporter test 2")


##########

# Below is some code we've provided for you, some of which you'll have
# to add to or add comments to. 
# As always, look through it and understand it, make comments, test it, pull it apart in your head
# (or in a blank .py file!).

# read a bunch of text from A Study in Scarlet to use as training data
f= open("train.txt", 'r')  #opens file to read
train_txt = f.read()  #stores the contents that were read into train_txt
f.close  #closes the file
# get some other text to use for testing
f= open("test.txt", 'r')  #opens file to read
test_txt = f.read()  #stores the contents that were read into train_txt
f.close()  #closes the file

# The text includes some weird characters that don't even print out nicely.
# Find the complete alphabet of characters that are used anywhere in the training and testing texts
lets = []
for x in train_txt+test_txt:
    if x not in lets:
        lets.append(x)
alphabet = "".join(sorted(lets))

# Here is a guesser function based on the rule-based guesser 
# in the textbook. It's simplified to make things easier. 
# The simplification is that we only consider
# rules that match the ending (suffix) of the previous text. 
# As a result, we don't need the rule to be a function, just 
# a string that the suffic of the previous text has to match.

# For example, if the rule was ("ca", "bdklmnp"), it would 
# match any text where he last two revealed letters were "ca"
# and it would make the guesses "bdklmnp", in that order, for
# the next letter.

# You'll be using this, with some rules you create, to play the Shannon Game.

def guesser(prev_txt, rls):
    all_guesses = ""
    for (suffix, guesses) in rls:
        try:
            if suffix == None or prev_txt[-len(suffix):] == suffix:
                all_guesses = all_guesses + guesses
        except:
            #error because not enough characters in prev_txt    
            pass 
    return all_guesses

## List of rules -- you'll be adding to this list!
rules = [("q", "uai"),
         (None, alphabet)]
# Note that the second rule will match *any* previous text.
# It ensures that every letter in the text's alphabet will
# be guessed eventually. It should always remain the *last*
# rule in the list, because it doesn't make very good guesses,
# but at least it guesses every letter. Think of it as the default
# rule when nothing else generates a good guess.
         
         
## Here are some sample calls to the guesser function, like the ones provided in the textbook,
## if you want to play with it and remember what it does.
# print guesser(" ", rules)
# print guesser(" The q", rules)
# print guesser(" The qualit", rules)
# print guesser(" The qualit", rules)


# [PROBLEM 4]
# Add comments to the function definition below
# explaining each line and what the function does overall

def performance(txt, rls):  #defines the function performance with the two parameters of txt and rls
    tot = 0  #sets the accumulator of total to 0
    for i in range(len(txt)-1):  #iterating through the code below as many times as there are characters in the txt parameter.
        to_try = guesser(txt[:i+1], rls) #calls the function guesser with the text parameter that is indexed to i and the rls parameter. Then, that output is saved to the variable to_try. The guess function guesses letters for the Shannon game automatically.
        guess_count = to_try.index(txt[i+1])  #this is getting the amount of guesses that were made in the guess function above.
        tot = tot + guess_count # this is assigning all of the guesses that were made to the variable total.
    print "%d characters to guess\t%d guesses\t%.2f guesses per character, on average\n" % (len(txt) -1, tot, float(tot)/(len(txt) -1))  #this is printing the result of the function above using string interpolation with the total number of guesses.

performance(test_txt, rules)  #this calls the function defined above (performance), with the parameters of test_txt and rules
# Should be 111651 guesses total)
    
# --------------

# [PROBLEM 5]

# Now you'll start adding extra rules that, hopefully,
# lead to fewer guesses being necessary.

# Write a new rule that will guess capitals first if the 
# previous text is a period followed by a space. 
# HINT: Model this after the rule that determines what comes after q!
# Save that tuple rule into the variable caps_rule.

# Put your code here!
caps_rule = [". ", alphabet[31:].upper()]

# This code will add your rule to the list of rules:
# (Make sure you've used all the right variable names, like caps_rule, 
#  or else this won't work.)
try:
	rules.insert(1, caps_rule)
except:
	print "the caps_rule tuple does not exist yet"
    

# testing your caps rule
test.testEqual(guesser("The quick brown fox jumped over the lazy dog. ", rules)[:3], "ABC", "Testing for p_rule")

performance(test_txt, rules)
# should be 111186 guesses total)

# --------------

# [PROBLEM 6]

# Now we'll improve on that by writing rule that will guess letters in order of their
# frequency in the TRAINING SET of A Study in Scarlet. 
# (Stored in the variable train_txt.)

# We've provided you the letter_frequencies function that you wrote in a previous pset.
def letter_frequencies(txt):
    d = {}
    for c in txt:
        if c not in d:
            d[c] = 1
        else:
            d[c] = d[c] + 1
    return d

# We also provide a concat_all function that takes a list of strings and concatenates them all together.
def concat_all(L):
    res = ""
    for s in L:
        res = res + s
    return res
    
# Now, write a rule that will guess letters in order of their frequency in the training data,
# no matter what the previous text is. You need to figure out the string of letters to guess, sorted
# in order of their frequency
# HINT: 
# a) Make use of the letter_frequencies function that we've provided to find the letter
# frequencies in train_txt. 
# b) Make a sorted list of the letters, sorted in decreasing order by frequency
# c) Turn that list into a string, using the concat_all function we provided

# write your code here! This should assign a string for the freqs_rule to a variable.
def guesser2(txt):
    lf = letter_frequencies(txt)
    freq = lf.keys()
    lf_sort = sorted(freq, key=lambda x: lf[x], reverse = True)
    freqs_rule = concat_all(lf_sort)
    return freqs_rule

guesser2(train_txt)


# Also, replace the string in freqs_rule[1] below, so you can add it to the list of rules.
freqs_rule = (None, guesser2(train_txt))

# This code will add your rule to the list of rules.
# Note that we insert it just before the default rule at
# end, rather than appending it. We still need the default
# rule in case the testing text contains a letter in the 
# alphabet that never appears in the training text.
try:
	rules.insert(-1,freqs_rule)
except:
	print "the freqs_rule tuple does not exist yet"

performance(test_txt, rules)
# should be 15978 guesses total

# --------------

# [PROBLEM 7]

# Now we will add rules that define what to guess after every possible previous letter.

# Here is code to create a dictionary to store the frequency of letters that follow 
# each letter in the alphabet, using some input training text.
# Go through this and comment it with what's happening (you'll be graded on that)!
# Do not change the code!

def next_letter_frequencies(txt):  #defining the function called next_letter_frequencies while passing it the parameter txt
    r = {}  #initializing the dictionary r for our values to be stored in
    for i in range(len(txt)-1):  #iterating the variable i through a list that is the length of the variable text, minus 1, to eventually to store the next letter frequencies
        if txt[i] not in r:  # if the character at position i in txt is not present in the r dictionary we created earlier
            # make an empty dictionary for counts of what letters come next
            r[txt[i]] = {}  #this is the dictionary that is being created for the counts what letters are next to come
        next_letter_freqs = r[txt[i]] #the variable next_letter_freqs is assigned the value that the dictionary R has indexed at the character of text at the position i.  This is what the object will be predicting next.
        next_letter = txt[i+1]  #assigning the variable next_letter with the next character in txt, indexed at the next character in txt.  This moves the next letter in the string stored to the variable next_letter.
        if next_letter not in next_letter_freqs:  #This is saying if the next letter is not already in next_letter_freqs, then it will continue to iterate through the next line of code.  If not, it will skip and go right to the else statement below.
            next_letter_freqs[next_letter] = 1  #This will add the next_letter into the dictionary next_letter_freqs, and assign it a value of one.  This is just adding the new characters into the dictionary and starting their counts in the dictionary.
        else:  #if the if statement is false, iterate the line of code below instead
            next_letter_freqs[next_letter] = next_letter_freqs[next_letter] + 1  #the letters have already been initialized in the dictionary, so we will count to see how many times they appear with this statement and its accumulator.  Each character will individually be accumulated by one each time it appears.
    return r  #this will return r, which has all of the letters as keys and how many times they occur after other characters in train_txt.

counts = next_letter_frequencies(train_txt)  #runs through the next_letter_frequencies function with the train_txt parameter.  The value returned from the function is stored to the variable counts.

# The structure of the dictionary counts we created there looks like this:
# {'a':{'b':2,'c':4}, 'd':{'e':6,'a':7}}
# if, for example, b came after a 2 times in the data, 
# and c came after a 4 times
# in the data, e came after d 6 times, and so on.
# You might want to try printing out several different values or
# iterating through the dictionary's keys in different ways to make sure
# you understand the structure.

#print counts  # this prints out the counts for every single character in train_txt and what characters occur after other characters in the file.  However, it is extremely long so I commented it out.
# --------------

# [PROBLEM 8] EXTRA CREDIT

#b = next_letter_frequencies(train_txt)
#def next_guess(x):
    #count_list = []
    #for i in x:
        #listi = x.keys()
        #sorted_listi = sorted(listi, key=lambda x: x[listi], reverse=True)
        #count_listi = count_list.append((i, sorted_listi))
    #return count_listi


#rules.insert(0, next_guess(b))



# Now write code to add one new rule for each letter in the 
# alphabet, saying what letters to guess next if that letter has
# just appeared.
# HINT: you can *almost* reuse some of the code from two problems earlier

# Make sure you insert these new rules at the beginning of the list
# rules. You want them to take precedence over the generic ordering
# of guesses that you created in the previous problem.


# this code tests the text against all the rules    
performance(test_txt, rules)
# should be 9348 guesses total