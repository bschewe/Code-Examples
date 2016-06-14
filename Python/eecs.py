import json
import urllib
import urllib2
import twitter
import json

def pretty(obj):
	return json.dumps(obj, sort_keys=True, indent=2)
	
api = twitter.Api(consumer_key='oJPiiRtIWHJQrIIkxKckwPbrD',
                      consumer_secret='WwmiDTNwkWVgN7zCWl7953UHvp3aEGNGwf6Wy9kTaMMB9hEoW0',
                      access_token_key='402273158-Ys3DPOwH0O0PxStRWZG0f3MIdxb1xB3kxuQnMD6C',
                      access_token_secret='3t50kGXuQzHTlIWJm27q9k6TzedGIHFMXRfOmP4un43lo')
                      	
statuses = api.GetUserTimeline(screen_name='taylorswift13', count=200)
list = []

screenname = raw_input("Please enter a screenname: ")
friendsstatuses = api.GetUserTimeline(screen_name=screenname, count=200)
friendsslist = []

for x in friendsstatuses:
	friendsslist.append(x.text)

for x in statuses:
	list.append(x.text)

retweetlist = [] #I don't think we want to use retweets for this so I put them away here
originaltweets = []
friendsstweets = []

for x in list:
	y = x.encode('utf-8')
	if y[0:2] == 'RT':
		retweetlist.append(y) #Retweet list, nothing happens but they just chill here
	else:
		originaltweets.append(y)

for x in friendsslist:
	y = x.encode('utf-8')
	if x[0:2] == 'RT':
		retweetlist.append(y)
	else:
		friendsstweets.append(y)

	
outfile = open('tweets.txt', 'w')
outfile1 = open('tw.txt', 'w')

for x in originaltweets:
	outfile.write(x)
	outfile.write('\n' * 2)
	
for p in friendsstweets:
	outfile1.write(p)
	outfile1.write('\n' * 2)
	
outfile.close()
outfile1.close()