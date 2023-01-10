import scrapy
from ..items import SpyScrapeItem
import re
import json
from bs4 import BeautifulSoup
import requests
from .getJwtToken import tokenPass
from dotenv import load_dotenv
import os
load_dotenv()
class MisterTest(scrapy.Spider):
    name = 'misterTest'
    allowed_domains = [os.getenv("SECOND_DOMAIN")]
    start_urls = [os.getenv("ONE_PAGE_TEST_SECOND_DOMAIN")]
    custom_settings = {
        "DOWNLOAD_DELAY" : "5"
    }
    def parse(self, response):
        item = SpyScrapeItem()
        for product in response.css('div.listing-container'):
            item["url"] = product.css('div.product-title a').xpath('@href').get()
            html_doc = requests.get(item["url"]).text
            soup = BeautifulSoup(html_doc, 'lxml')
            item['price'] = float(soup.find('span', class_='large-price--std').text.replace('€','').replace(',','.').strip())
            item["rawBrand"]= product.css('div.product-title div.small-text::text').get().split('-')[0].strip()
            item["rawReference"] = product.css('div.product-title div.small-text::text').get().split(':')[1].strip()
            item["rawName"] = product.css('div.product-title a::text').get().strip()
            yield item
            # data = dict(item)
            # symfony_url  = os.getenv("COMPETITOR_PRODUCT_API")
            # headers = {'Authorization': "Bearer " + tokenPass.replace('"', "")}
            # response = requests.post(symfony_url, json=data, headers=headers, verify=False)
            # print(response.status_code)  
            # stats_data = json.dumps(self.crawler.stats.get_stats(), default=str )
            # log_url = os.getenv("LOG_API")
            # log_response = requests.post(log_url, json={"data": stats_data}, headers=headers,verify=False)
            # print(log_response.status_code) 
        return item