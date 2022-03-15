<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
        // Auth::user()->name == 'Admin'
    }

    public function index()
    {
        return view('database.index', ['title' => 'Datenbank']);
    }

    public function destory(Request $request)
    {
        // $request->validated();


        return redirect()->route('database');
        // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }
}