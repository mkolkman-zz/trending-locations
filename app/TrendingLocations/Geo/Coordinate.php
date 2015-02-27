<?php
namespace App\TrendingLocations\Geo;


class Coordinate {

    /**
     * @var double
     */
    public $latitude;

    /**
     * @var double
     */
    public $longitude;

    public function __construct($latitude, $longitude) {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
    }

    public function toString() {
        return $this->latitude . ", " . $this->longitude;
    }

}