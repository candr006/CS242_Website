import requests
import re
import os
from bs4 import BeautifulSoup
import time

site = "https://www.chowhound.com/recipes?page="

#append number from 1-252 to searchURL to get all search pages
for pageNum in range(252):
    pages = requests.get(site + str(pageNum))
    pageContent = BeautifulSoup(pages.content, 'html.parser')

    links = [div.find('a') for div in pageContent.findAll('div', attrs={'class': 'freyja_box freyja_box7 fr_box_rechub'})]

    href_links = []

    for link in links:
        link['href']
        href_links.append(link['href'])

    for href in href_links:
        time.sleep(3)
        page = requests.get(href)

        recipeName = href[34:]
        file = open(recipeName + '.txt', 'w')

        pageContent = BeautifulSoup(page.content, 'html.parser')

        file.write(str(pageContent))

        # this grabs all li tags with class=ingredient, stores them in list and writes them to file with header
        # ingredients = [div.findAll('li') for div in pageContent.findAll('div', attrs={'class': 'freyja_box freyja_box81'})]
        # flat_list = []
        # for sublist in ingredients:
        #     for item in sublist:
        #         flat_list.append(item)
        #
        # print flat_list
        #
        # file.write("---------------INGREDIENTS----------------\n")
        #
        # for ingred in ingredients:
        #     file.write(ingred + "\n")

        # file.write("\n--------------PREPARATION----------------\n")
        # recipe = [div.findAll('li') for div in pageContent.findAll('div', attrs={'class': 'frr_wrap'})]
        # print recipe
        # for step in recipe:
        #     file.write(step.encode('utf-8').text.strip() + "\n")

        # # parallel lists containing corresponding nutrition labels and data
        # file.write("\n-------------NUTRITIONAL INFO--------------\n")
        # nutritionLabels = soup.findAll("span", "nutri-label")
        # nutritionValues = soup.findAll("span", "nutri-data")
        # for i in range(len(nutritionLabels)):
        #     file.write(nutritionLabels[i].get_text(strip=True) + " - " + nutritionValues[i].get_text(strip=True) + "\n")

#move all new txt to a recipe folder
if not os.path.exists("./recipes"):
    os.makedirs("./recipes")
os.system("mv *.txt recipes")

