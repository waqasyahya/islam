<?php

namespace App\Listeners;

use App\Events\UserVisited;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\DB;

class StoreVisitor
{
    public function __construct()
    {
        //
    }

    public function handle(UserVisited $event)
    {
        DB::table('visitors')->insert([
            'ip_address' => $event->ipAddress,
            'visited_at' => $event->visitedAt,
            'country' => $event->country,
            'city' => $event->city,
            'region' => $event->region,
            'latitude' => $event->latitude,
            'longitude' => $event->longitude,
        ]);
    }
}
