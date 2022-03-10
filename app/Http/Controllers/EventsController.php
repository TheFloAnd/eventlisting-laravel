<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Events;
use App\Models\Groups;
use App\Http\Requests\EventRequest;
use Datetime;
use DateInterval;
use DatePeriod;

class EventsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $data = Events::events()->order()->get();

        return view('events.index', compact('data'), ['title' => 'Termine']);
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
        // $validated = $request->validate();

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

        if (!$request->has('repeat')) {
            Events::create([
                'event' => $request->input('event'),
                'team' => $group,
                'start' => $request->input('start_date'),
                'end' => $request->input('end_date'),
                'room' => $request->input('room'),
            ]);
        }
        if ($request->has('repeat')) {
            $uuid = uniqid();

            $begin_start = new DateTime($request->input('start_date'));
            $end = new DateTime($request->input('repeat_till'));
            $interval = DateInterval::createFromDateString($request->input('repeat_interval') . ' days');
            $period_start = new DatePeriod($begin_start, $interval, $end);


            $diff_start_date = new DateTime($request->input('start_date'));
            $diff_end_date = new DateTime($request->input('end_date'));
            $interval = date_diff($diff_start_date, $diff_end_date);
            // dd($interval);
            foreach ($period_start as $row) {

                $start = $row->format("Y-m-d H:i");
                $end_date = $row->modify($interval->format($interval->d . ' days ' . $interval->h . ' hours ' . $interval->i . ' minutes'));
                $end = $end_date->format("Y-m-d H:i");

                Events::create([
                    'event' => $request->input('event'),
                    'team' => $group,
                    'start' => $start,
                    'end' => $end,
                    'room' => $request->input('room'),
                    'repeat' => 1,
                    'repeat_parent' => $uuid,
                    'repeat_dif' => $request->input('repeat_interval'),
                ]);
            }
        }


        return redirect()->route('events');
        // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }

    public function edit($id)
    {

        $result = Events::find($id);
        if ($result->repeat_parent != NULL) {
            $result_future = Events::following($result->repeat_parent)->events()->order()->get();
        }else{
            $result_future = NULL;
        }

        $proposal = Events::proposals()->get();
        $proposal_room = Events::proposal_room()->get();
        $groups = Groups::get();

        return view('events.edit', compact('result', 'result_future', 'proposal', 'proposal_room', 'groups'), ['title' => 'Termin Bearbeiten']);
    }
}
