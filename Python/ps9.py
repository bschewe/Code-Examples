import test
import urllib
import urllib2
import json

# This is a function we've provided for you so you can print stuff in a pretty,
# easy-to-read way. 
def pretty(obj):
    return json.dumps(obj, sort_keys=True, indent=2)

#### Exercises: A RESTful API

# The FAA has put out a REST API for accessing current information about US airports. 
# You'll be using it in the following exercises.

## NOTE: Almost all of the following exercises build on one another. You can
## use code you wrote in earlier exercises in later ones. If you keep this in
## mind, this problem set will be even easier for you!

# First, point your web browser to the following URL:
#   http://services.faa.gov/airport/status/DTW?format=json
#
# The text that is shown in your browser is a JSON-formatted dictionary.
# It can easily be converted into a python dictionary and processed in a 
# manner similar to what we have done with the Facebook feed previously.
# The exercise below guides you through the process of writing python
# code that uses this RESTful API to extract information about some
# airports.

# [PROBLEM 1]

## Encoding query parameters in a URL
# (1a) Use urllib.urlencode() to generate the query parameter string, with one
#      parameter: 'format', whose value should be 'json'. 
#      (Just like in the URL you pointed your browser to above.)
#      Store the query parameter string in a variable called param_str

# put your code here -- you just need to change what's in the param_str variable.
d = {}
d['format'] = 'json'
param_str = urllib.urlencode(d)

# (1b) Add (concatenate) the airport and the param_str to the base URL, which is:
#        http://services.faa.gov/airport/status/
#      Store the string in a variable called airport_request.
print '---------------'
baseurl = 'http://services.faa.gov/airport/status/'
airport = 'DTW'
airport_request = baseurl + airport + '?' + param_str # change this line of code so airport_request equals the whole request
# Again, simple -- we're doing this step by step.

## Testing problem 1
test.testEqual(param_str, "format=json", "testing correct output for 1(a)")
test.testEqual(airport_request,"http://services.faa.gov/airport/status/DTW?format=json", "testing correct output for 1(b)")


# [PROBLEM 2]
## Grabbing data off the web
# (2)  Use urllib2.urlopen() to retrieve data from the airport_request address.
# You did a similar thing last week -- but now we're going to move toward getting data 
# and using it.
#      Store the data, in one long string, in a variable called airport_json_str.
print '---------------'

try:
    result = urllib2.urlopen(airport_request)
    airport_json_str = urllib2.urlopen("http://services.faa.gov/airport/status/DTW?format=json").read() # change this line of code

    # print airport_json_str # if you're curious what you got back

    ## Testing problem 2
    test.testEqual(type(airport_json_str), type(""), "testing type in problem 2")
    test.testEqual(airport_json_str[:9], '{"delay":', "testing first few chars of result string in problem 2")
except:
    print "Failed tests for problem 2"

# [PROBLEM 3]
## Converting a JSON string to a dictionary
# (3)  Now use json.loads() to convert airport_json_str into a Python dictionary.
#      Store the dictionary in a variable called airport_data.
#      Then, print the dictionary, using the pretty function that we defined for you above, 
#      to turn it into a nicely indented format.
#	   Note that you should ONLY use our pretty() function on data when you print things out,
#      to help you understand it. Just like print is for people, pretty() is also for people.
print '---------------'

# put your code here!
airport_data = json.loads(airport_json_str)
try:
    ## TESTS - Problem 3
    test.testEqual(type(airport_data),type({}),"testing that airport_data is a dictionary in problem 3")
except:
    print "Failed tests for problem 3"

# [PROBLEM 4]
## Extracting relevant information from a dictionary
# (4)  From the airport data, extract the name, the reason field from within the status, the
# current temperature, and the last time it was updated.
# HINT: Look at the nested data chapter.
# Save these in variables called, respectively: 
#   airport_name, status_reason, current_temp, recent_update

print '---------------------------------'

# put your code here
airport_name = airport_data['name']
status_reason = airport_data['status']['reason']
current_temp = airport_data['weather']['temp']
recent_update = airport_data['weather']['meta']['updated']

print pretty(airport_data) # uncomment this to see what the dictionary looks like
try:
    print airport_name
    print status_reason
    print current_temp
    print recent_update

    ## TESTS - PROBLEM 4
    test.testEqual(type(airport_name),type(u""),"testing type in p4 - airport name")
    test.testEqual(type(status_reason),type(u""),"testing type in p4 - status_reason")
    test.testEqual(type(current_temp), type(u""), "testing type in p4 -- current_temp")
    test.testEqual(type(recent_update), type(u""),"testing type in p4 -- recent_update")
except:
    print "Failed tests for problem 4"
    
print '---------------------------------'

# [PROBLEM 5]

## Generalizing your code
# Now you'll think about the code you've written in earlier steps and make generalized versions!

# (5a) Write a function called get_airport() that accepts a three-letter airport
# code and returns a data dictionary like the one you get in Problem 3.  

# put your code here
def get_airport(x):
    if len(x) <= 3:
        baseurl = 'http://services.faa.gov/airport/status/'
        airport = x
        param_str = 'format=json'
        airport_request = baseurl + airport + '?' + param_str
        result = urllib2.urlopen(airport_request)
        airport_json_str = urllib2.urlopen(airport_request).read()
        airport_data = json.loads(airport_json_str)
        return airport_data
    else:
        return

        
# testing get_airport for you to see if it works
try:
	print pretty(get_airport('DTW'))
except:
	print "You have not written the function get_airport yet"

print '---------------------------------'

# (5b) Write another function called print_airport() that accepts an airport name
#      and prints out the info as in exercise 4.
#      This function should call get_airport().  Uncomment the test code to try it out.

# put your code here
def print_airport(y):
    z = get_airport(y)
    airport_name = airport_data['name']
    status_reason = airport_data['status']['reason']
    current_temp = airport_data['weather']['temp']
    recent_update = airport_data['weather']['meta']['updated']
    print airport_name
    print status_reason
    print current_temp
    print recent_update
    return 
    
try:
	print_airport('SFO')
except:
	print "You have not written the function print_airport yet"

# There are no other tests
print '---------------------------------'


# (5c) Iterate over the fav_airports list and print out the abbreviated info for
# each, by calling print_airport().

fav_airports = ['PIT', 'BOS', 'LGA', 'DCA']

# put your code here!
for i in fav_airports:
    s = print_airport(i)
    print s
# [PROBLEM 6]
# Error handling and exceptions
# (6a) Uncomment the bogus URL request below.  It should throw an exception.
#      This exception occurs when you request an invalid URL.  Wrap the 
#      urlopen() call, in the commented line below, in a try/except block.
# 
#      Here, we know what errors to expect, so: 
#	   your block should catch urllib2.URLError exceptions, and print out
#      the appropriate reason or error code. HINT: See SafeGet() from the slides and textbook...
print '---------------'

# wrap this following line of code in a try/except block as described above!
try:
    x = urllib2.urlopen('http://www-personal.umich.edu/nonstudent')
except urllib2.URLError, e:
    if hasattr(e, 'reason'):
        print "We failed to reach a server."
        print "Reason: ", e.reason
    elif hasattr(e, 'code'):
        print "The server couldn't fulfill your request."
        print "Error code: ", e.code




# (6b) Now, define a function get_airport_safe().  
# It should call get_airport, but catch any errors that might occur 
# (i.e., use try/except around the whole get_airport function call). 
# If an error occurs, your function should print 'Error trying to retrieve airport.', 
# followed by the reason or error code returned by the server, 
# and then the function should return None.
print '---------------'

# put your code here!
def get_airport_safe(input):
    try:
        get_airport(input)
    except urllib2.URLError, e:
        if hasattr(e, 'reason'):
            print "Error trying to retrieve airport."
            print "Reason: ", e.reason
        elif hasattr(e, 'code'):
            print "Error trying to retrieve airport."
            print "Error code: ", e.code
        
try:
	print pretty(get_airport_safe('xy')) # this should print Error trying to retrieve airport and return None, which also gets printed
	print pretty(get_airport_safe('DTW')) # this should work and print airport info
except:
	print "You have not defined the get_airport_safe function yet or it has an error"


print "---------------------"

# Trying out your own airports (6c) Create a list including your 3 top airports
# and one that doesn't exist.  Print them out using the print_airport_safe()
# function.

# uncomment this code and fill in your_favs
your_favs = ['SBN', 'AZO', 'ORD', 'DRE']
for a in your_favs:
    print get_airport_safe(a)