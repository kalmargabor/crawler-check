# Crawler check

### Composer install

```
composer require kalmargabor/crawler-check
```

### Examples

```php
$crawlerCheck = new \Kalmargabor\CrawlerCheck\CrawlerCheck();

$ipToCheck = 'ip.address.ip.address';

var_dump($crawlerCheck->isValid($ipToCheck)); 
```

### Google help on verification

https://support.google.com/webmasters/answer/80553
