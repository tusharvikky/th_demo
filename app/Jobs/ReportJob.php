<?php

namespace App\Jobs;

use App\Log as DBLog;
use Illuminate\Support\Facades\Log;

class ReportJob extends Job
{
    protected $data;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // This queue will handle the report generation and Mail it to the user
        $v_id = $data['v_id'];
        $from = date('Y-m-d', $data['from']); 
        $to = date('Y-m-d', $data['to']);

        // Query the data.
        // Was trying to get the data from sql query but thats complicated.
        // So iterating it over with records.
        $results = DBLog::where('v_id', $v_id)->whereBetween('created_at', array($from, $to))->get();
        $i_from = $results[0]->created_at;
        $current = $results[0]->status;

        // Logging.. Instead we could create an excel file and attach it to a mail and
        // send it to the registered User Email.
        Log::info("From\t|\tTo\t|\tStatus");
        foreach ($results as $key => $result) {
            
            if(isset($results[$key+1])){
                $next = $results[$key+1];
                $i_to = $next->created_at;
                $i_status = $next->status;

                if($current != $i_status){
                    Log::info("$i_from\t|\t$i_to\t|\t|$result->status");
                    $i_from = $result->created_at;
                    $current = $result->status;
                }

            }
        }
    }
}
