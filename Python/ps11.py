###################
import facebook
import json
import test

def pretty(obj):
    return json.dumps(obj, sort_keys=True, indent=2)

# This code makes lists of positive words and negative words, in pos_ws and neg_ws.
pos_ws = []
f = open('positive-words.txt', 'r')

for l in f.readlines()[35:]:
    pos_ws.append(unicode(l.strip()))
f.close()

neg_ws = []
f = open('negative-words.txt', 'r')
for l in f.readlines()[35:]:
    neg_ws.append(unicode(l.strip()))

### Now begins the graded problems.

# [PROBLEM 1] 
    # Fill in the definition of the class Post to hold information about one post that you've made on Facebook.
    # Add to the __init__ method additional code to set the instance variables comments and likes. 
    # More instructions about that follow, in the code below.
    # You need to pull out the appropriate data from the json representation of a single post. 
    # You can find a sample in the file samplepost.txt. 
    # There are tests that check whether you've pulled out the right data.
    
class Post():
    """object representing status update"""
    def __init__(self, post_dict):
        if 'message' in post_dict:
            self.message = post_dict['message']
        else:
            self.message = ""
        if 'likes' in post_dict:
            self.likes = post_dict['likes']['data']
        else:
            self.likes = []
        if 'comments' in post_dict:
            self.comments = post_dict['comments']['data']
        else:
            self.comments = []
        # if the post dictionary has a 'comments' key, set an instance variable self.comments
        # to the list of comment dictionaries you extract from post_dict. 
        # Otherwise, set self.comments to be an empty list: []

        # Something similar has already been done for the contents (message) of the original post, 
        # which is the value of the 'message' key in the dictionary, when it is present 
        # (photo posts don't have a message). See above for that code, which you can model the rest after!

        # But, pulling out the list of dictionaries from a post_dict
        # where each dictionary represents a comment from a post_dict 
        # is a little harder. You have to go one level deeper in the data structure 
        # Take a look at the sample of what a post_dict looks like
        # in the file samplepost.txt to figure out where to find information.
        
        # Now, similarly, if the post dictionary has a 'likes' key, set self.likes to
        # the list of likes dictionaries from the corresponding likes dictionary.  
        # Otherwise, if there are no 'likes', set self.likes to an empty list: []

    # [PROBLEM 2] In the Post class, fill in three methods:
    # -- positive() returns the number of words in the message that are in the list of positive words pos_ws (provided in our code)
    # -- negative() returns the number of words in the message taht are in the list of negative words neg_ws (provided in our code)
    # -- emo_score returns the difference between positive and negative scores
    # The beginnings of these functions are below -- fill in the rest of the method code!
    # There are tests of these methods later on.
        
    def positive(self):
        self.poscount = 0
        split = self.message.split()
        for i in pos_ws:
            if i in split:
                self.poscount = self.poscount + 1
        return self.poscount
            
                   
    def negative(self):
        self.negcount = 0
        split = self.message.split()
        for i in neg_ws:
            if i in split: 
                self.negcount = self.negcount + 1
        return self.negcount

    def emo_score(self):
        self.poscount = 0
        self.negcount = 0
        split = self.message.split()
        for i in pos_ws:
            if i in split:
                self.poscount = self.poscount + 1
        for i in neg_ws:
            if i in split: 
                self.negcount = self.negcount + 1
        return self.poscount - self.negcount
        

# [PROBLEM 3] Comment these lines of code with what is happening in them.
sample = open('samplepost.txt').read()  #reading the dictionary from the samplepost.txt file, and storing it to the variable sample
sample_post_dict = json.loads(sample)  #this is taking the sample variable from above, taking it from JSON formatted string to a python dictionary.
p = Post(sample_post_dict)  #passing the dictionary we created into the class Post above, so we can perform operations on the dictionary so we can get information.

# use the next lines of code if you're having trouble getting the tests to pass.
# they will help you understand what a post_dict contains, and what
# your code has actually extracted from it and assigned to the comments 
# and likes instance variables.
#print pretty(sample_post_dict)
#print pretty(p.comments)
#print pretty(p.likes)

# Here are tests for instance variables
print "-----PROBLEM 1 tests"
try:
    test.testEqual(type(p.comments), type([]))
    test.testEqual(len(p.comments), 4)
    test.testEqual(type(p.comments[0]), type({}))
    test.testEqual(type(p.likes), type([]))
    test.testEqual(len(p.likes), 4)
    test.testEqual(type(p.likes[0]), type({}))
except:
    print "One or more of the test invocations is causing an error,\nprobably because p.comments or p.likes has no elements..."

# Here are some tests of the positive, negative, and emo_score methods.
print "-----PROBLEM 2 tests"
p.message = "adaptive acumen abuses acerbic aches for everyone" # this line is to use for the tests, do not change it
test.testEqual(p.positive(), 2)
test.testEqual(p.negative(), 3)
test.testEqual(p.emo_score(), -1)        
    
# [PROBLEM 4] (SOLUTION PROVIDED)
# Get a json-formatted version of your last 100 posts on Facebook. 
# (Hint: use the facebook module, as presented in class, and use https://developers.facebook.com/tools/explorer 
# to get your access token. 
# Every couple hours you will need to get a new token.)
# This is almost the same as the Facebook code example you saw in class.
# the GraphAPI module uses a little different way of passing query parameters
# than we had with urllib.urlopen, so we are providing this for you.

# uncomment the next two lines
access_token = "CAACEdEose0cBAPbzbpT03FRAW9yVnChsRQZCXbFbVMISJB1WYEXsrYIBjLQCuhR8CBeMOdLY0L6zkRrCCVOOQFRybe8UiVhDtMTxvITrx3NCGS9UpikKx0WfztkgXNFErcfGDtNzvu2BwXv6fZCjGHM2xuhVIUgkeqYeflmyWdww9uYfS2YTmEWt4Aro3ZBaBOOWt6LsIzrl13ZBBZCfmzGSSC4LCOZAcZD"
graph = facebook.GraphAPI(access_token)
feed = graph.get_object("me/feed", limit = 100)

# [PROBLEM 5]
# For each of those posts,
    # -- create an instance of your class Post.
    # This should fill in attributes for:
        #-- the message if it exists
        #-- the comments data if it exists
        #-- the likes data if it exists
    # If you passed the tests above, all this should work if you create one instance per post correctly.
    # (Hint: think about the classes exercise you looked at in section last week)
for x in feed['data']:
    new = Post(x)
    message = new.message
    likes = new.likes
    comments = new.comments

    
# [PROBLEM 6] 
# Write code to compute the top three likers and commenters on your posts overall.
# (the people who did the most comments and likes on all of your facebook posts)
# Hint: making dictionaries and sorting may both be useful here!

# I tried writing this problem with the intention of putting the commenters and likers in the same category.  I was unsure, so my top 3 are the people who have commented and liked (both comments and likes accumulated together).
blank_name_list = []
list = []
d = {}
count = 0

for v in feed['data']:
    blank_name_list.append(v['from']['name'])
for x in blank_name_list:
    if x in d:
        d[x] = d[x] + 1
    else:
        d[x] = 1
items = d.items()
sorted_items = sorted(d.keys(), key = lambda x: d[x], reverse = True)
top3_number1 = sorted_items[0]
top3_number2 = sorted_items[1]
top3_number3 = sorted_items[2]
print top3_number1
print top3_number2
print top3_number3
  
# [PROBLEM 7] 
# Write code to find out: were there more commenters or likers? (Each person only gets counted once.)
#    (Note that this is not the same as looking at whether there were more comments or likes!)

def emo_score(self):
    positive_score = self.positive()
    negative_score = self.negative()
    emo_score = (positive_score - negative_score)
    return emo_score

for w in feed['data']:
    r = Post(w)
    like_count = len(r.likes)
    comment_count = len(r.comments)
    es2 = emo_score(r)
if like_count > comment_count:
    print "There were more likers than commenters."
if like_count < comment_count:
    print "There were more commenters than likers."
if like_count == comment_count:
    print "There are the same amount of commenters and likers."

  
# [PROBLEM 8] 
# Output a .csv file that lets you make scatterplots showing 
# net positivity on x-axis and comment-counts and like-counts on the y-axis. 
# Each row should represent one post and have: emo score, comment counts, and like counts.

outfile = open('emotion_scores.csv', 'w')
outfile.write("Emotion Score, Comment Count, Likes Count\n")
for w in feed['data']:
    r = Post(w)
    like_count = len(r.likes)
    comment_count = len(r.comments)
    es2 = emo_score(r)
    outfile.write("%d, %d, %d\n" %(es2,like_count,comment_count))
outfile.close()

# You can see what the scatterplot might look
# like in emo_scores.xlsx. (In the example case, there's not an obvious
# correlation between positivity and how many comments or likes. There may not be,
# but you find that out by exploring the data!)

# Can you see any trend in whether your friends are more likely 
# to respond to positive vs. negative posts? That question is not graded, but something to think about.
# Post a screenshot of your scatterplot to the facebook group!


#It is hard to see the trend if my friends will more likely comment on a positive or negative post.  It is hard to tell because unfortunately I do not post on facebook often.  However, if I had to choose based on the data I have, i would say positive post!


