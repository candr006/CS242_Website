#!/bin/bash

echo "Crawling FoodieCrush website"
python crawlers/foodiecrush.py
echo "Crawling Chowhound website"
python crawlers/chowhound.py
echo "Crawling Epicurious website"
python crawlers/epicuriousCrawl.py

mkdir crawlers/recipes/
mv crawlers/*.txt ./recipes/
