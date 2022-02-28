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
    public function store(Request $request)
    {
        // $validated = $request->validated();
        if(Groups::alias($request->input('group_alias'))->exists()){
            return redirect()->route('groups.create')
                ->with('error', $request->input('group_alias') . ' Existiert bereits!');
        }
        Groups::create([
            'name' => $request->input('group_name'),
            'alias' => $request->input('group_alias'),
            'color' => $request->input('group_color'),
        ]);


        return redirect()->route('groups.index');
            // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }

    public function show($alias)
    {
        $result = Groups::alias($alias)->first();
        return view('groups.edit', compact('result'), ['title' => 'Gruppe Anzeigen']);
    }

    public function edit($alias)
    {
        $result = Groups::alias($alias)->first();
        return view('groups.edit', compact('result'), ['title' => 'Gruppe Bearbeiten']);
    }


    public function update(Request $request, $alias)
    {
        // $request->validated();

        $id = Groups::alias($alias)->first();
        $update = Groups::find($id)->alias($alias)->update([
            'name' => $request->input('group_name'),
            'color' => $request->input('group_color'),
            'updated_at' =>  strftime('%c')
        ]);
        var_dump($update);
        // return redirect()->route('groups.index', $alias);
            // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }


    public function destroy(Request $request, $alias)
    {
        // $request->validated();

        $id = Groups::alias($alias)->first();
        if($id->deleted_at == NULL){
            Groups::find($id->id)
                ->alias($alias)
                ->update([
                    'updated_at' =>  strftime('%c'),
                    'deleted_at' =>  strftime('%c')
                ]);
        }

        if($id->deleted_at != NULL){
            Groups::find($id->id)
                ->alias($alias)
                ->update([
                    'updated_at' =>  strftime('%c'),
                    'deleted_at' =>  NULL
                ]);
        }
        // var_dump($update);
        // return redirect()->route('groups.index', $alias);
            // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }
}
