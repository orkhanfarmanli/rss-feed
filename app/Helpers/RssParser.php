<?php

namespace App\Helpers;


class RssParser
{
    /**
     * Parse rss feed
     * 
     * @param string $rss_feed_url
     * @return \SimpleXMLElement
     */
    public static function getFeed(string $feed_url)
    {
        $xml = file_get_contents($feed_url);
        return simplexml_load_string($xml);
    }
}
