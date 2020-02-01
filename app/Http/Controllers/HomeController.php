<?php

namespace App\Http\Controllers;

use App\Helpers\TextParser;

class HomeController extends Controller
{
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
        $most_frequent_words = TextParser::findMostFrequentWords($feed);

        return view('home', ['feed' => $feed, 'most_frequent_words' => $most_frequent_words]);
    }
}
