<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('schedule_matches', function (Blueprint $table) {
            $table->id();
            $table->string('team1_name');
            $table->string('team1_logo');
            $table->string('team2_name');
            $table->string('team2_logo');
            $table->date('date_match')->nullable();  
            $table->time('start_time')->nullable();   
            $table->time('end_time')->nullable(); 
            $table->string('location');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('schedule_matches');
    }
};
