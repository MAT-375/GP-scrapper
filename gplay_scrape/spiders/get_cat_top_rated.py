from bs4 import BeautifulSoup
from selenium.webdriver.chrome.service import Service
# import urllib
from selenium import webdriver
import lxml
# import re
import sys
import mysql.connector
import time
from selenium.webdriver.common.by import By
from selenium.webdriver.chrome.options import Options

try:
    conn = mysql.connector.connect(host='localhost', database='411_info', user='root', password='')

except Exception as ex:
    print("Connection failed")
    print(ex)
    sys.exit(1)
    
conn = mysql.connector.connect(
        host='localhost', database='411_info', user='root', password='')



options = Options()
options.headless = True
s = Service('C:\Program Files (x86)\chromedriver.exe')
driver = webdriver.Chrome(service=s)


curr = conn.cursor()

sql = "SELECT * FROM googleplay_cat WHERE status=0"
sql2 = curr.execute(sql)
rows = curr.fetchall()

for row in rows:
    
    url = (row[3])
    cat_name = (row[1])
    # driver.get("https://play.google.com/store/apps/top")
    # driver.get("https://play.google.com/store/apps/category/GAME_ACTION")
    driver.get(str(url))

    # response = driver.execute_script("return document.documentElement.outerHTML")
    
    time.sleep(5)
    
    # driver.quit()
    base_url = "https://play.google.com"
    # soup = BeautifulSoup(response, 'lxml')
    # Cats = soup.findAll("a", class_="r2Osbf")

    # find_elements(by=By.XPATH, value=xpath)
    Cats = driver.find_elements(by=By.XPATH, value="//a[@aria-label='Check out more content from Top-rated games']")

    if Cats:

            for cat in Cats:
                
                cat_top = (cat.get_attribute('href'))
                cat_nm = cat_name 
                        
                print(cat_name, "\n", "URL", cat_top, "\n")
            
                ## INSERT IGNORE INTO utd_app_desc (app_tb_id, app_play_id, app_name, app_desc) VALUES (%s, %s, %s, %s)
                
                ## time.sleep(2)
                # curr.execute("INSERT IGNORE INTO googleplay_cat (cat_name, cat_abs_name, cat_url) VALUES ('"+str(cat_nm)+"', '"+str(cat_abs_nm)+"', '"+str(cat_url)+"') ")
                # # curr.execute("UPDATE custom_posts SET app_desc = '"+str(desc)+"cat_abs_', app_name = '"+str(title)+"' WHERE app_id = '"+str(app_id)+"' ")
                # conn.commit()
    else:
        print("CATEGORY DOESN'T CONTAIN TOP RATED APPS' LIST")