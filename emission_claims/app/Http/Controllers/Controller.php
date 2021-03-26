<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Repositories\Interfaces\UAInterface;
use View;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct(UAInterface $ua)
	{
		$this->ua = $ua;
		$onInit 				=	[];
        $arrUserAgentInfo 		= 	$this->ua->parse_user_agent();
        $onInit['countryCode']  = 	$arrUserAgentInfo['country'];
		View::share('onInit', $onInit);
	}
}
