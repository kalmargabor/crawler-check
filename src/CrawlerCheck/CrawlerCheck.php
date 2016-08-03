<?php

namespace Kalmargabor\CrawlerCheck;

/**
 * Verify Googlebot (or others) by their IP addresses
 *
 * @version 1.0
 * @link https://github.com/kalmargabor/crawler-check
 * @author kalmargabor (Gabor Kalmar)
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */
class CrawlerCheck
{
    /**
     * @var array the hosts that are used to validate the examined IP addresses
     */
    protected $validHosts = ['google.com', 'googlebot.com'];

    /**
     * Checks whether the given IP address really belongs to a valid host or not
     *
     * @param $ip the IP address to check
     * @return bool true if the given IP belongs to any of the valid hosts, otherwise false
     */
    public function isValid($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            throw new \InvalidArgumentException('The IP address is not valid: ' . $ip);
        }

        $host = gethostbyaddr($ip);
        $ipAfterLookup = gethostbyname($host);

        $hostIsValid = !!array_filter($this->validHosts, function ($validHost) use ($host) {
            return stristr($host, $validHost) !== false;
        });

        return $hostIsValid && $ipAfterLookup === $ip;
    }
}