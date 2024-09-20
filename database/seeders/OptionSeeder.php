<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $options = ["Live", "Take Photo", "Water"];
        foreach ($options as $option) {
            DB::table('options')->insert([
                'name' => $option,
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
      
    }
}
