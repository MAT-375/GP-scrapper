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
driver.get("https://play.google.com/store/apps/top")
response = driver.execute_script("return document.documentElement.outerHTML")

# driver.quit()
sql = "SELECT cat_url FROM googleplay_cat WHERE status=0"
sql2 = curr.execute(sql)
rows = curr.fetchall()

for row in rows:
    
    url = (row[0])
    cat_name = (row[2])
    soup = BeautifulSoup(response, 'lxml')
    Apps = soup.findAll("a", class_="poRVub")

    for app in Apps:
        
        time.sleep(5)
        
        gp_id = (app['href'].split('/store/apps/details?id=')[-1])
        cat_nm = cat_name
        print(gp_id)
        
        
        # INSERT IGNORE INTO utd_app_desc (app_tb_id, app_play_id, app_name, app_desc) VALUES (%s, %s, %s, %s)
        
        # time.sleep(2)
        curr.execute("INSERT IGNORE INTO googleplay_id (gp_id, cat_name) VALUES ('"+str(gp_id)+"', '"+str(cat_nm)+"') ")
        # curr.execute("UPDATE custom_posts SET app_desc = '"+str(desc)+"', app_name = '"+str(title)+"' WHERE app_id = '"+str(app_id)+"' ")
        conn.commit()