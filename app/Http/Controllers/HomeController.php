<?php

namespace App\Http\Controllers;

use App\Helpers\RssParser;
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
        $feed = RssParser::getRssFeed("https://www.theregister.co.uk/software/headlines.atom");
        $most_frequent_words = TextParser::findMostFrequentWords($feed);

        return view('home', ['feed' => $feed, 'most_frequent_words' => $most_frequent_words]);
    }
}
