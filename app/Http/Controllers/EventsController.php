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
        if (Events::events()->order()->count() > 25) {
            $data = Events::events()->order()->lazyById(25, $column = 'id');
        } else {
            $data = Events::events()->order()->get();
        }

        $groups = Groups::withTrashed()->get();

        return view('events.index', compact('data', 'groups'), ['title' => 'Termine']);
    }


    public function create()
    {

        $proposal = Events::proposals()->get();
        $proposal_room = Events::proposal_room()->get();
        $groups = Groups::get();
        if ($groups->isEmpty()) {
            return redirect()->route('groups');
        }

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

            $begin_start = new DateTime($request->input('start_date'));
            $end = new DateTime($request->input('repeat_till'));
            $interval = DateInterval::createFromDateString($request->input('repeat_interval') . ' days');
            $period_start = new DatePeriod($begin_start, $interval, $end);


            $diff_start_date = new DateTime($request->input('start_date'));
            $diff_end_date = new DateTime($request->input('end_date'));
            $interval = date_diff($diff_start_date, $diff_end_date);

            $uuid = uniqid();
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


        return redirect()->route('events')
            ->with('success', 'Termin(e) wurden Erfolgreich hinzugefügt!');
    }

    public function edit($id)
    {

        $result = Events::find($id);
        if ($result->repeat_parent != NULL) {

        if(Events::following($result->repeat_parent)->order()->count() > 25) {
                $result_future = Events::following($result->repeat_parent)->order()->lazyById(25, $column = 'id');
            } else {
                $result_future = Events::following($result->repeat_parent)->order()->get();
            }
        } else {
            $result_future = [];
        }

        $proposal = Events::proposals()->get();
        $proposal_room = Events::proposal_room()->get();
        $groups = Groups::get();

        return view('events.edit', compact('result', 'result_future', 'proposal', 'proposal_room', 'groups'), ['title' => 'Termin Bearbeiten']);
    }


    public function update(Request $request, $id)
    {
        // $request->validated();

        if ($request->has('not_applicable')) {
            Events::find($id)->update([
                'not_applicable' => 1
            ]);
            if ($request->has('edit_repeat')) {
                if (is_array($request->input('followng_event'))) {
                    foreach ($request->input('followng_event') as $follow_update) {
                        Events::find($follow_update)->update([
                            'not_applicable' => 1
                        ]);
                    }
                } else {
                    Events::find($request->input('followng_event'))->update([
                        'not_applicable' => 1
                    ]);
                }
            }
        }

        if (!$request->has('not_applicable')) {

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

            $event = Events::find($id);

            $add_start_1 = new DateTime($request->input('start_date'));
            $add_start_2 = new DateTime($event->start);
            $interval = date_diff($add_start_2, $add_start_1);
            $start_diff = $interval->format($interval->d . ' days ' . $interval->h . ' hours ' . $interval->i . ' minutes');


            $add_end_1 = new DateTime($request->input('end_date'));
            $add_end_2 = new DateTime($event->end);
            $interval = date_diff($add_end_2, $add_end_1);
            $end_diff = $interval->format($interval->d . ' days ' . $interval->h . ' hours ' . $interval->i . ' minutes');

            Events::find($id)->update([
                'not_applicable' => NULL,
                'event' => $request->input('event'),
                'team' => $group,
                'start' => $request->input('start_date'),
                'end' => $request->input('end_date'),
                'room' => $request->input('room'),
            ]);
            if ($request->has('edit_repeat')) {
                if (is_array($request->input('followng_event'))) {
                    foreach ($request->input('followng_event') as $follow_update) {

                        $event = Events::find($follow_update);

                        Events::find($follow_update)->update([
                            'not_applicable' => NULL,
                            'event' => $request->input('event'),
                            'team' => $group,
                            'start' => date('Y-m-d H:i', strtotime($event->start . ' ' . $start_diff . '')),
                            'end' => date('Y-m-d H:i', strtotime($event->end . ' ' . $end_diff . '')),
                            'room' => $request->input('room'),
                        ]);
                    }
                } else {

                    $event = Events::find($follow_update);

                    Events::find($follow_update)->update([
                        'not_applicable' => NULL,
                        'event' => $request->input('event'),
                        'team' => $group,
                        'start' => date('Y-m-d H:i', strtotime($event->start . ' ' . $start_diff . '')),
                        'end' => date('Y-m-d H:i', strtotime($event->end . ' ' . $end_diff . '')),
                        'room' => $request->input('room'),
                    ]);
                }
            }
        }
        if ($request->has('not_applicable')) {
            return redirect()->route('events')
                ->with('warning', 'Termin(e) wurden als "Entfällt" gesetzt!');
        }

        if (!$request->has('not_applicable')) {
            return redirect()->route('events')
                ->with('success', 'Termine(e) wurden Erfolgreich geändert!');
        }
    }


    public function destroy(Request $request, $id)
    {

        Events::find($id)->delete();

        if ($request->has('delete_repeat')) {
            if (is_array($request->input('followng_event'))) {
                foreach ($request->input('followng_event') as $follow_update) {
                    Events::find($follow_update)->delete();
                }
            } else {
                Events::find($request->input('followng_event'))->delete();
            }
        }

        return redirect()->route('events')
            ->with('warning', 'Termin(e) wurden Entfernt!');
    }
}
