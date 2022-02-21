<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groups;

class GroupsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {

        $active = Groups::used()->get();

        $inactive = Groups::unused()->get();

        return view('groups.index', compact('active', 'inactive'), ['title' => 'Gruppen']);
    }
}
