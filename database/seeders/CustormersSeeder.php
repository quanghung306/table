<?php

namespace Database\Seeders;

use App\Models\Custormer;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustormersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Custormer::factory()->count(10)->create();
    }
}
