<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DatabaseController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);

        $this->middleware('permission:database', ['only' => ['create', 'store']]);
        $this->middleware('permission:database-backup', ['only' => ['backup', 'update']]);
        $this->middleware('permission:database-clear', ['only' => ['clear', 'update']]);
    }

    public function index()
    {
        return view('database.index', ['title' => __('Datenbank')]);
    }


    public function backup()
    {
        // $request->validated();


        return redirect()->route('database');
        // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }
    public function clear()
    {
        // $request->validated();


        return redirect()->route('database');
        // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }

    public function store()
    {
        exec("ls -la", $output);
        // $request->validated();


        return redirect()->route('database')
            ->with('success', ' Erfolgreich!');
    }

    public function destory(Request $request)
    {
        // $request->validated();


        return redirect()->route('database');
        // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }
}
