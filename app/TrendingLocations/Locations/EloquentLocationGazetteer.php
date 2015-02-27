<?php
namespace App\TrendingLocations\Locations;

class EloquentLocationGazetteer implements LocationGazetteer {

    /**
     * @var Location
     */
    private $model;

    public function createLocation($geonameId, $name, $asciiName, $alternateNames, $latitude, $longitude, $featureClass, $featureCode, $countryCode, $cc2, $admin1Code, $admin2Code, $admin3Code, $admin4Code, $population, $elevation, $dem, $timezone, $modificationDate)
    {
        $this->model = new Location();
        $this->model->geoname_id = $geonameId;
        $this->model->name = $name;
        $this->model->ascii_name = $name;
        $this->model->alternate_names = $alternateNames;
        $this->model->latitude = $latitude;
        $this->model->longitude = $longitude;
        $this->model->feature_class = $featureClass;
        $this->model->feature_code = $featureCode;
        $this->model->country_code = $countryCode;
        $this->model->cc2 = $cc2;
        $this->model->admin1_code = $admin1Code;
        $this->model->admin2_code = $admin2Code;
        $this->model->admin3_code = $admin3Code;
        $this->model->admin4_code = $admin4Code;
        $this->model->population = $population;
        $this->model->elevation = $elevation;
        $this->model->dem = $dem;
        $this->model->timezone = $timezone;
        $this->model->modification_date = $modificationDate;

        $this->model->save();

        return $this->model;
    }

    public function findAll()
    {
        return Location::all();
    }

    public function isLocation($name)
    {
        return Location::whereHas('alternateNames', function($query) use ($name) {
            $query->where('alternate_name', $name);
        })->count() > 0;
    }

    public function findLocations($name)
    {
        return Location::whereHas('alternateNames', function($query) use ($name) {
            $query->where('alternate_name', $name);
        })->get();
    }

    public function findGeonameIds($name)
    {
        $locations = $this->findLocations($name);
        $geonameIds = array();
        foreach($locations as $location) {
            $geonameIds[] = $location->geoname_id;
        }
        return $geonameIds;
    }

    public function truncate()
    {
        Location::truncate();
    }
}