<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Log;

class dbSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 500; $i++){
             $data[] = [
             	'id' => NULL,
             	'v_id' => 1,
				'status' => rand(0, 1),
				'created_at' => Carbon::now()->addMinutes($i)
             ];
        }

        Log::insert($data);
    }
}
