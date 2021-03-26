<?php

namespace Database\Seeders;
use Database\Factories;
use Illuminate\Database\Seeder;
use DB as DBS;

class BuyerDetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DBS::table('buyer_details')->delete();
         $buyer_details_array = array
    	(
             array(1,"Cake"),
    		 array(2,"CRM"),
              
    	);

    	foreach ($buyer_details_array as $key => $value) {
    		DBS::table('buyer_details')->insert([
    			'id' => $value[0],
    			'buyer_name' => $value[1] ,
    		]);
    	}
    }
}
