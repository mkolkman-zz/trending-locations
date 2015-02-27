<?php
namespace App\Twitter\Tweets;


use App\IO\JsonObjectStream;
use App\Twitter\RawObjectTwitterMapper;

class GeotaggedTweetStream extends TweetStream {

    /**
     * @var JsonObjectStream
     */
    private $jsonObjectStream;

    public function __construct(JsonObjectStream $jsonObjectStream) {
        $this->jsonObjectStream = $jsonObjectStream;
    }

    public function hasNext() {
        return $this->jsonObjectStream->hasNext();
    }

    public function next() {
        $rawObject = $this->jsonObjectStream->next();
        return isset($rawObject->coordinates) ? RawObjectTwitterMapper::makeTweetFromRawObject($rawObject) : $this->next();
    }

}