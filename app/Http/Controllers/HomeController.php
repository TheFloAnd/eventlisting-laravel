<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Groups;

class HomeController extends Controller
{
    public function index()
    {
        $today = Home::today()->get();

        $future = Home::future()->get();
        return view('welcome', compact('today', 'future'),['title' => 'Dashboard']);
    }
}
