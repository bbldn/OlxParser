<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFlatsTable extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('flats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('flat_id', 8);
            $table->string('description_hash', 32)->nullable();
            $table->tinyInteger('number_of_storeys', false, true)->nullable();
            $table->tinyInteger('level', false, true)->nullable();
            $table->tinyInteger('area', false, true)->nullable();
            $table->tinyInteger('number_of_rooms', false, true)->nullable();
            $table->integer('price', false, true)->nullable();
            $table->tinyInteger('district_id', false, true)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('flats');
    }
}
