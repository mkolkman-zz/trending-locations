<?php
namespace App\TrendingLocations\Locations;

interface LocationGazetteer {

    public function createLocation($geonameId, $name, $asciiName, $alternateNames, $latitude, $longitude, $featureClass, $featureCode, $countryCode, $cc2, $admin1Code, $admin2Code, $admin3Code, $admin4Code, $population, $elevation, $dem, $timezone, $modificationDate);

    public function findAll();

    public function isLocation($name);

    public function findLocations($name);

    public function findGeonameIds($name);

    public function truncate();

}