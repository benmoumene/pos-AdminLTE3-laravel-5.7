<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;

class GeneralSettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        App\GeneralSetting::create([
            'store_name' => 'TouwfiQ',
            'start_day' => Carbon::parse('2019-06-17'),
            'image' => 'logo_default.png',
            'investment_capital' => '1000000',
            'rc' => '1000000',
            'article' => '1000000',
            'nif' => '1000000',
            'nis' => '1000000'
        ]);
    }
}