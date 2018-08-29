<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DistrictsSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
        DB::table('districts')->insert([
            ['name' => 'Будённовский', 'city_id' => 1],
            ['name' => 'Ворошиловский', 'city_id' => 1],
            ['name' => 'Калининский', 'city_id' => 1],
            ['name' => 'Киевский', 'city_id' => 1],
            ['name' => 'Кировский', 'city_id' => 1],
            ['name' => 'Куйбышевский', 'city_id' => 1],
            ['name' => 'Ленинский', 'city_id' => 1],
            ['name' => 'Петровский', 'city_id' => 1],
            ['name' => 'Пролетарский', 'city_id' => 1],
        ]);
    }
}
