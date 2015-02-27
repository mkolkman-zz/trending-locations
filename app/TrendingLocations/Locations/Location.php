<?php
namespace App\TrendingLocations\Locations;

use Illuminate\Database\Eloquent\Model;

class Location extends Model {

    public function alternateNames() {
        return $this->hasMany('App\TrendingLocations\Locations\AlternateName', 'geoname_id', 'geoname_id');
    }

}