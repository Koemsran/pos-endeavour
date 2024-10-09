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
            $table->integer('client_id');
            $table->string('education_level');
            $table->string('school');
            $table->string('language_test');
            $table->string('prefer_university');
            $table->string('major');
            $table->string('address');
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
        Schema::dropIfExists('office_consultations');
    }
};
