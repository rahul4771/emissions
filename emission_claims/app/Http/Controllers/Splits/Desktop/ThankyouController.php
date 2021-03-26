<?php

/*
    #############################################################################
    # Vandalay - Copyright (C)  http://vandalay.in
    # This code is written by Vandalay, It's a sole property of
    # Vandalay and cant be used / modified without license.  
    # Any changes / alterations, illegal uses, unlawful distribution, copying is strictly
    # prohibited
    #############################################################################
    # Name: ThankyouController.php
    # Created: 06-04-2020 sandeep
    # Updated: 06-04-2020 sandeep
    # Purpose: Thank you page after sumiting the form details of the split.
    ############################################################################
*/

namespace App\Http\Controllers\Splits\Desktop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\VisitorInterface;
use App\Repositories\Interfaces\PixelFireInterface;
use App\Models\Visitor;
use App\Models\ThriveVisitor;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Log;
use App\Models\VisitorUnqualified;
use App\Models\AdtopiaVisitor;
use App\Models\User;
use App\Repositories\Interfaces\RedirectInterface;
use App\Services\CaseFunnelService;
use App\Repositories\LogRepository;
use App\Repositories\SendSmsRepository;
use App\Models\Connection;
use Config;
use DB;
use App\Models\UserVehicleDetails;
use App\Repositories\Interfaces\CommonFunctionsInterface;

class ThankyouController extends Controller
{

    public function __construct(PixelFireInterface $pixelfireRepo, VisitorInterface $visitorRepo, RedirectInterface $redirectInterface, CommonFunctionsInterface $commonFunctionRepo)
    {  
       $this->pixelfireRepo        = $pixelfireRepo;
       $this->visitorRepo          = $visitorRepo;
       $this->redirectInterface    = $redirectInterface;
       $this->caseFunnelService    = new CaseFunnelService();
       //$this->sendSmsRepo          = $sendSmsRepo;
       $this->commonFunctionRepo   = $commonFunctionRepo;
    }
    
    public function index(Request $request)
    {

        $resourcePath           = asset('assets/web-thankyou/').'/';
        $data                   = array();
        $data['title']          = 'Hausfeld';
        $data['APP_URL']        = env('APP_URL');
        $data['intVisitorId']   = $request->visitor_id;
        $data['intUserId']      = $request->user_id;
        $intVisitorId           = $request->visitor_id;
        $intUserId              = $request->user_id;
       // $txtTitle               = '';
        $strFileName            = "thankyou";
        $currentUrl             = URL::full();
        $split_info             = Visitor::join('split_info','visitors.split_id',"=",'split_info.id')
                                            ->where('visitors.id',$request->visitor_id)
                                            ->select('split_info.split_path','split_info.split_name')
                                            ->first();
        $split_path             = "";
        $splitName             = "";
        if(isset($split_info))
        {
            $split_path             = $split_info->split_path;
            $splitName             = $split_info->split_name; 
        }                                    
        
       //  $this->visitorRepo->updateLastVisit($intVisitorId,$strFileName);
       // // TY Flag fire
       //  $flagTYVisit            = $this->pixelfireRepo->getPixelFireStatus("TY",$intVisitorId,$intUserId);

       //  if (!$flagTYVisit) {
       //      $visitor_deatil     = Visitor::select("tracker_master_id","sub_tracker","tracker_unique_id")->whereId($intVisitorId)->first();
            
            
       //      // tracke type thrive
       //      if(isset($tracker_type) && $tracker_type == 3)
       //      {
       //          $thrive_deatils = ThriveVisitor::where('visitor_id',$intVisitorId)->first();
       //          $thr_source     = $thrive_deatils->thr_source;
       //          $thr_sub1="";
       //          if($thr_source == "TIM" || $thr_source == "TQK"){
       //              $fired_pixel = "<script type=\"text/javascript\">
       //                 window._tfa = window._tfa || [];
       //                 _tfa.push({ notify: 'action',name: 'Conversion' });
       //              </script>
       //              <script src=\"//cdn.taboola.com/libtrc/imslabs-quickppi-sc/tfa.js\"></script>";

       //              echo $fired_pixel;
       //              $isMediaPixelFired     = 1;
       //          }
       //          $strFileContent = "" ;     
       //          // Set up log string
       //          $strFileContent = "\n----------\n Date: ".date('Y-m-d H:i:s')."\n thr_source: $thr_source \n thr_sub1: $thr_sub1 \n isMediaPixelFired: $isMediaPixelFired \n User Id: $intUserId \n Visitor Id: $intVisitorId \n";
       //          Log::info("\n----------\n Date: ".date('Y-m-d H:i:s')."\n thr_source: $thr_source \n thr_sub1: $thr_sub1 \n isMediaPixelFired: $isMediaPixelFired \n User Id: $intUserId \n Visitor Id: $intVisitorId \n");
                
       //      }
       //       // ho_cake_visitors
       //      $flagTYVisit        = $this->pixelfireRepo->getPixelFireStatus("TY",$intVisitorId,$intUserId);
       //      if (!$flagTYVisit) {
       //         $this->pixelfireRepo->SetPixelFireStatus("TY",$intVisitorId,$intUserId);
       //      }
       //  }
       //  $cakePostStatus         = "";       
       //  $pixel                  = "";                  
       //  $pixel_type             = "";        
       //  $intVisitorId           = "";
       //  $record_status          = "";               
       //  $buyer_id               = ""; 
       //  $revenue                = "";         
       //  $currency               = ""; 
       //  $intVoluumtrk2PixelFired= "";
       //  $actionpage             = route('web.thankyou.store');

        //return view('splits.web.thankyou',compact('data','resourcePath','actionpage','split_path','splitName'));
        return view('splits.web.thankyou',compact('data','resourcePath','split_path','splitName'));
    }

    public static function unqualified(Request $request)
    {
        $resourcePath           =   asset('assets/unqualified-thankyou/').'/';
        $data                   =   array();
        $data['title']          =   'Hausfeld';
        $data['APP_URL']        =   env('APP_URL');
        $data['intVisitorId']   =   $request->visitor_id;
        $data['intUserId']      =   $request->user_id;
        $intVisitorId           =   $request->visitor_id;
        $intUserId              =   $request->user_id;
        //$txtTitle               =   '';
        $data['mainHead']       =   "We're Sorry!"; 
        $data['subHead']        =   'you have already claimed'; 
        $msg1                   =   0;
        $msg2                   =   0;
        
        if (isset($request->msgstr) && $request->msgstr!="") {
            $msgStr=$request->msgstr;
        } else {
            $msgStr                 ="Unfortunately, your vehicle does not match the criteria for us to proceed at this time.";
        }

        return view('splits.web.thankyou_unqualified',compact('data','resourcePath','msgStr'));
    }

    public function errorPage(Request $request)
    {
        //$resourcePath           =   asset('assets/web-thankyou_unqualified/').'/';
        $resourcePath           =   asset('assets/unqualified-thankyou/').'/';
        $data                   =   array();
        $data['title']          =   'Hausfeld';
        $data['APP_URL']        =   env('APP_URL');
        $data['intVisitorId']   =   $request->visitor_id;
        $data['intUserId']      =   $request->user_id;
        $intVisitorId           =   $request->visitor_id;
        $intUserId              =   $request->user_id;
        //$txtTitle               =   '';
        $strFileName            =   "Thank You";
        $msgStr                 =   'Thanks you for re-visiting our website.<br>We already have your information in our records and is being processed.<br>One of our representative should be reaching you shortly to share an update of your claim.';
        return view('splits.web.thankyou_unqualified',compact('data','resourcePath','msgStr','strFileName'));
    }

    public function visitorUnqualified(Request $request)
    {
        $resourcePath           = asset('assets/unqualified-thankyou/').'/';
        $data                   = array();
        $data['title']          = 'Hausfeld';
        $data['APP_URL']        = env('APP_URL');
        $data['intVisitorId']   = $request->visitor_id;
        $data['mainHead']       = "Sorry you're not eligible"; 
        $data['subHead']        = ' '; 
        $intVisitorId           = $request->visitor_id;
        $questionId             = $request->question_id;
        $answerId               = $request->answer_id;
        //$txtTitle               = '';
        $strFileName            = "thankyou";
        $actionpage             = route('web.thankyou.store');
        $user_email             = $request->user_email;
        
        $visitorUnqualified = VisitorUnqualified::where("visitor_id","=",$intVisitorId)->where("question_id","=",$questionId)->where("answer_id","=",$answerId)->get()->pluck('visitor_id','question_id','answer_id');
       
        if($visitorUnqualified->count() <= 0){
        $visitorUnqualified     = new VisitorUnqualified;
        $visitorUnqualified->visitor_id     = $intVisitorId;
        $visitorUnqualified->question_id    = $questionId;
        $visitorUnqualified->answer_id      = $answerId;
        $visitorUnqualified->input_answer   = '';
        $visitorUnqualified->save();
        }
        return view('splits.web.thankyou_unqualified',compact('data','resourcePath','actionpage','user_email'));  
    }

    public function cookiesDeclaration(Request $request)
    {
        $resourcePath           =   asset('assets/privacy/').'/';
        $data                   =   array();
        $data['title']          =   'Hausfeld';
        $data['APP_URL']        =   env('APP_URL');
        return view('splits.web.cookies-declaration',compact('data','resourcePath'));
    }

    public function intermediateThankYou( Request $request )
    {  
        $resourcePath           =   asset('assets/intermediate_thankyou/').'/';
        $data                   =   array();
        $data['title']          =   'Hausfeld';
        $data['APP_URL']        =   env('APP_URL');
        $data['intVisitorId']   =   $request->visitor_id;
        $data['intUserId']      =   $request->user_id;
        $intVisitorId           =   $request->visitor_id;
        $intUserId              =   $request->user_id;
        $txtTitle               =   '';
        $strFileName            =   "IntermediateThankYou";
        $data['strFileName']    =   $strFileName;
        //$arrVisitorUserData     =  VisitorClass::getVisitorUserTransDetails($intVisitorId,$intUserId);
        $arrVisitorUserData     =  $this->visitorRepo->getVisitorUserTransDetails($intVisitorId,$intUserId);
        if (!empty($arrVisitorUserData)) {
            $txtTitle           =   $arrVisitorUserData->title;
        }
        $data['txtTitle']       =   $txtTitle;



        ### Adtopia Pixel Fire ###

        $visitor_deatil     = Visitor::select("tracker_master_id","sub_tracker","tracker_unique_id")->whereId($intVisitorId)->first();
        $tracker_type       = $visitor_deatil->tracker_master_id;
        $tracker            = $visitor_deatil->sub_tracker;
        $currentUrl         = URL::full();

        if (isset($tracker_type) && $tracker_type == 1) {
         $pixel          = $visitor_deatil->tracker_unique_id;
         $atp_vendor     = AdtopiaVisitor::select("atp_vendor")->whereVisitorId($intVisitorId)->first();
         //$buyer_response = VisitorClass::getVisitorUserTransDetails($intVisitorId, $intUserId);
         $buyer_response     =  $this->visitorRepo->getVisitorUserTransDetails($intVisitorId,$intUserId);
         //$trans_deatil   = UsersTransaction::whereUserId($intUserId)->first();
         $currency       = '';
         $chkArry        = array( 
             "tracker_type"            => $tracker_type,
             "tracker"                 => $tracker,
             "atp_vendor"              => @$atp_vendor->atp_vendor,
             "pixel"                   => $pixel, 
             "pixel_type"              => "TY",
             "statusupdate"            => "SPLIT",
             "intVisitorId"            => $intVisitorId,
             "intUserId"               => $intUserId,
             "redirecturl"             => $currentUrl,
             //"cakePostStatus"          => @$trans_deatil->is_pixel_fire,
             "cakePostStatus"          => '',
             "record_status"           => @$buyer_response->record_status,
             "buyer_id"                => @$buyer_response->buyer_id,
             "revenue"                 => @$buyer_response->lead_value,
             "currency"                => $currency,
             "intVoluumtrk2PixelFired" => '',
             );

         

             //$arrResultDetail        = PixelFire::atpPixelFire($chkArry);
             $arrResultDetail        = $this->pixelfireRepo->atpPixelFire($chkArry);
             if ($arrResultDetail) {
                 $strResult          = $arrResultDetail['result'];
                 $response           = $arrResultDetail['result_detail'];
                 $adtopiapixel       = $arrResultDetail['adtopiapixel'];
                 // UserDetail::where('user_id'=> $intUserId)->update('is_pixel_fire'=>1,'pixel_log'=>$response,'pixel_type'=>'web');
             }
        }

        #### Adtopia Pixel Fire ####




        #### pixel fire ####
        //$flagTYVisit        = PixelFire::getPixelFireStatus("TY",$intVisitorId);
        $flagTYVisit        = $this->pixelfireRepo->getPixelFireStatus("TY",$intVisitorId);
                   
        if (!$flagTYVisit) {
            //PixelFire::SetPixelFireStatus("TY",$intVisitorId,$intUserId);
            $this->pixelfireRepo->SetPixelFireStatus("TY",$intVisitorId,$intUserId);
        }
        $split_info             = Visitor::join('split_info','visitors.split_id',"=",'split_info.id')
                                            ->where('visitors.id',$request->visitor_id)
                                            ->select('split_info.split_path','split_info.split_name')
                                            ->first();
        $splitName             = "";
        if(isset($split_info))
        {
            $splitName             = $split_info->split_name; 
        }
        

        if($intUserId != '')
        { 
            $user_details=User::select("first_name","email","telephone","token","created_at")->whereId($intUserId)->first();
            $data['userTelephone']=$user_details->telephone;
        }
        
        ###### sms section ######
        DB::disconnect('mysql_verticals'); 
        
        
        Config::set("database.connections.mysql_verticals", [
            "driver"=>"mysql",
            "host" => env('DB_HOST_READ'),
            "database" => env('DB_DATABASE'),
            "username" => env('DB_USERNAME'),
            "password" => env('DB_PASSWORD')
        ]);
        
        DB::disconnect('master_mysql_verticals'); 

            ## establishing the connection master with each DB
        Config::set("database.connections.master_mysql_verticals", [
            "driver"=>"mysql",
            "host" => env('DB_HOST_READ'),
            "database" => env('DB_DATABASE'),
            "username" => env('DB_USERNAME'),
            "password" => env('DB_PASSWORD')
        ]);

        
        // Config::set('constants.DOMAIN_ID',$DB_list_val['id']);
        DB::connection('mysql_verticals')->setDatabaseName(env('DB_DATABASE'));
        DB::connection('master_mysql_verticals')->setDatabaseName(env('DB_DATABASE'));
        $this->dbName = env('DB_DATABASE');

        if(env('APP_ENV')=='local') {
            $domain_id=64;
            $atp_urlid = 107;
            $atp_prefix="dev.";
        } elseif(env('APP_ENV')=='dev') { 
              $domain_id=73;
              $atp_urlid = 107;
              $atp_prefix="dev.";
        } elseif(env('APP_ENV')=='pre' || env('APP_ENV')=='live') { 
              $domain_id=74;  
              $atp_urlid = 107;
              $atp_prefix="";
        }
        if($intUserId != '') {
            $user_details=User::select("first_name","email","telephone","token","created_at")->whereId($intUserId)->first();
            $data['userTelephone']      = $user_details->telephone;
            // $user_details->telephone    = '919495652687';
            
            $CheckCnt  = DB::connection('mysql_followup_db')
                                             ->table('followup_list')
                                             ->select('id')
                                             ->where('user_id','=',$intUserId)
                                             ->where('domain_id','=',$domain_id)
                                             ->get();
            //print_r($CheckCnt);    die();
            $strategy_type = ''; $adto_url = ''; $ins_id = 0;

            if(isset($CheckCnt) && $CheckCnt->count()==0) {
        

                if(substr($user_details->telephone, 0, 2) == '07') {
                    $type = 'sms';
                } else {
                    $type = 'email';
                }
             
                // $strategy_Arr = $this->strategyExperiment($type);
                // if($strategy_Arr &&  isset($strategy_Arr['type']))
                // {
                //  $strategy_type = $strategy_Arr['type'];
                // }


                $new_data_insert = array(
                    'domain_id'     => $domain_id,
                    'user_id'       => $intUserId,
                    'phone'         => $user_details->telephone,
                    'email'         => $user_details->email,
                    'type'          => $type,
                    'token'         => $user_details->token,
                    'status'        => '1',
                    'lead_date'     => $user_details->created_at,
                    'sms_strategy_date' =>$user_details->created_at,
                    'strategy_type'     =>1,
                    'created_at'    => date('Y-m-d H:i:s'),
                    'updated_at'    => date('Y-m-d H:i:s')
                );
                //  echo $domain_id;
                 
                if($type == 'sms') {
                    
                    $ins_id     = 0;

                    $ins_id  = DB::connection('mysql_followup_db')
                                    ->table('followup_list')
                                    ->insertGetId($new_data_insert);

                    $lead_date  = $user_details->created_at;
                    $phone      = $user_details->telephone;
                    $token      = $user_details->token;
                    $first_name = $user_details->first_name;

                    $to = trim(preg_replace("/[^0-9]/", "",$phone));
                    $data_Arr = array(
                        'user_id'       => $intUserId,
                        'token'         => $user_details->token,
                        'created_at'    => date('Y-m-d H:i:s'),
                        'updated_at'    => date('Y-m-d H:i:s')
                    ); 

                    $sms_url = "";
                     
                    // TEST 
                    // $to         = "919746308992";
                    // $lead_date  = date('Y-m-d H:i:s');  
                    ###echo "User ID =-=-= ".$value->user_id; //die();

                    // $sms_creds=array(
                    //     'username'=>"test",
                    //     'password'=>'test',
                    //     'account'=>"test" 
                    // );

                    $sms_creds=array(
                        'username' =>  "matthew@yourlondonbridge.com",
                        'password' =>  '$occer@2019',
                        'account'  =>  "EX0330149" 
                    );


                    $adto_url = $atp_prefix."adto.uk/".$token."/".$atp_urlid;
                    $sms_stage='';
                    //$response=SendSms::smsSendingStrategy($to,$adto_url,$data_Arr,$atp_urlid,$domain_id,$first_name,"2way",$sms_creds,$sms_stage);
                    //$sendSmsRepo->smsSendingStrategy($to,$adto_url,$data_Arr,$atp_urlid,$domain_id,$first_name,"2way",$sms_creds,$sms_stage);

                    $sendSmsRepo    = new SendSmsRepository;
                    $sendSmsRepo->smsSendingStrategy($to,$adto_url,$data_Arr,$atp_urlid,$domain_id,$first_name,"2way",$sms_creds,$sms_stage);
                    
                } else {
                    //  echo "===EmAIL-----"; 
                    //  $ins_id=0;$adto_url = '';

                    if($strategy_type == 2) {
                      // EMAIL STRATEGY 

                    }
                }
                 
                $strategy_type="sms"; 

                $FileContent_new = "\n-------------- strategy_type: ".$strategy_type;
                $FileContent_new .= "\n-------------- adto_url: ".$adto_url;
                $FileContent_new .= "\n-------------- User ID: ".$intUserId;

                $FileContent_new .= "\n\n-------------- Mysql followup_list Insert Row ID : ".$ins_id;
                $logFileName    ='_KL_sms';
                //$logWrite       = LogClass::writeLog($logFileName,$FileContent_new);

                $logRepo    = new LogRepository;
                $logWrite   = $logRepo->writeLog($logFileName,$FileContent_new);
            }
        }
                
        ###### sms section end ######
        
        return view('splits.intermediate_thankyou',compact('data','resourcePath','splitName'));
    }


    public function anayzingRequest( Request $request )
    {  
        $resourcePath           =   asset('assets/analyzing_request/').'/';
        $data                   =   array();
        $data['title']          =   'Hausfeld';
        $data['APP_URL']        =   env('APP_URL');
        $data['intVisitorId']   =   $request->visitor_id;
        $data['intUserId']      =   $request->user_id;
        $intVisitorId           =   $request->visitor_id;
        $intUserId              =   $request->user_id;
        $txtTitle               =   '';
        $strFileName            =   "AnalyzingRequest";
        $data['strFileName']    =   $strFileName;
        $isQualified            =   $request->is_qualified;

        //$arrVisitorUserData     =  VisitorClass::getVisitorUserTransDetails($intVisitorId,$intUserId);
        $arrVisitorUserData     =  $this->visitorRepo->getVisitorUserTransDetails($intVisitorId,$intUserId);

        if (!empty($arrVisitorUserData)) {
            $txtTitle           =   $arrVisitorUserData->title;
        }
        $data['txtTitle']       =   $txtTitle;


        #### pixel fire ###
        //$flagTYVisit        = PixelFire::getPixelFireStatus("TY",$intVisitorId);
        $flagTYVisit        = $this->pixelfireRepo->getPixelFireStatus("TY",$intVisitorId);
        if (!$flagTYVisit) {
            //PixelFire::SetPixelFireStatus("TY",$intVisitorId,$intUserId);
            $this->pixelfireRepo->SetPixelFireStatus("TY",$intVisitorId,$intUserId);
        }
        
        $split_info             = Visitor::join('split_info','visitors.split_id',"=",'split_info.id')
                                                ->where('visitors.id',$request->visitor_id)
                                                ->select('split_info.split_path','split_info.split_name')
                                                ->first();
        $splitName             = "";
        if(isset($split_info))
        {
            $splitName             = $split_info->split_name; 
        }
        
        $anaylzeEndPage        =   $this->redirectInterface->redirectToThankyouPage('web/analyze-end',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,"isQualified"=>$isQualified));

        return view('splits.analyzing_request',compact('data','resourcePath','splitName','anaylzeEndPage'));
    }

    public function analyzeEndPage( Request $request )
    {
        $intVisitorId           =   $request->visitor_id;
        $intUserId              =   $request->user_id;
        //$isQualified            =   $request->is_qualified;
        
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

                if ( isset($response['url']) && $response['url']) {
                    header("Location: " . $response['url']);
                    die;
                }
            } else {
                //User::whereId($intUserId)->update(array('is_qualified'=> 0));

                $msgstr="Unfortunately, your vehicle does not match the criteria for us to proceed at this time.";             
                $this->redirectInterface->redirectToThankyouUnqualifiedPage('web/thankyou-unqualified',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,'msgstr'=>$msgstr));
            }
        }
    }
}
