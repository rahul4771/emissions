<?php

/*
    #############################################################################
    # Vandalay - Copyright (C)  http://vandalay.in
    # This code is written by Vandalay, It's a sole property of
    # Vandalay and cant be used / modified without license.  
    # Any changes / alterations, illegal uses, unlawful distribution, copying is strictly
    # prohibited
    #############################################################################
    # Name: FollowupController.php
    # Created: 10-02-2021 Rajesh
    # Updated: 10-02-2021 Rajesh
    # Purpose: Followup page for car reg. no.
    ############################################################################
*/

namespace App\Http\Controllers\Followup;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\VisitorInterface;
use App\Repositories\Interfaces\PixelFireInterface;
use App\Repositories\Interfaces\RedirectInterface;
use App\Repositories\Interfaces\FollowupInterface;
use Illuminate\Support\Facades\URL;
use App\Models\UserVehicleDetails;
use App\Models\FollowupVisit;
use App\Models\HausfeldApiResponses;
use App\Models\Visitor;
use App\Models\User;
use App\Models\VehicleDataLookup;
use App\Models\UserQuestionnaireAnswers;
use App\Models\UserExtraDetail;
use App\Models\UserQuestionnaireAnswersHistories;
use App\Models\FollowupHistories;
use App\Repositories\LogRepository;
use Exception;

class FollowupController extends Controller
{

    public function __construct(PixelFireInterface $pixelfireRepo, VisitorInterface $visitorRepo, RedirectInterface $redirectInterface,  FollowupInterface $followupRepo)
    {  
       $this->pixelfireRepo        = $pixelfireRepo;
       $this->visitorRepo          =  $visitorRepo;
       $this->redirectInterface    = $redirectInterface;
       $this->followupRepo         = $followupRepo;
    }
    
    public function index(Request $request)
    {
        $splitName      = 'followup';
        //$visitorData    = FollowupClass::getFollowupUserTransDetails( $request->atp_sub2 );
        $visitorData    = $this->followupRepo->getFollowupUserTransDetails( $request->atp_sub2 );
        
        if ( ! isset( $visitorData->user_id ) ) {
            abort(404);
        }
        $userId         = $visitorData->user_id;
        $visitorId      = $visitorData->visitor_id;
        $isQualified    = $visitorData->is_qualified;

        $user_already_claimed          = UserVehicleDetails::select('id','car_reg_no','buyer_api_flag')
                                        ->where('user_id', '=', $userId)
                                        ->first();
        
        if(isset($user_already_claimed)) { 
            if($user_already_claimed->buyer_api_flag=='1') {
                $msgstr="You have already claimed";

                //RedirectClass::redirectToThankyouUnqualifiedPage('web/thankyou', array('userId'=>$userId, 'visitorId'=>$visitorId,'msgstr'=>$msgstr));

                $strThankyouPage = $this->redirectInterface->redirectToThankyouUnqualifiedPage( 'web/thankyou-error', array( 'userId'=>$userId, 'visitorId'=>$visitorId ,'msgstr'=>$msgstr ) );
                die;  
            } elseif($user_already_claimed->buyer_api_flag==0) { 
                $carregno_already_claimed   = UserVehicleDetails::select('id')
                                                ->where('car_reg_no', '=', $request->carRegNo)
                                                ->where('buyer_api_flag', '=', '1')
                                                ->first();

                if(isset($carregno_already_claimed)) { 
                    $msgstr="Someone is already claimed";
                    //RedirectClass::redirectToThankyouUnqualifiedPage('web/thankyou', array('userId'=>$userId, 'visitorId'=>$visitorId,'msgstr'=>$msgstr)); 
                    $this->redirectInterface->redirectToThankyouUnqualifiedPage('web/thankyou',array("userId"=>$userId,"visitorId"=>$visitorId,'msgstr'=>$msgstr));
                } else {
                    $check_exist_buyer = HausfeldApiResponses::select('id')
                                            ->where('user_id', '=', $userId)
                                            ->first();
                    

                    if(isset($check_exist_buyer)) { 
                        $msgstr="We are unable to process your Claim";    
                        //RedirectClass::redirectToThankyouUnqualifiedPage('web/thankyou', array('userId'=>$userId, 'visitorId'=>$visitorId,'msgstr'=>$msgstr ) ); 
                        $this->redirectInterface->redirectToThankyouUnqualifiedPage('web/thankyou',array("userId"=>$userId,"visitorId"=>$visitorId,'msgstr'=>$msgstr));
                    } else {
                        
                        #### redirect to followup analyze page ###
                        //RedirectClass::redirectToAnalyzePage('followup.anayzingrequest', array('userId'=>$userId, 'visitorId'=>$visitorId,'isQualified'=>$isQualified ) );
                        $this->redirectInterface->redirectToSignPage('followup.anayzingrequest',array("userId"=>$userId,"visitorId"=>$visitorId, 'isQualified'=>$isQualified ));  
                    }
                }
            }
        }

        $followupDetails = FollowupVisit::where('atp_sub2',$request->atp_sub2)
                                ->where('tracker_unique_id',$request->pixel)
                                ->first();
        if ( ! $followupDetails ) {
            $flvVisitId = FollowupVisit::insertGetId([
                    'user_id'       => $userId,
                    'visitor_id'    => $visitorId,
                    'tracker_unique_id'=> $request->pixel,
                    'atp_sub2'      => $request->atp_sub2,
                    'source'        => $request->atp_sub6,
                    'type'          => 'me',
                    'request'       => serialize($request->all())
                ]);

        } else {
            $flvVisitId = $followupDetails->id;
        }
        
        $trackerData = [
            'tracker'       => $request->tracker,
            'pixel'         => $request->pixel,
            'atp_source'    => $request->atp_source,
            'atp_vendor'    => $request->atp_vendor,
            'atp_sub1'      => $request->atp_sub1,
            'atp_sub2'      => $request->atp_sub2,
            'atp_sub3'      => $request->atp_sub3,
            'atp_sub4'      => $request->atp_sub4,
            'url_id'        => $request->url_id,
            'lp_id'         => $request->lp_id,
        ];

        // campaign
        //$trackerType  = VisitorClass::defineTrackerType( $trackerData );
        $trackerType    = $this->visitorRepo->defineTrackerType($trackerData);

        //$flagFLPVisit   = PixelFire::getPixelFireStatus("FLP", $visitorId);
        $flagFLPVisit   = $this->pixelfireRepo->getPixelFireStatus("FLP",$visitorId);
        if ( ! $flagFLPVisit ) {
            //PixelFire::setPixelFireStatus("FLP", $visitorId, $userId);
            $flagTYVisit = $this->pixelfireRepo->setPixelFireStatus("FLP",$visitorId, $userId);
        }


        #####  adtopia fixel firing #####
        //$flagFLPVisitFollowup = PixelFire::getFollowupPixelFireStatus( "LP", $flvVisitId );
        $flagFLPVisitFollowup = $this->pixelfireRepo->getFollowupPixelFireStatus("LP",$flvVisitId);
                                  
        
        if ( ! $flagFLPVisitFollowup ) {
            if ( $trackerType == 1 ) {
                $chkArry = [ 
                    "tracker_type"  => $trackerType,
                    "tracker"       => $request->tracker,
                    "atp_vendor"    => $request->atp_vendor,
                    "pixel"         => $request->pixel, 
                    "pixel_type"    => "LP",
                    "statusupdate"  => "SPLIT",
                    "intVisitorId"  => $visitorId,
                    "redirecturl"   => URL::full(),
                    "flvvisit_id"   => $flvVisitId,
                    "user_id"       =>$userId
                ];

                //$arrResultDetail = PixelFire::atpFollowupPixelFire( $chkArry ); 
                $arrResultDetail = $this->pixelfireRepo->atpFollowupPixelFire( $chkArry );
                
                if ( ! empty($arrResultDetail) ) {

                    $resp = serialize($arrResultDetail);

                    if (@$flvVisitId!="") {
                        FollowupVisit::where( 'id', '=', $flvVisitId )
                                    ->update( array( 'fireflag'=>1, 'adtopia_response'=> @$resp ));
                    }

                } else {
                   $resp = ''; 
                }
                
                $FileContent_new = "\n-------------- array: ".serialize($chkArry);
                $FileContent_new .= "\n-------------- responce: ".serialize($arrResultDetail);
                $FileContent_new .= "\n-------------- User ID: ".$userId;
                $logFileName    ='-FL-LPfire';
                $logRepo        = new LogRepository;
                $logWrite       = $logRepo->writeLog($logFileName,$FileContent_new);
            } 
        }
        ##### end #####
        $user_answers       = UserQuestionnaireAnswers::select('input_answer')
                                ->where('user_id', '=', $userId)
                                ->whereIn('questionnaire_id', [2,3])
                                ->count();
        $pageData = [
            'resource_path' => asset( 'assets/followup' ).'/',
            'action_page'   => route('followup.store'),
            'user_id'       => $userId,
            'visitor_id'    => $visitorId,
            'is_qualified'  => $isQualified,
            'title'         => 'Hausfeld',
            'APP_URL'        => env('APP_URL'),
            'flp_visit_id'  => $flvVisitId,
            'matomo_page_name' => 'V1-followup',
            'visitor'       => $visitorData,
            'user_answers' => @$user_answers
            
        ];
        // check
        //$arrVisitor = VisitorClass::getVisitorUserTransDetails($visitorId, $userId);
        $arrVisitor = $this->visitorRepo->getVisitorUserTransDetails($visitorId,$userId);
        return view( $splitName . '.index' , compact('pageData'));
    }

    public function store( Request $request ) 
    {
        if (empty($request->visitor_id) || empty($request->user_id) ) {
            return redirect(403);
        } else {
            $intUserId      = $request->user_id;
            $intVisitorId   = $request->visitor_id;
            $flp_visit_id   = $request->fl_visitid;
            $source         = $request->source;
            $question2      = $request->purchase_finance_lease;
            $question3      = $request->joinanother;
        }

        if ( $intUserId == 0 ) {
            //RedirectClass::redirectToThankyouUnqualifiedPage('web/thankyou', array('userId'=>$intUserId, 'visitorId'=>$intVisitorId ) ); 
            $this->redirectInterface->redirectToThankyouUnqualifiedPage('web/thankyou',array("userId"=>$intUserId,"visitorId"=>$intVisitorId ));
            die;
        }
        $carRegNo           = $request->carRegNo;
        $keeperEndDate      = $request->keeperDate==""?null:$request->keeperDate;
        

        $user_split         = Visitor::select('split_id')->where('id','=',$intVisitorId)->first();
        if ($user_split) {
            $split_id   = $user_split->split_id;
        } else {
            $split_id   = null;
        }

        $user               = User::select('is_qualified')->where( 'id', '=', $intUserId )->first();
        if ($user) {
            $is_qualified   = $user->is_qualified;
        } else {
            $is_qualified   = null;
        }

        #### insert into uservechicle table ####
        //$car_vechicle_lookup = VehicleDataLookup::select('tr_smmt_range','make','engine_number','engine_code','england_or_wales','model','fuel_type','registration_number','year_of_manufacture','tr_smmt_series','cherished_transfer_history','ma_vehicle_data','status')
        $car_vechicle_lookup = VehicleDataLookup::select('tr_smmt_range','make','engine_number','england_or_wales','model','fuel_type','registration_number','year_of_manufacture','tr_smmt_series','cherished_transfer_history','ma_vehicle_data','status')
                            ->where('car_reg_no', '=', $carRegNo)
                            ->orderBy('id', 'DESC')
                            ->first();
        
        $user_vehicle_data    = array(
                'user_id'               =>  $intUserId,
                'visitor_id'            =>  $intVisitorId,
                'split_id'              =>  $split_id,
                'source'                =>  'FLP',
                'car_reg_no'            =>  $carRegNo,
                'tr_smmt_range'         =>  @$car_vechicle_lookup->tr_smmt_range,
                'make'                  =>  @$car_vechicle_lookup->make,
                'engine_number'         =>  @$car_vechicle_lookup->engine_number,
                'engine_code'           =>  @$car_vechicle_lookup->engine_code,
                'england_or_wales'      =>  NULL,
                'model'                 =>  @$car_vechicle_lookup->model,
                'fuel_type'             =>  @$car_vechicle_lookup->fuel_type,
                'registration_number'   =>  @$car_vechicle_lookup->registration_number,
                'year_of_manufacture'   =>  @$car_vechicle_lookup->year_of_manufacture,
                'tr_smmt_series'        =>  @$car_vechicle_lookup->tr_smmt_series,
                'cherished_transfer_history'=> @$car_vechicle_lookup->cherished_transfer_history,
                'keeper_end_date'       =>  $keeperEndDate,
                'ma_vehicle_data'       =>  @$car_vechicle_lookup->ma_vehicle_data,
                'status'                =>  '1',
            ); 
        $userVehicleId    = UserVehicleDetails::insertGetId($user_vehicle_data);

        // $keeper_date      = $request->carAcquiredDate;
        
        // if($keeper_date!="") {
        //     UserQuestionnaireAnswers::insertGetId(array('user_id'=>$intUserId,'questionnaire_id'=>1,'input_answer'=>$keeper_date));
        // }
        // $entry_starting_date    = strtotime('01-01-2009');
        // $entry_end_date         = strtotime('31-12-2018');
        // $car_acq_date_time      = strtotime($keeper_date);

        // if($car_acq_date_time >= $entry_starting_date && $car_acq_date_time <=$entry_end_date) {
        //     $is_qualified_update = 1;
        // } else {
        //     $is_qualified_update = 0;
        // }
        $is_qualified_update = 1;
        User::where( 'id', '=', $intUserId )->update( array( 'is_qualified'=>$is_qualified_update));
        UserExtraDetail::where( 'user_id', '=', $intUserId )
                ->update( array( 'car_registration_number'=>$carRegNo));
        $user_answers_arr     = [];
        $historyArr           = [];
        if ($question2) {
            $objUserQuestionnaireAnswers = new UserQuestionnaireAnswers;
            $objUserQuestionnaireAnswers->user_id                   = $intUserId;
            $objUserQuestionnaireAnswers->questionnaire_id          = 2;
            $objUserQuestionnaireAnswers->input_answer              = $question2;
            $objUserQuestionnaireAnswers->save();
            $user_answers_arr[] = [
                                        'user_id'                   => $intUserId,
                                        'questionnaire_id'          => 2,
                                        'questionnaire_option_id'   => "",
                                        'input_answer'              => $question2,
                                        'status'                    => 1
                                    ];

             $historyArr[]      = [
                                        'user_id'           => $intUserId,
                                        'bank_id'           => 0,
                                        'type'              => 'questionnaire0',
                                        'type_id'           => 2,
                                        'value'             => $question2,
                                        'source'            => 'FLP'
                                    ];
        }
        if ($question3) {
            $objUserQuestionnaireAnswers = new UserQuestionnaireAnswers;
            $objUserQuestionnaireAnswers->user_id           = $intUserId;
            $objUserQuestionnaireAnswers->questionnaire_id  = 3;
            $objUserQuestionnaireAnswers->input_answer      = $question3;
            $objUserQuestionnaireAnswers->save();
            $user_answers_arr[] = [
                                        'user_id'                   => $intUserId,
                                        'questionnaire_id'          => 3,
                                        'questionnaire_option_id'   => "",
                                        'input_answer'              => $question3,
                                        'status'                    => 1
                                    ];
            $historyArr[]       = [
                                    'user_id'           => $intUserId,
                                    'bank_id'           => 0,
                                    'type'              => 'questionnaire0',
                                    'type_id'           => 3,
                                    'value'             => $question3,
                                    'source'            => 'FLP'
                                  ];
        }
        foreach ($user_answers_arr as $key => $value) {
            $user_qa_history = [
                                    'user_id'                   => $intUserId,
                                    'bank_id'                   => 0,
                                    'type'                      => 'questionnaire0',
                                    'raw_data'                  => json_encode($value),
                                    'source'                    => 'FLP'
                                ];
            UserQuestionnaireAnswersHistories::create($user_qa_history);
        }
        if ($historyArr) {
            FollowupHistories::insert($historyArr);
        }
        //RedirectClass::redirectToAnalyzePage('followup.anayzingrequest', array('userId'=>$intUserId, 'visitorId'=>$intVisitorId,'isQualified'=>0));  
        $this->redirectInterface->redirectToSignPage('followup.anayzingrequest',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,"isQualified"=>$is_qualified_update));
    }
}
