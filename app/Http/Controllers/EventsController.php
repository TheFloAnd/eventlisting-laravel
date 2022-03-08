<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Groups;

class EventsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Events::events()->order()->get();

        return view('events.index', compact('data'),['title' => 'Termine']);
    }


    public function create()
    {

        $proposal = Events::proposals()->get();
        $proposal_room = Events::proposal_room()->get();
        $groups = Groups::get();

        return view('events.create', compact('proposal', 'proposal_room', 'groups'), ['title' => 'Termin Hinzufügen']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        // $validated = $request->validated();

        if (is_array($request->input('group'))) {
            $group = '';
            $i = 0;
            $j = 1;
            $count_groups = count($request->input('group'));
            foreach ($request->input('group') as $row) {
                $count_groups == $j ? $group .= $row : $group .= $row . ';';
                $i++;
                $j++;
            }
        } else {
            $group = $request->input('group');
        }

        Events::create([
            'event' => $request->input('event'),
            'team' => $group,
            'start' => $request->input('start_date'),
            'end' => $request->input('end_date'),
            'room' => $request->input('room'),
        ]);


        return redirect()->route('events');
            // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }

}
