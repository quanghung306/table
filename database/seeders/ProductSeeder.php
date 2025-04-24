<?php

namespace Database\Seeders;
use App\Models\Prodcuts;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Prodcuts::factory()->count(10)->create();
    }
}
