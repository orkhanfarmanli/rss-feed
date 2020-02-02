<?php

namespace App\Http\Controllers;


class PageController extends Controller
{
    /**
     * Index page
     * 
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('index');
    }
}
