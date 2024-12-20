<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\TrafficLog;
use Stevebauman\Location\Facades\Location;

class LogTraffic
{
    public function handle(Request $request, Closure $next)
    {
        // // Get the user's IP address
        // $ip = $request->ip();
        // // Get the user's location based on the IP address
        // $location = Location::get($ip);
        // // Log the request details to the database
        // TrafficLog::updateOrCreate(
        //     ['ip' => $request->ip()],
        //     [
        //         'url' => $request->url(),
        //         'method' => $request->method(),
        //         'user_agent' => $request->header('User-Agent'),
        //         'country' => $location ? $location->countryName : null,
        //         'region' => $location ? $location->regionName : null,
        //         'city' => $location ? $location->cityName : null,
        //         'latitude' => $location ? $location->latitude : null,
        //         'longitude' => $location ? $location->longitude : null,
        //     ]
        // );
        return $next($request);
    }
}
