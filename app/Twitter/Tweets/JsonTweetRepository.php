<?php
namespace App\Twitter\Tweets;

use App\IO\DirectoryFilesStream;
use App\IO\FileLineStream;
use App\IO\JsonObjectStream;

class JsonTweetRepository implements TweetRepository {

    const DIRECTORY = "D:/Users/s0201154/corpora/twitter/test/";
    const FILE_PREFIX = "20130601-20140601_qdwzacq4b1_";
    const FILE_SUFFIX = "_activities";
    const FILE_EXTENSION = ".json.gz";
    const GZIP_EXTENSION = ".gz";
    const JSON_EXTENSION = ".json";

    public function findAvailableDates() {
        $dateTimes = $this->findAvailableDatetimes();
        $dates = array();
        foreach($dateTimes as $dateTime) {
            $dates[] = substr($dateTime, 0, -6);
        }
        return array_unique($dates);
    }

    public function findAvailableDatetimes()
    {
        $dateTimes = array();
        $files = scandir(self::DIRECTORY);
        foreach($files as $filename){
            if($this->hasCorrectFileExtension($filename))
                $dateTimes[] = $this->getWellFormattedDatetimeFromFilename($filename);
        }
        return $dateTimes;
    }

    private function hasCorrectFileExtension($filename)
    {
        return ends_with($filename, self::FILE_EXTENSION);
    }

    /**
     * @param $filename
     * @return string
     */
    private function getWellFormattedDatetimeFromFilename($filename)
    {
        $strippedFilename = str_replace(self::FILE_PREFIX, "", $filename);
        $strippedFilename = str_replace(self::FILE_SUFFIX, "", $strippedFilename);
        $strippedFilename = str_replace(self::FILE_EXTENSION, "", $strippedFilename);

        return str_replace_array("_", array("-", "-", " ", ":"), $strippedFilename);
    }

    /**
     * @param $startDatetime
     * @param $endDatetime
     * @return array
     */
    public function findAvailableDatetimesBetween($startDatetime, $endDatetime)
    {
        $availableDatetimes = $this->findAvailableDatetimes();
        $dateTimes = array();
        foreach ($availableDatetimes as $availableDatetime) {
            if ($this->datetimeIsBetween($availableDatetime, $startDatetime, $endDatetime)) {
                $dateTimes[] = $availableDatetime;
            }
        }
        return $dateTimes;
    }

    /**
     * @param $datetime
     * @param $startDatetime
     * @param $endDatetime
     * @return bool
     */
    private function datetimeIsBetween($datetime, $startDatetime, $endDatetime)
    {
        $result = strtotime($datetime) >= strtotime($startDatetime) && strtotime($datetime) <= strtotime($endDatetime);
        return $result;
    }

    public function findAll() {
        return new TweetStream(new JsonObjectStream(new FileLineStream(new DirectoryFilesStream(self::DIRECTORY))));
    }

}