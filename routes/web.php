<?php

use App\Jobs\ReportJob;
use Illuminate\Support\Facades\Log;

Use App\Log as DBLog;

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

// Should be in Controller, but since we only have two functions,
// building a controller seems to be an overkill.
$router->get('insert', function() use ($router) { // Should be a post request

	// Create a queue just to insert rows into the DB.
});

$router->get('query', function () use ($router) { 
	// $data = \Request::all();
	$data['v_id'] = $v_id = 1;
	$data['from'] = $from = '2018-07-17';
	$data['to'] = $to = '2018-07-18';

		// $results = DBLog::where('v_id', $v_id)->whereBetween('created_at', array($from, $to))->get();
		// $i_from = $results[0]->created_at;
		// $current = $results[0]->status;
  //       // Logging.. Instead we could create an excel file and attach it to a mail and
  //       // send it to the registered User Email.
  //       Log::info("From\t|\tTo\t|\tStatus");
  //       foreach ($results as $key => $result) {
        	
  //       	if(isset($results[$key+1])){
	 //        	$next = $results[$key+1];
  //       		$i_to = $next->created_at;
  //       		$i_status = $next->status;

  //       		if($current != $i_status){
  //           		Log::info("$i_from\t|\t$i_to\t|\t|$result->status");
  //       			$i_from = $result->created_at;
		// 			$current = $result->status;
  //       		}

  //       	}
  //       }

	ReportJob::dispatch($data);
});
