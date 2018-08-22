<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDistrictsTable extends Migration
{
    /**
     * @return void
     */
    public function up(): void
    {
        Schema::create('districts', function (Blueprint $table) {
            $table->tinyInteger('id', true, true);
            $table->string('name', 15);
            $table->tinyInteger('city_id', false, true)->nullable();
        });
    }

    /**
     * @return void
     */
    public function down(): void
    {
        Schema::dropIfExists('districts');
    }
}
