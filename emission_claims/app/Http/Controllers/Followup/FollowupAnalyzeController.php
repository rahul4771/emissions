<?php

/*
    #############################################################################
    # Vandalay - Copyright (C)  http://vandalay.in
    # This code is written by Vandalay, It's a sole property of
    # Vandalay and cant be used / modified without license.  
    # Any changes / alterations, illegal uses, unlawful distribution, copying is strictly
    # prohibited
    #############################################################################
    # Name: FollowupAnalyzeController.php
    # Created: 10-02-2021 Rajesh
    # Updated: 10-02-2021 Rajesh
    # Purpose: Followup analyze page after sumiting the form details of the car reg. no. on followup.
    ############################################################################
*/

namespace App\Http\Controllers\Followup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\VisitorInterface;
use App\Repositories\Interfaces\PixelFireInterface;
use App\Repositories\Interfaces\RedirectInterface;
use Illuminate\Support\Facades\URL;
use App\Repositories\LogRepository;
use App\Services\CaseFunnelService;
use App\Models\Visitor;
use App\Models\FollowupVisit;
use App\Models\User;
use Exception;
use App\Models\UserVehicleDetails;
use Carbon\Carbon;
use App\Repositories\Interfaces\CommonFunctionsInterface;

class FollowupAnalyzeController extends Controller
{

    public function __construct(PixelFireInterface $pixelfireRepo, VisitorInterface $visitorRepo, RedirectInterface $redirectInterface, CommonFunctionsInterface $commonFunctionRepo)
    {  
       $this->pixelfireRepo        = $pixelfireRepo;
       $this->visitorRepo          = $visitorRepo;
       $this->redirectInterface    = $redirectInterface;
       $this->caseFunnelService    = new CaseFunnelService();
       $this->commonFunctionRepo   = $commonFunctionRepo;
    }
    
    public function followupAnayzingRequest(Request $request)
    {   
        $resourcePath           =   asset('assets/analyzing_request/').'/';
        $data                   =   array();
        $data['title']          =   'Hausfeld';
        $data['APP_URL']        =   env('APP_URL');
        $data['intVisitorId']   =   $request->visitor_id;
        $data['intUserId']      =   $request->user_id;
        $intVisitorId           =   $request->visitor_id;
        $intUserId              =   $request->user_id;
        $isQualified            =   $request->is_qualified;

        $txtTitle               =   '';
        $strFileName            =   "Followup Analyzing Request";
        $data['strFileName']    =   $strFileName;
        //$arrVisitorUserData     =  VisitorClass::getVisitorUserTransDetails($intVisitorId,$intUserId);
        $arrVisitorUserData = $this->visitorRepo->getVisitorUserTransDetails($intVisitorId,$intUserId);
        if (!empty($arrVisitorUserData)) {
            $txtTitle           =   $arrVisitorUserData->title;
        }
        $data['txtTitle']       =   $txtTitle;

        ### pixel fire ####
        //$flagTYVisit        = PixelFire::getPixelFireStatus("FLPTY",$intVisitorId);
        $flagTYVisit   = $this->pixelfireRepo->getPixelFireStatus("FLPTY",$intVisitorId);
        if (!$flagTYVisit) {
            //PixelFire::SetPixelFireStatus("FLPTY",$intVisitorId,$intUserId);
            $this->pixelfireRepo->setPixelFireStatus("FLPTY",$intVisitorId, $intUserId);
        }

        $split_info         = Visitor::join('split_info','visitors.split_id',"=",'split_info.id')
                                        ->where('visitors.id',$request->visitor_id)
                                        ->select('split_info.split_path','split_info.split_name')
                                        ->first();
        $splitName          = "";
        if(isset($split_info)) {
            $splitName      = $split_info->split_name; 
        }

        //Adtopia TY fire in Vendor Pixel Firing
        $flp_visit_id  = FollowupVisit::where('user_id',$intUserId)->first()->id;
        if(isset($flp_visit_id) && $flp_visit_id != "") { 

            $pixel  = FollowupVisit::where('id',$flp_visit_id)->first()->tracker_unique_id;
            //$flagFLPVisitFollowup   = PixelFire::getFollowupPixelFireStatus("TY",$flp_visit_id);
            $flagFLPVisitFollowup   = $this->pixelfireRepo->getFollowupPixelFireStatus("TY",$flp_visit_id);
    
     
            if(!$flagFLPVisitFollowup) {  
                $chkArry = array("tracker_type"  => "1",
                        "tracker"            => " ",
                        "atp_vendor"         => isset($request->atp_vendor)?$request->atp_vendor:"",
                        "pixel"              => $pixel, 
                        "pixel_type"         => "TY",
                        "statusupdate"       => "SPLIT",
                        'user_id'            => $request->user_id,
                        "intVisitorId"       => $request->visitor_id,
                        "redirecturl"        => URL::full(),
                        'flvvisit_id'        => $flp_visit_id,
                        ); 
    
                //$arrResultDetail = PixelFire::atpFollowupPixelFire($chkArry);
                $arrResultDetail = $this->pixelfireRepo->atpFollowupPixelFire( $chkArry );
    
                if (!empty($arrResultDetail)) { 
                    $resp = serialize($arrResultDetail);
                    if(@$flp_visit_id!="") { 
                        FollowupVisit::where( 'id', '=', $flp_visit_id )
                                    ->update( array( 'fireflag'=>1, 'adtopia_response'=> @$resp ));
                    } else {
                       
                    }
                } else {
                   $resp = ''; 
                }
                
                $FileContent_new = "\n-------------- array: ".serialize($chkArry);
                $FileContent_new .= "\n-------------- responce: ".serialize($arrResultDetail);
                $logFileName    ='-FL-TYfire';
                $logRepo        = new LogRepository;
                $logWrite       = $logRepo->writeLog($logFileName,$FileContent_new);
            }
                
        }
        
        //$anaylzeEndPage        =   env('APP_URL').RedirectClass::redirectToThankyouPage('followup/analyze-end',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,"isQualifid"=>$isQualified));
        $anaylzeEndPage        =   $this->redirectInterface->redirectToThankyouPage('followup/analyze-end',array("userId"=>$intUserId,"visitorId"=>$intVisitorId, "isQualified"=>$isQualified));

        return view('splits.analyzing_request',compact('data','resourcePath','splitName','anaylzeEndPage'));
    }

    public function followupAnalyzeEndPage( Request $request )
    {
        
        $intVisitorId           = $request->visitor_id;
        $intUserId              = $request->user_id;
        //$isQualified            = $request->is_qualified;
        
        $isQualified  =   0;
        $userVehicleDetails = UserVehicleDetails::where('user_id',$intUserId)->first();
        if ($userVehicleDetails) {
            $userVehicleDetailsJSON = json_decode($userVehicleDetails->ma_vehicle_data,true);
            //$YearOfManufacture      = $userVehicleDetailsJSON['DataItems']['VehicleRegistration']['YearOfManufacture'];

            $YearOfManufacture      =  $this->commonFunctionRepo->yearOfManufacture($userVehicleDetailsJSON);
            
            $entry_starting_date    = '2009';
            $entry_end_date         = '2018';

            if($YearOfManufacture >= $entry_starting_date && $YearOfManufacture <=$entry_end_date) {
                $isQualified  =   1;
            } else {
                $isQualified  =   0;
            }
        }

        if ($isQualified==0) {
            User::whereId($intUserId)->update(array('is_qualified'=> 0));
            $msgstr="Unfortunately, your vehicle does not match the criteria for us to proceed at this time.";
            $this->redirectInterface->redirectToThankyouUnqualifiedPage('web/thankyou-unqualified',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,'msgstr'=>$msgstr));
        } else {
            $response               =   $this->caseFunnelService->buyerPost($request->user_id, $request->visitor_id, 'LIVE'); 
            if (isset($response['status']) && $response['status'] == 'success' ) {
                //dd($response);
                if ( isset($response['url']) && $response['url']) {
                    header("Location: " . $response['url']);
                    die;
                }
            } else {
                
                //User::where('id',$intUserId)->update(['is_qualified'=> 0]);
                
                $msgstr="Unfortunately, your vehicle does not match the criteria for us to proceed at this time.";
                $this->redirectInterface->redirectToThankyouUnqualifiedPage('web/thankyou-unqualified',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,'msgstr'=>$msgstr));
            }
        }
    }
}