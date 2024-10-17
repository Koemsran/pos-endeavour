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
        Schema::create('office_consultations', function (Blueprint $table) {
            $table->id();
            $table->integer('progress_id');
            $table->string('name');
            $table->integer('age');
            $table->string('phone_number');
            $table->string('education_level')->nullable();
            $table->string('school')->nullable();
            $table->string('language_test')->nullable();
            $table->string('prefer_university')->nullable();
            $table->string('major')->nullable();
            $table->string('address')->nullable();
            $table->string('program_looking')->nullable();
            $table->string('prefer_country')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('office_consultations');
    }
};
