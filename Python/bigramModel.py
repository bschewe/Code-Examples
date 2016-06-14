from languageModel import *

class BigramModel(LanguageModel):

    def __init__(self):
		"""
		This is the constructor, don't worry about it. It's done.
		This allows BigramModel to also access LanguageModel functions
		"""
		super(BigramModel, self).__init__()

    def __str__(self):
		"""
		If you try to print a BigramModel object,
		this is the string that prints
		"""
		return "This is a bigram language model"
    
    def trainText(self, text):
        """
		Requires: text is all the text to train on,
			  a list of full-sentence strings
		Modifies: self.wordCounts, a 2D dictionary
			  This model is one level more complicated
			  than the UnigramModel. This model counts how
			  often each word appears AFTER each other word.

			  See section 2.3.4 for an example

		Effects: nothing
        """
        
        pText = self.prepText(text)
        #list = []
        #pText = pText.split()
        #print pText
        for p in pText:
            p = p.split()
            for i in range(len(p)-1):
                if p[i] in self.wordCounts:
                    if p[i+1] in self.wordCounts[p[i]].keys():
                        self.wordCounts[p[i]][p[i+1]] = self.wordCounts[p[i]][p[i+1]] + 1
                    if p[i] not in self.wordCounts[p[i]].keys():
                        self.wordCounts[p[i]][p[i+1]] = 1
                if p[i] not in self.wordCounts:
                    self.wordCounts[p[i]] = {p[i+1]: 1}

 
    def nextToken(self, sentence):
        cumuList = []
        count = 0
        #print self.wordCounts
        for x in self.wordCounts[sentence.split()[-1]]:
            count += 1
            for s in range(self.wordCounts[sentence.split()[-1]][x]):
                cumuList.append(x)
        x = cumuList[random.randrange(0, count)]
        return x

    def hasKey(self, sentence):
        """
    Requires: sentence is the sentence so far
    Modifies: nothing
    Effects: Returns True iff this language model can be used
    for this sentence. For a bigram model, this is True
    as long as the model has seen the last word
    in the sentence before at the start of a bigram.
        """
        l = sentence.split()
        if l[-1] in self.wordCounts.keys():
            return True
        else:
            return False

