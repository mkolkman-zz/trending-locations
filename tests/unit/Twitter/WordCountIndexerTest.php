<?php
namespace tests\unit\Twitter;

use App\Twitter\Tweets\JsonTweetRepository;
use App\Twitter\WordCountIndexer;

class WordCountIndexerTest extends \TestCase {

    public function testIndexBuildsWithoutErrors() {
        //Given
        $start = microtime(true);
        /* @var JsonTweetRepository $repository*/
        $repository = app(JsonTweetRepository::class);
        /* @var WordCountIndexer $indexer*/
        $indexer = app(WordCountIndexer::class);

        //When
        $tweetStream = $repository->findAll();
        $indexer->buildIndex($tweetStream);
        $time = microtime(true) - $start;

        //Then
        print("Tweet count: " . $indexer->getTweetCount().PHP_EOL);
        print("Took: " . $time . " seconds".PHP_EOL);
        print("Tweets per second: " . ((float) $indexer->getTweetCount() / $time) . PHP_EOL);
        print("Index size: " . $indexer->getIndexSize().PHP_EOL);
        print("Top 100 index".PHP_EOL);
        print("-------------".PHP_EOL);
        var_dump($indexer->getGeonamesIndex());
    }

}