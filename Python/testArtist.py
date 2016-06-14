import sys
sys.path.append('./lm')

from dataLoader import *
from unigramModel import *
from bigramModel import *
from trigramModel import *

def main():
    SOURCEDIRS = ["tweets"] #For collaborations, add to this list
    dl = DataLoader()
    tweetlist = dl.loadTweets("tw.txt")
    emptylist = []
    tweets = []
    
    for x in tweetlist:
        if x == '\n':
            emptylist.append(x)
        else:
            tweets.append(x)


    u = UnigramModel()
    b = BigramModel()
    #t = TrigramModel()
    #print tweets
    u.trainText(tweets)
    b.trainText(tweets)
    #t.trainText(tweets)
    #models = [t, b, u]
    #Commented out trigram because it would return a tweet already in the
    #database, instead of creating a new one
    models = [b, u]
    #Create an instance of each of the language models
    #(unigram, bigram, trigram) and train it
    tweet = [generateSentence(models, 20)]
    #tweet2 = [generateSentence(models,6)]

    for x in tweet:
        print x
# for x in tweet2:
#      print x
    return None

def generateSentence(models, length):
    """
    Requires: models is a list of LanguageModel objects, sorted by priority
    For the core, the priority is trigrams, then bigrams, then unigrams.
    Length is roughly the desired length of the sentence. The resulting
    sentence will not automatically be this long, but it is likely to be close.
    Modifies: nothing
    Effects: This function takes the trained LanguageModel objects and uses
    them to generate a sentence of a desired length.
    Choruses have a desired length of 6, verses of 9 for the Core.
    To do this, it must generate several words using the procedure described
    in the spec. Returns a string representing the sentence.
    """
    sentence = "^::^ ^:::^" #These are always our starting symbols
    i = 2
    while not over(length, i) and "$:::$" not in sentence:
        sentence = sentence + ' ' + backOff(models, sentence).nextToken(sentence)
        i += 1
    sentence = sentence.replace("$:::$","")
    sentence = sentence.replace("^::^ ^:::^","")
    sentence = sentence.replace("^::^","")
    sentence = sentence.strip()
    sentence.capitalize()
    return sentence

def backOff(models, sentence):
    """
    Requires: models is a list of LanguageModel objects. It is sorted by
    descending priority, meaning tri-, then bi-, then unigrams.
    Modifies: nothing
    Effects: Selects the best (first) possible model that can be used.
    If the models list were [A,B], it would first see if A
    has any knowledge that can be used for the current sentence
    if so, it returns A. If not, it checks if B applies.
    It is recommended you use the hasKey() method of each model.

    Returns None if no models are usable.
    """
    if (models[0].hasKey(sentence)):
        return models[0]
    elif (models[1].hasKey(sentence)):
        return models[1]
    #There are only 2 models in the list since trigram doesn't work
    #elif (models[2].hasKey(sentence)):
        #return models[2]
    else:
        return None

def over(maxLength, currentLength):
    """
    Requires: length is (roughly) the maximum desired length of the sentence
    This function ends the sentence at close to length number
    of words with some random variation to make it seem more natural.
    SentenceLength is the length of the current sentence so far
    Modifies: Nothing
    Effects: Returns a boolean of whether or not to end the sentence
    based solely on length.
    Also, this is already done for you
    Please do not change this for the core
    """
    STDEV = 1 #This must be 1 for the core, you may change it for the reach
    val = random.gauss(currentLength, STDEV)
    return val > maxLength

if __name__=='__main__':
    main()
