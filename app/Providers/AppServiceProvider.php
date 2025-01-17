<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Eventday;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    public function boot()
    {
        // Bind event data to all views
        View::composer('*', function ($view) {
            $currentDateTime = now();
            $events = Eventday::where('start_time', '<=', $currentDateTime)
                           ->where('end_time', '>=', $currentDateTime)
                           ->get();
            $view->with('events', $events);
        });
    }
}
