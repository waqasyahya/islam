<?php

namespace App\Events;

use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UserVisited
{
    use Dispatchable, SerializesModels;

    public $ipAddress;
    public $visitedAt;
    public $country;
    public $city;
    public $region;
    public $latitude;
    public $longitude;

    /**
     * Create a new event instance.
     *
     * @param string $ipAddress
     * @param \Illuminate\Support\Carbon $visitedAt
     * @param string $country
     * @param string $city
     * @param string $region
     * @param string $latitude
     * @param string $longitude
     */
    public function __construct($ipAddress, $visitedAt, $country, $city, $region, $latitude, $longitude)
    {
        $this->ipAddress = $ipAddress;
        $this->visitedAt = $visitedAt;
        $this->country = $country;
        $this->city = $city;
        $this->region = $region;
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }
}
