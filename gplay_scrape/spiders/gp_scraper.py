import scrapy
from bs4 import BeautifulSoup
from selenium.webdriver.chrome.service import Service
# import urllib
from selenium import webdriver
import lxml
# import re
import sys
import mysql.connector
import time
from ..items import GplayScrapeItem

class GpScraperSpider(scrapy.Spider):
    name = 'gp_scraper'
    allowed_domains = ['play.google.com']
    start_urls = ['https://play.google.com/store/apps/top']

    def parse(self, response):
        items = GplayScrapeItem()
        # app_name = response.xpath('//*[@id="fcxH9b"]/div[4]/c-wiz[3]/div/c-wiz/div/div/c-wiz/c-wiz[1]/c-wiz/div/div[2]/div/c-wiz/div/div/div[2]/div/div/div[1]/div/div/div[1]/a/div/text()').getall()
        options = webdriver.ChromeOptions()
        options.add_argument("headless")
        desired_capabilities = options.to_capabilities()
        self.driver = webdriver.Chrome(desired_capabilities=desired_capabilities)
        
        
        s = Service('C:\Program Files (x86)\chromedriver.exe')
        driver = webdriver.Chrome(service=s)
        driver.get("https://play.google.com/store/apps/top")
        response = driver.execute_script("return document.documentElement.outerHTML")
        
        apps = response.find_element_by_xpath('//*[@id="action-dropdown-children-Categories"]/div/ul/li/ul/li/a')
        
        for app in apps:
            cat = app.xpath("./@href").getall()
            
            
            items['cat_name'] = cat
            
            yield items