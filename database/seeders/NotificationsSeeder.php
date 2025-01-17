<?php

namespace Database\Seeders;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class NotificationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            ['prayer_name' => 'Fajr', 'notify_time' => '05:00:00', 'is_sent' => false],
            ['prayer_name' => 'Zuhr', 'notify_time' => '13:00:00', 'is_sent' => false],
            ['prayer_name' => 'Asr', 'notify_time' => '16:00:00', 'is_sent' => false],
            ['prayer_name' => 'Maghrib', 'notify_time' => '18:00:00', 'is_sent' => false],
            ['prayer_name' => 'Isha', 'notify_time' => '20:00:00', 'is_sent' => false],
        ]);
    }
}
