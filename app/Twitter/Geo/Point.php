<?php
namespace App\Twitter\Geo;

use App\TrendingLocations\Geo\Coordinate;

class Point {

    /**
     * @var Coordinate
     */
    public $coordinate;

    public function __construct(Coordinate $coordinate = null) {
        $this->coordinate = $coordinate;
    }
}