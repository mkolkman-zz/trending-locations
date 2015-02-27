<?php
namespace App\Twitter;

use App\Twitter\Geo\Coordinate;
use App\Twitter\Geo\Point;
use App\Twitter\Tweets\Tweet;
use App\Twitter\Users\User;

class RawObjectTwitterMapper {

    /**
     * @param $rawTweetObject
     * @return Tweet
     */
    public static function makeTweetFromRawObject($rawTweetObject)
    {
        $tweet = new Tweet();

        if (isset($rawTweetObject->created_at))
            $tweet->created_at = $rawTweetObject->created_at;
        if (isset($rawTweetObject->id))
            $tweet->id = $rawTweetObject->id;
        if (isset($rawTweetObject->text))
            $tweet->text = $rawTweetObject->text;
        if (isset($rawTweetObject->source))
            $tweet->source = $rawTweetObject->source;
        if (isset($rawTweetObject->user))
            $tweet->user = self::makeUserFromRawObject($rawTweetObject->user);
        if (isset($rawTweetObject->coordinates))
            $tweet->coordinates = self::makePointFromRawObject($rawTweetObject->coordinates);

        return $tweet;
    }

    /**
     * @param $rawUserObject
     * @return User
     */
    public static function makeUserFromRawObject($rawUserObject)
    {
        $user = new User();

        if (isset($rawUserObject->id))
            $user->id = $rawUserObject->id;
        if (isset($rawUserObject->name))
            $user->name = $rawUserObject->name;
        if (isset($rawUserObject->screen_name))
            $user->screen_name = $rawUserObject->screen_name;
        if (isset($rawUserObject->location))
            $user->location = $rawUserObject->location;
        if (isset($rawUserObject->url))
            $user->url = $rawUserObject->url;
        if (isset($rawUserObject->description))
            $user->description = $rawUserObject->description;

        return $user;
    }

    /**
     * @param $rawCoordinatesObject
     * @return Point
     */
    public static function makePointFromRawObject($rawCoordinatesObject)
    {
        if (isset($rawCoordinatesObject->coordinates)) {
            //coordinates is in geojson format, which is in reversed order
            $longitude = $rawCoordinatesObject->coordinates[0];
            $latitude = $rawCoordinatesObject->coordinates[1];
            return new Point(new Coordinate($latitude, $longitude));
        }
        return new Point();
    }

}