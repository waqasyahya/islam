<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Events\UserVisited;
use Stevebauman\Location\Facades\Location;

class TrackVisitorMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Get the user's IP address
        // $ipAddress = $request->ip();
        $ipAddress = '172.168.1.1'; 
        // Check if this IP has already been logged in this session
        if (!session()->has('visit_recorded_' . $ipAddress)) {
            $visitedAt = now();

            // Fetch location details using the IP address
            $location = Location::get($ipAddress);

            // Extract location details
            $country = $location->countryName ?? 'Unknown';
            $city = $location->cityName ?? 'Unknown';
            $region = $location->regionName ?? 'Unknown';
            $latitude = $location->latitude ?? 'Unknown';
            $longitude = $location->longitude ?? 'Unknown';

            // Fire an event and pass the data
            event(new UserVisited($ipAddress, $visitedAt, $country, $city, $region, $latitude, $longitude));

            // Mark this IP as recorded in the session
            session(['visit_recorded_' . $ipAddress => true]);
        }

        return $next($request);
    }
}
