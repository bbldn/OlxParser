<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->tinyInteger('id', true, true);
            $table->string('name', 15);
            $table->string('shortcut', 15);
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('cities');
    }
}
