<?php
namespace App\TrendingLocations\Geonames;

use App\TrendingLocations\Locations\LocationGazetteer;
use Symfony\Component\Yaml\Exception\ParseException;
use ZipArchive;

class GeonamesImporter {

    const SOURCE_FILE = "D:/Users/s0201154/gazetteers/Geonames/allCountries.zip";

    /**
     * @var $zip ZipArchive
     */
    private $zip;
    private $fileStream;

    public function __construct(LocationGazetteer $gazetteer){
        $this->gazetteer = $gazetteer;
    }

    /**
     * NOTE: this is fairly slow when the EloquentLocationGazetteer is used, as each location is separately loaded/saved.
     */
    public function loadLocations()
    {
        $this->gazetteer->truncate();
        print("Loading geonames gazetteer... ");
        $start = microtime(true);
        $this->open();
        while ($this->hasNextLocation()) {
            $this->loadNextLocation();
        }
        $this->close();
        print("Done in " . (microtime(true) - $start) . " seconds!".PHP_EOL);
    }

    /**
     * @return array
     */
    private function open()
    {
        $this->zip = new ZipArchive();
        $this->zip->open(self::SOURCE_FILE);
        $this->fileStream = $this->zip->getStream('allCountries.txt');
    }

    /**
     * @return bool
     */
    private function hasNextLocation()
    {
        return !feof($this->fileStream);
    }

    private function loadNextLocation()
    {
        /** @var Location $location */
        try {
            $cols = fgetcsv($this->fileStream, 0, "\t");
            if(count($cols) < 19) {
                throw new ParseException("Incorrect column count: " . implode(",", $cols));
            }
            $this->gazetteer->createLocation($cols[0], $cols[1], $cols[2], $cols[3], $cols[4], $cols[5], $cols[6], $cols[7], $cols[8], $cols[9], $cols[10], $cols[11], $cols[12], $cols[13], $cols[14], $cols[15], $cols[16], $cols[17], $cols[18]);
        } catch (ParseException $e) {
            //ignore
        }
    }

    private function close()
    {
        fclose($this->fileStream);
        $this->zip->close();
    }

}