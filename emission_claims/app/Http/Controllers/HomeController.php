<?php
/*
    #############################################################################
    # Vandalay - Copyright (C)  http://vandalay.in
    # This code is written by Vandalay, It's a sole property of
    # Vandalay and cant be used / modified without license.  
    # Any changes / alterations, illegal uses, unlawful distribution, copying is strictly
    # prohibited
    #############################################################################
    # Name: HomeController.php
    # Created: 16-01-2020 Developer Name
    # Updated: 16-01-2020 Developer Name
    # Purpose: A Controller page of a site.
    ############################################################################
*/

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SiteConfig;
use App\Repositories\Interfaces\CommonFunctionsInterface;
use App\Models\AdvVisitor;
use App\Models\VendorPixelFiring;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\UAInterface;

class HomeController extends Controller
{
    public function __construct(UAInterface $ua)
    {
      $this->ua = $ua;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

    /**
     * function to define device details and site redirection URL.
    */
       
        $output = $this->ua->parse_user_agent();

        $query_config_title     = "DESKTOP_DEFAULT_URL_MDGA";
        if ($output['device'] == "Mobile") 
        {
            $query_config_title = "MOBILE_DEFAULT_URL_MDGA";
        } 
        else if ($output['device'] == "Tablet") 
        {
            $query_config_title = "TABLET_DEFAULT_URL_MDGA";
        } 
        else 
        {
            $query_config_title = "TABLET_DEFAULT_URL_MDGA";
        }
 
        $configured_url_path    = SiteConfig::select('config_value')
                                  ->where('config_title',$query_config_title)
                                  ->first();
        $route_path =  $configured_url_path->config_value;
        //dd($route_path);
        return redirect($route_path);                 
                                
    }
    /**
     * function to print device details.
    */
    public function details()
    {
       
        $output = $this->ua->parse_user_agent();
        print_r($output);
        exit;
    }

    /**
     * function to view split details.
    */
    public function splits($device='',$name='')
    {
        $split_name   = $name;
        $data['name'] = $name;
        return view('splits'.$device.'.'.$name.'.index',compact('data','split_name'));
    }
    /**
     * function to view Advertorials details.
    */
    public function advertorials($name='')
    {
       print $name;
       print "Advertorials"; exit;
    }
    /**
     * function to view Affiliate details.
    */
    public function affiliate(CommonFunctionsInterface $commonFunctionRepo)
    {
        $insid = $commonFunctionRepo->checkAffiliatePixel('YLBESTPPI',1,1116);
        print $insid;
        exit;
    }
    /**
     * function to get user transaction details.
    */
    // public function signature(UserInterface $userRepo)
    // {
    //     $arrVisitorUserData = $userRepo->getVisitorUserTransDetails($f->intVisitorId, $f->intUserId);
    //     print_r($arrVisitorUserData);exit;
    // }
    /**
     * function to get call fbPixelFire.
    */
    public function fbPixelFire(Request $request)
    {
        if (isset($request->pid) && $request->pid != '') {
           $pid                 = $request->pid;
        } else {
            $adv_visitor_deatil = AdvVisitor::select("pid")->whereId($request->adv_vis_id)->first();
           
            $pid                = $adv_visitor_deatil->pid;
        }

        $data                       = array("type"          => $request->type,
                                           "adv_vis_id"    => $request->adv_vis_id,
                                           "userId"        => $request->userId,
                                           "visitorId"     => $request->visitorId,
                                           "pid"           => $pid,
                                           "redirect_url"  => $request->redirect_url);
        $vpFiringObj                = new VendorPixelFiring();
        $vpFiringObj->visitor_id    = $request->visitorId;
        $vpFiringObj->user_id       = $request->userId;
        $vpFiringObj->vendor        = 'fb-pixel';
        $vpFiringObj->page_type     = 'TY';
        $vpFiringObj->pixel_type    = 'web';
        $vpFiringObj->pixel_log     = '';
        $vpFiringObj->pixel_result  = '';
        $vpFiringObj->save();
        return view('fb-pixel',compact('data'));
    }
}
