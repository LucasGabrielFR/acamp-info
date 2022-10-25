<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servants', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('camp_id')->nullable(false);
            $table->uuid('person_id')->nullable(false);
            $table->text('group')->nullable(true);
            $table->text('shirt_size')->nullable(true);
            $table->text('sector')->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('servants');
    }
};
