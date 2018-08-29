<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * @return void
     */
    public function run(): void
    {
         $this->call(CitiesSeeder::class);
         $this->call(DistrictsSeeder::class);
    }
}
