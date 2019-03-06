import requests
import re
import os
from bs4 import BeautifulSoup, SoupStrainer

baseSearchURL = "https://www.epicurious.com/search?content=recipe&page="
baseSiteURL = "https://www.epicurious.com"
#append number from 1-1989 to searchURL to get all search pages
for pageNum in range(1989):
	searchPage = requests.get(baseSearchURL + str(pageNum))

	#use soupstrainer to basically create a filter to only look at a tags with link containing /recipes/food/views/  <--all recipe have that path
	pageLinks = SoupStrainer('a', href=re.compile('/recipes/food/views/'))
	#make list using above filter
	allLinks = [tag for tag in BeautifulSoup(searchPage.content, 'html.parser', parse_only=pageLinks)]
	#for every link we just scraped
	for i in range(0, len(allLinks), 5):	#every 5th because each link on search page has 5 duplicates
		#add extension to end of base site URL to get full page URL
		pageName = baseSiteURL + allLinks[i]['href']
		
		#grab ingredients and recipe and nutrition stuff from each page and write it to file
		page = requests.get(pageName)
		recipeName = pageName[46:]
		file = open("r-Epicurious-" + recipeName+".txt","w")
	
		#make the soup for each page
		soup = BeautifulSoup(page.content, 'html.parser')
		
		#this grabs all li tags with class=ingredient, stores them in list and writes them to file with header
		everyDamnThing = soup.find("html")
		file.write(everyDamnThing.prettify())
		file.close()
		print(i)
#uncomment following to grab specific fields -- results in much less data
'''		file.write("---------------INGREDIENTS----------------\n")
		for ingred in ingredients:

			file.write(ingred.get_text(strip=True) + "\n")


		file.write("\n--------------PREPARATION----------------\n")
		recipe = soup.findAll("li", "preparation-step")
		for step in recipe:
			file.write(step.get_text(strip=True) + "\n")

		#parallel lists containing corresponding nutrition labels and data
		file.write("\n-------------NUTRITIONAL INFO--------------\n")
		#nutritionLabels = ["Calories","Carbohydrates","Fat","Protein","Saturated Fat","Sodium","Polyunsaturated Fat","Fiber","Monounsaturated Fat","Cholesterol"]#soup.findAll("span", "nutri-label")
		nutritionLabels = soup.findAll("span", "nutri-label")
		nutritionValues = soup.findAll("span", "nutri-data")
		for j in range(len(nutritionLabels)):
			file.write(nutritionLabels[j].get_text(strip=True) + " - ")
			if len(nutritionValues[j].get_text(strip=True)) == 0:
				file.write("0g\n")
			else:
				file.write(nutritionValues[j].get_text(strip=True) + "\n")

		recipeYield = soup.find("dd", "yield")
		recActiveTime = soup.find("dd", "active-time")
		recTotalTime = soup.find("dd", "total-time")
		if recipeYield is not None:
			file.write("\nYield: " + recipeYield.get_text() + "\n")
		if recActiveTime is not None:
			file.write("Active Time: " + recActiveTime.get_text() + "\n")
		if recTotalTime is not None:
			file.write("Total Time: " + recTotalTime.get_text() + "\n")
		
		file.close()
		print(i)
#move all new txt to a recipe folder
if not os.path.exists("./recipes"):
	os.makedirs("./recipes")
os.system("mv r-Epicurious-* recipes")
'''

