import requests
from bs4 import BeautifulSoup
from html.parser import HTMLParser
import urllib.request, urllib.error, urllib.parse
import re
import requests
import http.cookiejar
import http.client
from random import randint
from time import sleep
from lxml.html import fromstring
import requests
from itertools import cycle
import traceback

headers = {'User-Agent': 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10.12;rv:50.0) Gecko/20100101 Firefox/50.0'}
cookie = http.cookiejar.CookieJar()
handler = urllib.request.HTTPCookieProcessor(cookie)
opener = urllib.request.build_opener(handler)
global_links = []

f = open("recipes/foodie_crush_output1.txt", "w")

def getLinks(url):
	links=[]
	page = requests.get(url)
	soup = BeautifulSoup(page.text, 'html.parser')
	a_tags = soup.find_all('a')
	ignore_list= ['/category','/tag/','/recipes/','/faq/','/about/','/workwithme/','/contact/','%20']
	for a in a_tags:
		add_to_list= True
		if 'www.foodiecrush' in a['href']:
			if a['href'] not in global_links:
				for i in ignore_list:
					if i in a['href']:
						add_to_list=False
				if add_to_list:
					links.append(a['href'])
					global_links.append(a['href'])
	return links
pg_count=1
out_num=16
for j in range(17,31):
	print(("-------------Menu page "+str(j)+" of 31-----------------"))
	page_links = getLinks("https://www.foodiecrush.com/category/recipes/page/"+str(j)+"/")

	for link in page_links:
		if 'www.' in link:
			sleep(randint(1,5))
			request = urllib.request.Request(url = link, headers=headers)
			try:
				r=requests.get(link)
				r.raise_for_status()
			except requests.exceptions.HTTPError as errh:
				print(("Http Error:",errh))
			except requests.exceptions.ConnectionError as errc:
				print(("Error Connecting:",errc))
			except requests.exceptions.Timeout as errt:
				print(("Timeout Error:",errt))
			except requests.exceptions.RequestException as err:
				print(("OOps: Something Else",err))

			if(r.status_code==200):
				html_page = requests.get(link)
				f.write(html_page.text)
				print(("Recipe num: "+str(pg_count)+" - "+link))
				pg_count+=1
				#if(pg_count%40==0):
				f.close()
				out_num+=1
				f = open("./recipes/foodie_crush_output"+str(out_num)+".txt", "w")
				

				f.write("*********************************************************")


