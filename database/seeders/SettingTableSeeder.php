<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $settings = [

        ];

        foreach ($settings as $name => $value) {
            Setting::create(compact('name', 'value'));
        }
    }
}
