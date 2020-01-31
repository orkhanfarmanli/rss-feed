<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Index page
     * @return Response
     */
    public function index()
    {
        return view('index');
    }
}
