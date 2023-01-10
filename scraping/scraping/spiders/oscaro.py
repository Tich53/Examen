import scrapy
import scrapy
from ..items import  SpyScrapeItem
from scrapy.linkextractors import LinkExtractor
from scrapy.spiders import CrawlSpider, Rule
from datetime import datetime
import requests
from .getJwtToken import tokenPass
from dotenv import load_dotenv
import os
import json
from datetime import datetime

load_dotenv()
class OscaroCrawlerSpider(CrawlSpider):
    name = 'oscaro'
    allowed_domains = [os.getenv("FIRST_DOMAIN")]
    start_urls = [os.getenv("ENTRY_POINT_FIRST_DOMAIN")]
    now = datetime.today()
    now_time = now.strftime("%H.%M.%S_%d.%m.%y")
    directory = os.getcwd()
    custom_settings = {
        'LOG_FILE': directory+'/scraping/logs/'+name+now_time+'.log',
    }

    rules = (
        Rule(LinkExtractor(restrict_xpaths='//*[@id="categoriesTree"]'),
             callback ='parse_products',
             follow = True),
        Rule(LinkExtractor(restrict_css='div.column-nav ul.link-list.link-primary a'),
             callback ='parse_products',
             follow = True),
    )
        
    def parse_products(self, response):
        item = SpyScrapeItem()
        for products in response.css('article.product-card'):
            item['price'] = products.css('p.product-card-info span.price::text').get()
            item['rawBrand'] = products.css('article.product-card h3 span.product-name::text').get()
            item['rawReference'] = products.css('.product-name+ span::text').get()
            if (item['price'] != None and item['price'] != [] and item['price'] !="" and item['price'] !=" ") and item['rawBrand'] and item['rawReference'] :
                item['rawBrand'] = products.css('article.product-card h3 span.product-name::text').get().replace('-','').strip().lower()
                item['rawName'] = products.css('.product-name~ span+ span::text').get()
                if item['rawName'] == None:
                    item['rawName'] = 'NameNotFound'
                item['rawReference'] = products.css('.product-name+ span::text').get()
                item['price'] = float(products.css('p.product-card-info span.price::text').get().replace('€','').replace(',','.').strip())
                item['url'] = products.css('article.product-card a').xpath('@href').get()
                yield item
                data = dict(item)
                symfony_url  = os.getenv("COMPETITOR_PRODUCT_API") 
                headers = {'Authorization': "Bearer "+ tokenPass}
                response = requests.post(symfony_url, json=data, headers=headers, verify=False)
                print(response.status_code)
                log_url = os.getenv("LOG_API")
                stats_data = json.dumps(self.crawler.stats.get_stats(), default=str )
                log_response = requests.post(log_url, json={"data": stats_data,"name":"oscaro"}, headers=headers,verify=False)
                print(log_response.status_code)
        return item
    
