import facebook
import json
import test
import urllib2

def pretty(obj):
    return json.dumps(obj, sort_keys=True, indent=2)

#urllib2.urlopen("https://graph.facebook.com/?269032479960344")
    
# get access token from 
# https://developers.facebook.com/tools/explorer"
access_token = None

if access_token == None:
    access_token = raw_input("\nCopy and paste token from https://developers.facebook.com/tools/explorer\n>  ")

graph = facebook.GraphAPI(access_token)
feed = graph.get_object("269032479960344/feed")

print type(feed)
print feed.keys()
print type(feed['data'])
print len(feed['data'])
print pretty(feed['data'][2])
print feed['data'][2]["message"]
