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
        Schema::create('phone_consultations', function (Blueprint $table) {
            $table->id();
            $table->integer('progress_id');
            $table->string('name');
            $table->integer('age');
            $table->string('phone_number');
            $table->string('source');
            $table->string('ielts')->nullable();
            $table->string('hsk')->nullable();
            $table->string('grade');
            $table->string('major');
            $table->string('university1');
            $table->string('university2');
            $table->string('program_looking');
            $table->string('prefer_country');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('phone_consultations');
    }
};
