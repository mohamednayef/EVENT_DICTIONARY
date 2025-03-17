<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Event;
use App\Models\Ticket;
use App\Models\Bookmark;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->count(39)->create();
        Event::factory()->count(39)->create();
        Ticket::factory()->count(39)->create();
        Bookmark::factory()->count(39)->create();
    }
}
