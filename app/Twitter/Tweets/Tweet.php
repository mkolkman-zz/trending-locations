<?php
namespace App\Twitter\Tweets;

use App\Twitter\Geo\Point;
use App\Twitter\Users\User;
use Illuminate\Database\Eloquent\Model;

class Tweet extends Model{

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'tweets';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [];

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $created_at;

    /**
     * @var string
     */
    public $text;

    /**
     * @var string
     */
    public $source;

    /**
     * @var User
     */
    public $user;

    /**
     * @var Point
     */
    public $coordinates;

}