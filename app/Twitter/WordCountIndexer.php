<?php
namespace App\Twitter;

use App\TrendingLocations\Language\StopWords;
use App\TrendingLocations\Locations\LocationGazetteer;
use App\Twitter\Tweets\Tweet;
use App\Twitter\Tweets\TweetStream;

class WordCountIndexer {

    private $tokenizer;
    private $wordCountIndex;
    private $geonamesIndex;
    private $tweetCount = 0;

    private $stopWords;
    private $gazetteer;

    public function __construct(TweetTokenizer $tokenizer, StopWords $stopWords, LocationGazetteer $gazetteer) {
        $this->tokenizer = $tokenizer;
        $this->stopWords = $stopWords;
        $this->gazetteer = $gazetteer;
    }

    public function getIndexSize()
    {
        return count($this->wordCountIndex);
    }

    public function getIndex() {
        return $this->wordCountIndex;
    }

    public function getIndexTop($amount = 10) {
        return array_splice($this->wordCountIndex, 0, $amount);
    }

    /**
     * @return mixed
     */
    public function getGeonamesIndex($amount = 10)
    {
        print("Building wordcount sorted geonames index... ");
        $start = microtime(true);
        $i = 0;
        foreach($this->wordCountIndex as $name => $count) {
            if($this->gazetteer->isLocation($name)) {
                if($i > $amount)
                    break;
                $this->geonamesIndex[$name] = $this->gazetteer->findGeonameIds($name);
                $i++;
            }
        }
        print("Done in " . (microtime(true) - $start) . " seconds!".PHP_EOL);
        return $this->geonamesIndex;
    }

    public function getTweetCount()
    {
        return $this->tweetCount;
    }

    public function buildIndex(TweetStream $tweetStream) {
        print("Building wordcount index... ");
        $start = microtime(true);
        $this->wordCountIndex = array();
        while($tweetStream->hasNext()){
            $this->indexNextTweet($tweetStream);
        }
        arsort($this->wordCountIndex);
        print("Done in " . (microtime(true) - $start) . " seconds!".PHP_EOL);
    }

    /**
     * @param TweetStream $tweetStream
     */
    private function indexNextTweet(TweetStream $tweetStream)
    {
        /* @var $tweet Tweet */
        $tweet = $tweetStream->next();
        $tokens = $this->tokenizer->tokenize($tweet->text);
        foreach ($tokens as $token) {
            $token = strtolower($token);
            if ($this->isAllowedWord($token)) {
                $this->initIndexEntryIfNeeded($token);
                $this->wordCountIndex[$token]++;
            }
        }
        $this->tweetCount++;
    }

    /**
     * @param $token
     * @return bool
     */
    private function isAllowedWord($token)
    {
        return !$this->stopWords->isStopWord($token);
    }

    /**
     * @param $token
     */
    private function initIndexEntryIfNeeded($token)
    {
        if (!array_key_exists($token, $this->wordCountIndex))
            $this->wordCountIndex[$token] = 0;
    }

}