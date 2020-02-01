<?php

namespace App\Helpers;

use SimpleXMLElement;

class TextParser
{
    /**
     * Top 50 common words in English language.
     * source: https://en.wikipedia.org/wiki/Most_common_words_in_English
     */
    private static $common_words = [
        'the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'I', 'it', 'for', 'not', 'on', 'with', 'he', 'as', 'you', 'do', 'at', 'this', 'but', 'his', 'by', 'from', 'they', 'we', 'say', 'her', 'she', 'or', 'an', 'will', 'my', 'one', 'all', 'would', 'there', 'their', 'what', 'so', 'up', 'out', 'if', 'about', 'who', 'get', 'which', 'go', 'me,'
    ];


    /**
     * Find most frequent words in given SimpleXMLElement
     * @param SimpleXMLElement $feed 
     * @return array
     */
    public static function findMostFrequentWords(SimpleXMLElement $feed)
    {
        $words = [];

        foreach ($feed->children() as $post) {
            if ($post->title && $post->summary) {
                $stripped_title = strip_tags($post->title);
                $stripped_summary = strip_tags($post->summary);

                $found_words = str_word_count($stripped_title . ' ' . $stripped_summary, 1);
                $words = array_merge_recursive($words, $found_words);
            }
        }

        $most_frequent_words = array_count_values($words);

        foreach ($most_frequent_words as $key => $value) {
            if (in_array(strtolower($key), self::$common_words)) {
                unset($most_frequent_words[$key]);
            }
        }

        arsort($most_frequent_words);

        return array_slice($most_frequent_words, 0, 10);
    }
}
