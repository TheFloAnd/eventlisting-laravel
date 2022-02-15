<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Groups;
use App\Models\Settings;

class HomeController extends Controller
{
    public function index()
    {
        $today = Home::today()->get();

        $future = Home::future()->get();

        $title = Settings::setting('name');
        $preview = Settings::setting('future_day');
        return view('welcome', compact('today', 'future', 'preview'),['title' => $title]);
    }
}
