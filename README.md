# Install
## Composer

require kalmargabor/crawler-check

# Examples

$crawlerCheck = new \Kalmargabor\CrawlerCheck\CrawlerCheck();

$ipToCheck = 'ip.address.ip.address';

var_dump($crawlerCheck->isValid($ipToCheck)); 
