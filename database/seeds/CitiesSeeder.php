<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CitiesSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        DB::table('cities')->insert([
            ['name' => 'Донецк', 'shortcut' => 'donetsk'],
        ]);
    }
}
