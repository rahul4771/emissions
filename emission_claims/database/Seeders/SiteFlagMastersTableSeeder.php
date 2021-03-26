<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use DB;

class SiteFlagMastersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      $data_array = array
      (
        array(1,"All",'All pages'),
        array(2,"Web",'Website Page'),
        array(3,"Mobile","Mobile page"),
        array(4,"Tablet",'Tablet page')
      );
       foreach ($data_array as $key => $value) 
       {
        DB::table('site_flag_masters')->insert([
         'id' => $value[0],
         'site_flag_name' => $value[1] ,
         'site_flag_comment' => $value[2] ,           
       ]);
        }	
    }
}
