<?php
namespace App\Twitter;

class TweetTokenizer {

    public function tokenize($text) {
        $filtered = preg_replace("/[^A-Za-z0-9 ]/", '', $text);
        return preg_split('/\s+/', $filtered);
    }

}