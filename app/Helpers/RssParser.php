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
    public static function getRssFeed(string $rss_feed_url)
    {
        $xml = file_get_contents($rss_feed_url);
        return simplexml_load_string($xml);
    }
}
