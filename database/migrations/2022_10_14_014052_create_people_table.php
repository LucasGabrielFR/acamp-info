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
        Schema::create('people', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('contact')->nullable(true);
            $table->string('street')->nullable(true);
            $table->string('city')->nullable(true);
            $table->string('state')->nullable(true);
            $table->string('district')->nullable(true);
            $table->string('complement')->nullable(true);
            $table->string('number')->nullable(true);
            $table->date('date_birthday');
            $table->string('email')->unique()->nullable(true);
            $table->string('religion')->nullable(true);
            $table->string('parish')->nullable(true);
            $table->boolean('is_baptized')->nullable(true);
            $table->boolean('is_confirmed')->nullable(true);
            $table->boolean('is_eucharist')->nullable(true);
            $table->boolean('is_married')->nullable(true);
            $table->boolean('is_pastoral')->nullable(true);
            $table->string('pastoral')->nullable(true);
            $table->string('medical_attention')->nullable(true);
            $table->text('reasons')->nullable(true);
            $table->boolean('is_spouse_camper')->nullable(true);
            $table->string('spouse_name')->nullable(true);
            $table->string('image')->nullable(true);
            $table->string('cpf')->unique()->nullable(true);
            $table->string('marital_status')->nullable(true);
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
        Schema::dropIfExists('people');
    }
};
