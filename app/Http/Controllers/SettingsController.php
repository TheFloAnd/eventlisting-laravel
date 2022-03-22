<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Settings;

class SettingsController extends Controller
{

    public function __construct()
    {
        $this->middleware(['auth', 'isAdmin']);
        // Auth::user()->name == 'Admin'
    }

    public function index()
    {
        $settings = Settings::get();
        $name = Settings::setting('name');
        $preview_time = Settings::setting('future_day');
        $refresh_delay = Settings::setting('refresh');

        return view('settings.index', compact('settings', 'name', 'preview_time', 'refresh_delay'), ['title' => __('Einstellungen')]);
    }




    public function update(Request $request)
    {
        // $request->validated();

            Settings::setting('name')->update([
                'value' => $request->input('name'),
            ]);


            Settings::setting('future_day')->update([
                'value' => $request->input('preview_value'),
                'unit' => $request->input('preview_unit'),
            ]);
            Settings::setting('refresh')->update([
                'value' => $request->input('refresh_delay'),
            ]);

        return redirect()->route('settings');
        // ->with('success', $request->input('group_alias') . ' Erfolgreich hinzugefügt!');
    }
}
