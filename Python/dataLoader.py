import os
import re
import json
import urllib
import urllib2

class DataLoader(object):

	def __init__(self):
		self.data = [] #List of full-sentence strings
		self.compilePatterns()

        def loadTweets(self, dirname):
            tweets = open(dirname)
            self.data = tweets.readlines()
            tweets.close()
            piclinks = []
            for x in self.data:
                for y in x.split():
                    if y[0:6] == 'http://':
                        piclinks.append(y)
                #print y
                punc = re.findall(r"[\w']+|[.,\!?;]", x)
                for y in range(len(punc)):
                    #if punc[y] == punc[y+1]:
                    #    punc[y] = punc[y]+punc[y+1]
                    if punc[y][-1] in "[].,?\|)(*&^%$":
                        punc[y][-1].replace(punc[y][-1], '')
        #print punc
            #print punc
        
            return self.data

	def loadMusic(self, dirname):
		if dirname not in os.listdir("data/music/"):
			print "No artist named "+dirname+" in data/music/"
			return []
		songs = os.listdir("data/music/"+dirname+"/")
		for song in songs:
			F = open("data/music/"+dirname+"/"+song)
			lines = F.readlines()
			F.close()
			for line in lines:
				line = re.sub(self.notePat,"",line)
				line = self.condenseSpace(line)
				if (len(line) > 2):
					text = self.stripPunc(line.lower())
					self.data.append(text.strip())
		

	def loadGutenberg(self,fname):
		if fname not in os.listdir("data/books/Gutenberg/"):
			print "No file named "+fname+" in data/books/Gutenberg/"
			return []
		F = open("data/books/Gutenberg/"+fname)
		content = re.search(self.gutenPat, F.read().replace("\n","\t"))
		F.close()
		sentences = self.split(self.condenseSpace(content.group(1)))
		text = [self.stripPunc(s.lower().strip()) for s in sentences]
		self.data.extend(text)

	def compilePatterns(self):
		gutenDel1 = r"\*\*\* START OF THIS PROJECT GUTENBERG EBOOK.*?\*\*\*"
		gutenDel2 = r"\*\*\* END OF THIS PROJECT GUTENBERG EBOOK.*?\*\*\*"
		self.gutenPat = re.compile(gutenDel1+r"(.*)"+gutenDel2)
		self.spacePat = re.compile(r"\s+")
		self.puncPat = re.compile(r"[,\.;:()'\"-_]")
		self.sentPat = re.compile(r"[\.?!]")
		self.notePat = re.compile(r"\[.*?\]")

	def split(self, text):
		return re.split(self.sentPat,text)

	def stripPunc(self, text):
		return re.sub(self.puncPat, '', text)

	def condenseSpace(self, text):
		return re.sub(self.spacePat,' ',text)	
