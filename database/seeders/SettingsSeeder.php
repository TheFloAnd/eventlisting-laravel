<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = array([
            'view_name' => 'Automatisches Neuladen',
            'setting' => 'refresh',
            'value' => '15',
            'value_unit' => 'seconds',
            'created_at' => date("Y-m-d h:i:s")        ],
        [
            'view_name' => 'Termin Preview Zeitraum',
            'setting' => 'future_day',
            'value' => '2',
            'value_unit' => 'week',
            'created_at' => date("Y-m-d h:i:s")        ],
        [
            'view_name' => 'Überschrift',
            'setting' => 'name',
            'value' => 'Unset',
            'created_at' => date("Y-m-d h:i:s")        ]);

        foreach ($settings as $setting){
            DB::table('settings')->insert($setting);
        }

    }
}
