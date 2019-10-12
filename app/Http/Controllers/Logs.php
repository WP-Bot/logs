<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Message;

class Logs extends Controller
{
	// The Time Machine by H.G. Wells quotes off https://www.goodreads.com/work/quotes/3234863-the-time-machine
	public $time_quotes = [
		'It sounds plausible enough tonight, but wait until tomorrow. Wait for the common sense of the morning.',
		'We should strive to welcome change and challenges, because they are what help us grow. With out them we grow weak like the Eloi in comfort and security. We need to constantly be challenging ourselves in order to strengthen our character and increase our intelligence.',
		'Looking at these stars suddenly dwarfed my own troubles and all the gravities of terrestrial life.',
		'Very simple was my explanation, and plausible enough---as most wrong theories are!',
		'Face this world. Learn its ways, watch it, be careful of too hasty guesses at its meaning. In the end you will find clues to it all.'
	];

    function today() {
		$logs = Message::whereDate( 'time', '=', date( "Y-m-d" ) )->orderBy( 'time', 'desc' )->get();
		$log_date = date( "Y-m-d" );

        return view( 'logs.table', [ 'logs' => $logs, 'log_date' => $log_date ] );
	}

	function givenDay( $date ) {
		$date = new \DateTime( $date );

		// If looking for logs in the future.
		if ( $date->format( 'Y-m-d' ) > date( 'Y-m-d' ) ) {
			return redirect( sprintf( '/view/%s', date( "Y-m-d" ) ) )
				->with( 'status', $this->time_quotes[ array_rand( $this->time_quotes ) ] );
		}

		$logs = Message::whereDate( 'time', '=', $date->format( 'Y-m-d' ) )->orderBy( 'time', 'desc' )->get();

        return view( 'logs.table', [ 'logs' => $logs, 'log_date' => $date->format( 'Y-m-d' ) ] );
	}

	function nickname( $nickname ) {
		$logs = Message::where( 'nickname', '=', $nickname )->orderBy( 'time', 'desc' )->get();

        return view( 'logs.nickname', [ 'logs' => $logs, 'nickname' => $nickname ] );
	}

	function search( Request $request ) {
		if ( strlen( $request->input( 's' ) ) < 4 ) {
			return redirect( '/' )
				->with( 'status', 'A search can not be less than 4 characters long.' );
		}

		$logs = Message::where( 'message', 'like', sprintf( '%%%s%%', $request->input( 's' ) ) )->orderBy( 'time', 'desc' )->get();

        return view( 'logs.search', [ 'logs' => $logs, 'search' => $request->input( 's' ) ] );
	}

	static function previousLogDateLink( $date = null ) {
		if ( empty( $date ) ) {
			$date = date( "Y-m-d" );
		}

		$date = new \DateTime( $date );
		$date->modify( '-1 day' );

		return sprintf(
			'/view/%s',
			$date->format( 'Y-m-d' )
		);
	}

	static function nextLogDateLink( $date = null ) {
		if ( empty( $date ) ) {
			$date = date( "Y-m-d" );
		}

		$date = new \DateTime( $date );
		$date->modify( '+1 day' );

		return sprintf(
			'/view/%s',
			$date->format( 'Y-m-d' )
		);
	}
}
