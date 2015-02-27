<?php
namespace App\Twitter\Tweets;


use App\IO\JsonObjectStream;
use App\Twitter\RawObjectTwitterMapper;
use Symfony\Component\Yaml\Exception\ParseException;

class TweetStream {

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
        try{
            return RawObjectTwitterMapper::makeTweetFromRawObject($this->jsonObjectStream->next());
        }catch(ParseException $e) {
            return $this->next();
        }
    }

}