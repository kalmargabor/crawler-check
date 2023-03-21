<?php

namespace Kalmargabor\CrawlerCheck;

/**
 * Verify Googlebot (or others) by their IP addresses
 *
 * @version 1.0.1
 * @link https://github.com/kalmargabor/crawler-check
 * @author kalmargabor (Gabor Kalmar)
 * @license https://opensource.org/licenses/MIT The MIT License (MIT)
 */
class CrawlerCheck
{
    /**
     * @var array the hosts that are used to validate the examined IP addresses
     */
    protected $validHosts = ['.google.com', '.googlebot.com'];

    /**
     * Checks whether the given IP address really belongs to a valid host or not
     *
     * @param $ip string the IP address to check
     * @return bool true if the given IP address belongs to any of the valid hosts, otherwise false
     */
    public function isValid($ip)
    {
        if (filter_var($ip, FILTER_VALIDATE_IP) === false) {
            throw new \InvalidArgumentException('The IP address is not valid: ' . $ip);
        }

        $host = gethostbyaddr($ip);
        $ipAfterLookup = gethostbyname($host);

        // If no hostname is set, `$ipAfterLookup` will contain it's ip address, so no array check is needed.
        if ($host === $ipAfterLookup) {
            return false;
        }

        $hostIsValid = !!array_filter($this->validHosts, function ($validHost) use ($host) {
            return $this->endsWith($host, $validHost);
        });

        return $hostIsValid && $ipAfterLookup === $ip;
    }

    /**
     * @param $text the whole string we want to check if it ends with $ending
     * @param $ending
     * @return bool true if $text ends with $ending
     */
    protected function endsWith($text, $ending)
    {
        $length = strlen($text);
        if(!$length) {
            return true;
        }

        return substr($ending, -$length) === $text;
    }
}
