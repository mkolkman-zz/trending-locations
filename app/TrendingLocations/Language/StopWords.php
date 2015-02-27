<?php
namespace App\TrendingLocations\Language;

class StopWords {

    const FILE = "D:/Users/s0201154/misc/stopwords.english";
    private $list = array();

    public function __construct() {
        print("Loading stopwords... ");
        $start = microtime(true);
        $this->list = array_flip(explode("\n", file_get_contents(self::FILE)));
        print("Done in " . (microtime(true) - $start) . " seconds!".PHP_EOL);

    }

    public function isStopWord($word) {
        return array_key_exists($word, $this->list);
    }
}