<?php namespace App\Http\Controllers;

use App\TrendingLocations\Geo\Coordinate;
use App\TrendingLocations\Mentions\Mention;

class MapsController extends Controller {

	/*
	|--------------------------------------------------------------------------
	| Home Controller
	|--------------------------------------------------------------------------
	|
	| This controller renders your application's "dashboard" for users that
	| are authenticated. Of course, you are free to change or remove the
	| controller as you wish. It is just here to get your app started!
	|
	*/

    /**
     * Create a new controller instance.
     *
     */
	public function __construct()
	{
		$this->middleware('guest');
	}

	/**
	 * Show the application dashboard to the user.
	 *
	 * @return Response
	 */
	public function index()
	{
        $mentions = [
            new Mention(new Coordinate(50.083, 14.417), new Coordinate(52.375, 4.899)),
            new Mention(new Coordinate(54.083, 10.417), new Coordinate(52.375, 4.899)),
            new Mention(new Coordinate(46.083, 18.417), new Coordinate(52.375, 4.899)),
            new Mention(new Coordinate(42.083, 2.417), new Coordinate(52.375, 4.899)),
        ];
		return view('map', compact('mentions'));
	}

}
