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
            $table->string('status');
            $table->string('name');
            $table->integer('age');
            $table->string('phone_number');
            $table->string('source');
            $table->decimal('ielts')->nullable();
            $table->decimal('hsk')->nullable();
            $table->string('grade');
            $table->string('major');
            $table->string('prefer_school');
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
