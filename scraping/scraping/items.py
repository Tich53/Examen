# Define here the models for your scraped items
#
# See documentation in:
# https://docs.scrapy.org/en/latest/topics/items.html

import scrapy


class SpyScrapeItem(scrapy.Item):
    # define the fields for your item here like:

    url = scrapy.Field()
    rawName = scrapy.Field()
    rawReference = scrapy.Field()
    rawBrand = scrapy.Field()
    price = scrapy.Field()
