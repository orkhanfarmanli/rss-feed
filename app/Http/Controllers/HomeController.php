<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    private $common_words = [
        'the', 'be', 'to', 'of', 'and', 'a', 'in', 'that', 'have', 'I', 'it', 'for', 'not', 'on', 'with', 'he', 'as', 'you', 'do', 'at', 'this', 'but', 'his', 'by', 'from', 'they', 'we', 'say', 'her', 'she', 'or', 'an', 'will', 'my', 'one', 'all', 'would', 'there', 'their', 'what', 'so', 'up', 'out', 'if', 'about', 'who', 'get', 'which', 'go', 'me,'
    ];

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $rss_feed_url = "https://www.theregister.co.uk/software/headlines.atom";
        $xml = file_get_contents($rss_feed_url);
        $feed = simplexml_load_string($xml);
        $most_frequent_words = $this->findMostFrequentWords($feed);

        return view('home', ['feed' => $feed, 'most_frequent_words' => $most_frequent_words]);
    }

    /**
     * Find most frequent words in given string
     * @return array
     */
    private function findMostFrequentWords($feed)
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
            if (in_array(strtolower($key), $this->common_words)) {
                unset($most_frequent_words[$key]);
            }
        }

        arsort($most_frequent_words);

        return array_slice($most_frequent_words, 0, 10);
    }
}
