<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SampleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // populate tables
        \App\Models\User::factory()->count(65)->create();
        \App\Models\Admin::factory()->count(3)->create();
    }
}
