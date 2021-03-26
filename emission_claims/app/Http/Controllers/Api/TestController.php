<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Carbon\Carbon;
use App\Helpers\ApiClass;
//use App\Repositories\Api\TestRepository;


class TestController extends Controller
{
    public function __construct()
    {
        //$this->model = new TestRepository();
    }

    public function index(Request $request) 
    {
        //dd($request->all());
    	$data 		= array();
    	$jsonData 	= $request->all();
        $currentUrl	=  URL::full();
        //print $currentUrl;
       
        //$valid 		= ApiClass::validateToken($request);        

        // if($valid == 1){
        //     //$data['visitor']       =   $this->model->getVisitors();
        // 	$data['response'] 	= "Authentication Passed";
        //     $data['status'] 	= "Success";
        // } else {
        	$data['response'] 	= "Authentication Failed";
        	$data['status'] 	= "Failed";
        //}
        return response()->json($data);
    }
}
