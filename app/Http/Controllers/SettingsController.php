<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{

    public function index()
    {
        $settings = Settings::get();

        return view('settings.index', compact('settings'), ['title' => 'Einstellungen']);
    }
}
