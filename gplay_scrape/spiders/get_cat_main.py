from bs4 import BeautifulSoup
from selenium.webdriver.chrome.service import Service
# import urllib
from selenium import webdriver
import lxml
# import re
import sys
import mysql.connector
import time

try:
    conn = mysql.connector.connect(host='localhost', database='411_info', user='root', password='')

except Exception as ex:
    print("Connection failed")
    print(ex)
    sys.exit(1)
    
conn = mysql.connector.connect(
        host='localhost', database='411_info', user='root', password='')

curr = conn.cursor()

s = Service('C:\Program Files (x86)\chromedriver.exe')
driver = webdriver.Chrome(service=s)
# driver.get("https://play.google.com/store/apps/top")
driver.get("https://play.google.com/store/apps")
response = driver.execute_script("return document.documentElement.outerHTML")

# driver.quit()
base_url = "https://play.google.com"
soup = BeautifulSoup(response, 'lxml')
Cats = soup.findAll("a", class_="r2Osbf")

for cat in Cats:
    
    
    cat_nm = (cat['title'])
    cat_abs_nm = (cat['href'].split('/store/apps/category/')[-1]).replace("?", ", ")
    cat_url = base_url+(cat['href'])
    
    print("category name", cat_nm)
    print("category abs name", cat_abs_nm)
    print("category url", cat_url, "\n")
    
    ## INSERT IGNORE INTO utd_app_desc (app_tb_id, app_play_id, app_name, app_desc) VALUES (%s, %s, %s, %s)
    
    ## time.sleep(2)
    # curr.execute("INSERT IGNORE INTO googleplay_cat (cat_name, cat_abs_name, cat_url) VALUES ('"+str(cat_nm)+"', '"+str(cat_abs_nm)+"', '"+str(cat_url)+"') ")
    # # curr.execute("UPDATE custom_posts SET app_desc = '"+str(desc)+"cat_abs_', app_name = '"+str(title)+"' WHERE app_id = '"+str(app_id)+"' ")
    # conn.commit()