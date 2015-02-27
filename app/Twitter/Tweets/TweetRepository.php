<?php
namespace App\Twitter\Tweets;

interface TweetRepository {

    public function findAvailableDates();

    public function findAvailableDatetimes();

    public function findAvailableDatetimesBetween($startDatetime, $endDatetime);

    /**
     * @return TweetStream
     */
    public function findAll();
}