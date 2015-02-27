<?php
namespace App\TrendingLocations\Mentions;

use App\TrendingLocations\Geo\Coordinate;
use Illuminate\Database\Eloquent\Model;

class Mention extends Model {

    public function __construct(Coordinate $source = null, Coordinate $subject = null) {
        $this->source = $source;
        $this->subject = $subject;
    }

    public function source() {
        if(!isset($this->source)){
            $this->source = new Coordinate($this->source_latitude, $this->source_longitude);
        }
        return $this->source;
    }

    public function subject() {
        if(!isset($this->subject)){
            $this->subject = new Coordinate($this->subject_latitude, $this->subject_longitude);
        }
        return $this->subject;
    }

}