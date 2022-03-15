<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Groups;
use App\Http\Requests\GroupRequest;

class GroupsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth']);
    }
    public function index()
    {

        $active = Groups::used()->get();

        $inactive = Groups::unused()->withTrashed()->get();

        return view('groups.index', compact('active', 'inactive'), ['title' => 'Gruppen']);
    }
    public function create()
    {

        $color = '#' . substr(str_shuffle("0123456789abcdef"), 6, 6);

        return view('groups.create', compact('color'), ['title' => 'Gruppe Hinzufügen']);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(GroupRequest $request)
    {

        $validated = $request->validated();


        if (Groups::alias($request->input(__('GruppenAlias')))->exists()) {
            return redirect()->route('groups.create')
                ->with('error', $request->input(__('GruppenAlias')) . ' Existiert bereits!');
        }
        Groups::create([
            'name' => $request->input(__('GruppenName')),
            'alias' => $request->input(__('GruppenAlias')),
            'color' => $request->input(__('GruppenFarbe')),
        ]);


        return redirect()->route('groups')
            ->with('success', $request->input(__('GruppenAlias')) . ' Erfolgreich hinzugefügt!');
    }

    public function show($alias)
    {
        $result = Groups::alias($alias)->withTrashed()->first();
        return view('groups.show', compact('result'), ['title' => 'Gruppe Anzeigen']);
    }

    public function edit($alias)
    {
        $result = Groups::alias($alias)->withTrashed()->first();
        return view('groups.edit', compact('result'), ['title' => 'Gruppe Bearbeiten']);
    }


    public function update(Request $request, $alias)
    {
        // $request->validated();

        Groups::alias($alias)->update([
            'name' => $request->input(__('GruppenName')),
            'color' => $request->input(__('GruppenFarbe')),
        ]);
        return redirect()->route('groups')
        ->with('success', $alias . ' Erfolgreich geändert!');
    }


    public function destroy(Request $request, $alias)
    {
        // $request->validated();
        $item = Groups::alias($alias)->first();
        if ($item->deleted_at == null) {
            Groups::alias($alias)->delete();
            $msg = 'deaktiviert';
        }

        if ($item->deleted_at != null) {
            Groups::alias($alias)->update([
                'deleted_at' =>  null
            ]);
            $msg = 'aktiviert';
        }

        return redirect()->route('groups')
            ->with('warning', $alias . ' wurde ' . $msg . '!');
    }
}
