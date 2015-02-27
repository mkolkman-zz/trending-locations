<?php
namespace App\Providers;
use App\TrendingLocations\Locations\EloquentLocationGazetteer;
use App\TrendingLocations\Locations\LocationGazetteer;
use App\Twitter\Tweets\JsonTweetRepository;
use App\Twitter\Tweets\TweetRepository;
use Illuminate\Support\ServiceProvider;
class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(TweetRepository::class, JsonTweetRepository::class);
        $this->app->bind(LocationGazetteer::class, EloquentLocationGazetteer::class);
    }
}