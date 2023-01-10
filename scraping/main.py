from scrapy.crawler import CrawlerRunner
from scraping.spiders.oscaro import OscaroCrawlerSpider
from scraping.spiders.misterAuto import MisterCrawlerSpider
from scrapy.utils.log import configure_logging
from scrapy.utils.project import get_project_settings
from twisted.internet import reactor ,defer
from apscheduler.schedulers.twisted import TwistedScheduler 
from scrapy.crawler import CrawlerProcess

def main():

    # process = CrawlerProcess(get_project_settings()) 
    # scheduler = TwistedScheduler() 
    # scheduler.add_job(process.crawl, 'interval', args=[OscaroCrawlerSpider], seconds=20) 
    # scheduler.add_job(process.crawl, 'interval', args=[MisterCrawlerSpider], seconds=35) 
    # scheduler.start() 
    # process.start(False)

    configure_logging()
    settings = get_project_settings()
    runner = CrawlerRunner(settings)
    
    @defer.inlineCallbacks
    def crawl():
        yield runner.crawl(OscaroCrawlerSpider) 
        yield runner.crawl(MisterCrawlerSpider)
        reactor.stop()

    crawl()
    reactor.run() # the script will block here until the last crawl call is finished
    

if __name__ == '__main__':
    main()
