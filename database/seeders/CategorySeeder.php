<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::firstOrCreate([
            'name' => 'concert',
        ]);
        Category::firstOrCreate([
            'name' => 'theater',
        ]);
        Category::firstOrCreate([
            'name' => 'sports',
        ]);
        Category::firstOrCreate([
            'name' => 'conference',
        ]);
    }
}
