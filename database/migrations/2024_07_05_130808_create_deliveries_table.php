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
        // Schema::create('deliveries', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('address');
        //     $table->foreignId('user_id')->nullable();
        //     $table->enum('delivery_status', ['pending', 'in_transit', 'delivered', 'failed'])->default('pending');
        //     $table->timestamps();
        // });


        Schema::create('deliveries', function (Blueprint $table) {
            $table->id();
            $table->string('address');
            $table->foreignId('order_id')->nullable();
            $table->foreignId('user_id')->nullable();
            $table->enum('delivery_status', ['pending', 'in_transit', 'delivered', 'failed'])->default('pending');
            $table->date('order_date')->nullable();
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('deliveries');
    }
};
