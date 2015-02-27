<?php
namespace App\TrendingLocations\Locations;

use Illuminate\Database\Eloquent\Model;

class AlternateName extends Model {

    public function location() {
        $this->belongsTo('App\TrendingLocations\Locations\Location', 'geoname_id', 'geoname_id');
    }

}