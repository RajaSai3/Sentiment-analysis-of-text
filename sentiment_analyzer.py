# -*- coding: utf-8 -*-
"""
Created on Tue Mar  3 18:24:30 2020

@author: rajas
"""
# import SentimentIntensityAnalyzer class 
# from vaderSentiment.vaderSentiment module. 
from vaderSentiment.vaderSentiment import SentimentIntensityAnalyzer 

# function to print sentiments 
# of the sentence. 
def sentiment_scores(sentence): 
	# Create a SentimentIntensityAnalyzer object. 
    sid_obj = SentimentIntensityAnalyzer() 

	# polarity_scores method of SentimentIntensityAnalyzer 
	# object gives a sentiment dictionary. 
	# which contains pos, neg, neu, and compound scores. 
    ss = sid_obj.polarity_scores(sentence) 
    print(sentence,end='')
    for i in ss : print(ss[i])

# Driver code

myfile=open("input.txt","r")
for data in myfile:
    if data == '\n':
        continue

    sentiment_scores(data)

myfile.close()
