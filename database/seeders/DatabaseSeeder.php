<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Eventday;
use Carbon\Carbon;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        Eventday::create([
            'name' => 'Test Event',
            'message' => 'This is a test event to check the event display functionality.',
            'start_time' => Carbon::now()->subMinutes(5), // Start 5 minutes ago
            'end_time' => Carbon::now()->addMinutes(10),  // End 10 minutes later
        ]);
    }
}
