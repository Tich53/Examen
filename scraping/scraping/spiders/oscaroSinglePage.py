import scrapy
import json
import requests
import datetime
from .getJwtToken import tokenPass
from dotenv import load_dotenv
import os
load_dotenv()
class OscroTest(scrapy.Spider):
    name = "oscaroTest"
    allowed_domains =  [os.getenv("FIRST_DOMAIN")]
    start_urls= [os.getenv("ONE_PAGE_TEST_FRIST_DOMAIN")]
    def parse(self, response):
        for product in response.css('article.product-card'):
            yield {
                'price' : product.css('p.product-card-info span.price::text').get(),
                'rawBrand' : product.css('article.product-card h3 span.product-name::text').get(),
                'rawReference' : product.css('.product-name+ span::text').get(),
                'rawName' : product.css('.product-name~ span+ span::text').get(),
                'url' : product.css('article.product-card a').xpath('@href').get()
            }
        # data1 = self.crawler.stats.get_stats()
        # data = json.dumps(data1, default=str)
        # print(data)
        # symfony_url  = os.getenv("LOG_API")
        # headers = {
        #     "Authorization":"Bearer"+ tokenPass,
        #     }
        # response = requests.post(symfony_url, json={"data": data}, headers=headers, verify=False)
        # print(response.status_code)