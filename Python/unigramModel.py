from languageModel import *

class UnigramModel(LanguageModel):

    def __init__(self):
        """
        This is the constructor, don't worry about it. It's done.
        This allows UnigramModel to also access LanguageModel functions
        """
        super(UnigramModel, self).__init__()

    def __str__(self):
        """
        If you try to print a UnigramModel object, 
        this is the string that prints
        """
        return "This is a unigram language model"

    def trainText(self, text):
        """
        Requires: text is all the text to train on, 
        a list of full sentence strings
        Modifies: self.wordCounts, a dictionary of {word: frequency} 
        pairs. Before training, this dictionary exists but it is empty.
        In this function we want to populate it with the frequency
        information for whatever text you are using to train.
        Effects: nothing

        Make sure to call prepText! We need the special symbols
        it introduces later
        So please count each of the three special symbols,
        "^::^", "^:::^", "$:::$" as their own words
        """
        pText = self.prepText(text)
        for p in pText:
            p = p.split()
            for i in p:
                if i in self.wordCounts:
                    self.wordCounts[i] = self.wordCounts[i] + 1
                else:
                    self.wordCounts[i] = 1
        return None

    def nextToken(self, sentence):
        """
        Requires: sentence is the sentence so far
        Modifies: nothing
        Effects: Returns the next word to be added to the sentence

        See examples in Section 1.2 and Appendix B.2 of the spec,
        along with pictures
        """
        cumuList = []
        count = 0
        for x in self.wordCounts:
            count += 1
            for s in range(0, self.wordCounts[x]):
                cumuList.append(x)
        x = cumuList[random.randrange(0, count)]
        return x

    def hasKey(self, sentence):
        """
        Requires: sentence is the sentence so far
        Modifies: nothing
        Effects: Returns True iff this language model can be used
        for this sentence. For a unigram model, this is True as long as
        the model knows about any words (i.e. has been trained at all).
        """
        if (self.wordCounts == {}):
            x = False
        else:
            x = True
        return x