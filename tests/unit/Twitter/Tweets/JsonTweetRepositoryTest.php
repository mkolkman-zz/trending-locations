<?php
namespace tests\unit\Twitter\Tweets;

use App\Twitter\Tweets\JsonTweetRepository;

class JsonTweetRepositoryTest /*extends \TestCase*/{

    public function testFindAvailableDatetimesReturnsCorrectFormattedDates() {
        //Given
        /* @var JsonTweetRepository $repository*/
        $repository = app(JsonTweetRepository::class);

        //When
        $dateTimes = $repository->findAvailableDatetimes();

        //Then
        $this->assertTrue((bool)strtotime($dateTimes[0]));
    }

    public function testFindAvailableDatesReturnsNoDuplicates() {
        //Given
        /* @var JsonTweetRepository $repository*/
        $repository = app(JsonTweetRepository::class);

        //When
        $dates = $repository->findAvailableDates();

        //Then
        $this->assertNotEmpty($dates);
        $this->assertEquals(count($dates), count(array_unique($dates)));
    }

    public function testFindAvailablesFilesBetweenGivesCorrectFiles() {
        //Given
        /* @var JsonTweetRepository $repository*/
        $repository = app(JsonTweetRepository::class);

        //When
        $files = $repository->findAvailableFilesBetween("2013-08-13 15:00", "2013-08-13 19:00");

        //Then
        $this->assertEquals(25, count($files));
    }

    public function testFindAllBetweenGivesTweets() {
        //Given
        /* @var JsonTweetRepository $repository*/
        $repository = app(JsonTweetRepository::class);

        //When
        $tweets = $repository->findAllBetweenDatetimes("2013-08-13 15:00", "2013-08-13 16:00");

        //Then
        $this->assertNotEmpty($tweets);
    }

    public function testFindAllBetweenGivesCorrectAmountOfTweets() {
        //Given
        /* @var JsonTweetRepository $repository*/
        $repository = app(JsonTweetRepository::class);

        //When
        $tweets = $repository->findAllBetweenDatetimes("2013-08-13 15:00", "2013-08-13 16:00");

        //Then
        $this->assertEquals(12660, count($tweets));
    }

    public function testFindAllGeotaggedBetweenGivesCorrectAmountOfTweets() {
        //Given
        /* @var JsonTweetRepository $repository*/
        $repository = app(JsonTweetRepository::class);

        //When
        $tweets = $repository->findAllGeoTaggedBetweenDatetimes("2013-08-13 00:00", "2013-08-14 00:00");

        //Then
        $this->assertEquals(1546, count($tweets));
    }

}