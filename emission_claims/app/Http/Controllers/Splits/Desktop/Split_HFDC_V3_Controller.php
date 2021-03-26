<?php

namespace App\Http\Controllers\Splits\Desktop;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CommonSplitsInterface;
use App\Models\Questionnaire;
use App\Repositories\Interfaces\CommonFunctionsInterface;
use App\Repositories\Interfaces\ValidationInterface;
use App\Repositories\Interfaces\RedirectInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\VisitorInterface;
use App\Http\Requests\Split_HFDC_V2;
use App\Models\User;
use Exception;


class Split_HFDC_V3_Controller extends Controller
{

    public function __construct(RedirectInterface $redirectInterface, VisitorInterface $visitorRepo,ValidationInterface $validationRepo,CommonFunctionsInterface $commonFunctionRepo, UserInterface $userRepo)
    {
        $this->userRepo             = $userRepo;        
        $this->validationInterface  = $validationRepo;
        $this->redirectInterface    = $redirectInterface;
        $this->visitorRepo          = $visitorRepo;
        $this->commonFunctionRepo   = $commonFunctionRepo;
    }

    public function index( Request $request ,CommonSplitsInterface $commonsplit )
    { 
        $splitName              = 'HFDC_V3.php';
        $split_name             = str_replace('.php','',$splitName);        
        $initData               = $commonsplit->initSplit( $request,$splitName );
        $intVisitorId           = $initData['intVisitorId'];
        $resourcePath           = asset('assets/'.$split_name).'/';
        $actionpage             = route('Split_'.$split_name.'.store');
        $data['title']          = 'Hausfeld';
        $data['APP_URL']        = env('APP_URL');
        $data['intVisitorId']   = $intVisitorId;
        $data['titles']         = config('constants.title_array');
        $data['months']         = config('constants.month_array');
        $data['vehicle_class']  = config('constants.vehicle_class');
        $data['strFileName']    = $splitName;
        $questionnaires         = Questionnaire::where('type','=','questionnaire0')
                                    ->with('options')
                                    ->get();
                                    
        if($questionnaires->count() >0) {
            foreach ($questionnaires as $key=>$questionnaire) {
                $data['questionnaires'][$key+1] = array(
                                                    'id'=>$questionnaire->id,
                                                    'title'=>$questionnaire->title,
                                                    'options' => $questionnaire->options
                                                ); 
            }
        }
        if($request->pid) {
            $pid                = $request->pid;
        } else {
            $pid                = '';
        }

        return view('splits.web.'.$split_name.'.index', compact('data', 'resourcePath', 'actionpage', 'pid' ));
    
    }

    public function store( Split_HFDC_V2 $request, UserInterface $userRepo)
    { 
        $recordStatus       = $this->commonFunctionRepo->isTestLiveEmail( $request->txtEmail );
        $intVisitorId       = $request->visitor_id;
        //Check to avoid duplicate record insertion
        if ( $recordStatus == 'LIVE' ) {

            $arrUniqueParams            = array();
            $arrUniqueParams['email']   = $request->txtEmail;
            $arrUniqueParams['phone']   = $request->txtPhone;
            $arrUniqueParams['fName']   = $request->txtFName;
            $arrUniqueParams['lName']   = $request->txtLName;

            $strUniqueError             = $this->validationInterface->validateRecordUniqueness( $arrUniqueParams );
            if ( !$strUniqueError ) {
                $arrUrlParams           = array(
                    'visitor_id' => $intVisitorId,
                    'user_email' => $request->txtEmail
                );
                //redirected to thankyou page
                //$this->redirectInterface->autoRedirect( 'web/thankyou-unqualified', $arrUrlParams );
                $this->redirectInterface->autoRedirect( 'web/thankyou-error', $arrUrlParams );
            }
        }
        
        $arrResponse    = $this->userRepo->storeUser( $request,$recordStatus );
        
         //add user id to input array
        $intUserId = $arrResponse['userId'];

        //add user car details user_vehicle_details for lp input
        $carRegNo         =   $request->carRegNo;
        $intVisitorId     =   $request->visitor_id;
      
        // $UpdateCarDetails    = $this->userRepo->UpdateUserCarDetails($intUserId, $intVisitorId, $carRegNo);

        //Get tax payer
        $taxPayer = $userRepo->getTaxPayer($intUserId);

        $tax_payer_arr = array('user_id'=> $intUserId,'tax_payer'=>$taxPayer);

        //Insert into tax payer table
        //$userRepo->addTaxPayer($tax_payer_arr);
        
        $addToHistory   = $userRepo->storeHistory($intUserId);

        $intResult      =   $arrResponse['result'];
        $strResultFlag  =   $arrResponse['flag'];
        $strResultMsg   =   $arrResponse['msg'];
        $intUserId      =   $arrResponse['userId'];
        $post_to_cake   =   $arrResponse['post_to_cake'];
        $isQualified    =   $arrResponse['isQualified'];

        $intVisitorId   =   $request->visitor_id;
        if ( $intUserId == 0 ) {
            $strThankyouPage        =   $this->redirectInterface->redirectToThankyouUnqualifiedPage( 'web/thankyou-error', array( 'userId'=>$intUserId, 'visitorId'=>$intVisitorId ) );
            die;
        }

        $fields = "''V.*,T.unique_key','V.campaign', 'V.pid', 'V.adv_redirect_domain', 'V.adv_vis_id'";

        $arrVisitor = $this->visitorRepo->getVisitorUserTransDetails($intVisitorId, $intUserId, $fields);

        //if (!substr_count($arrVisitor->email, "@922.com") && $arrVisitor->ip_address != '81.136.250.93' && $arrVisitor->country != "IN" ) { 
            
            //PostLeadsToCake::dispatch( $intUserId,$recordStatus);
            //queue for cake posting
        //}

        //FB Pixel Fire
        $advRedirectDomain      = ($arrVisitor->adv_redirect_domain)??$arrVisitor->adv_redirect_domain ?? '';
        $adv_vis_id             = ($arrVisitor->adv_vis_id)??$arrVisitor->adv_vis_id ?? '';
        $pid                    = ($arrVisitor->pid)??$arrVisitor->pid ?? '';

        if ($request->carRegNo!=null && $request->idntRemember!=1) {

            //$this->redirectInterface->redirectToSignPage('analyzing_request',array("userId"=>$intUserId,"visitorId"=>$intVisitorId));
            $strThankyouPage        =  env('APP_URL').$this->redirectInterface->redirectToPage('analyzing_request',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,"isQualified"=>$isQualified));

            if (isset($advRedirectDomain) && !empty($advRedirectDomain) && !empty($pid)) { 
                //Define params for FB pixel URL
                $arrPixelUrlParams = array(
                    "type"          => "advvisid", 
                    "adv_vis_id"    => $adv_vis_id,
                    "userId"        => $intUserId,
                    "visitorId"     => $intVisitorId,
                    "pid"           => $pid,
                    "redirect_url"  => $strThankyouPage);

                $strPixelUrl =  $this->commonFunctionRepo->creatURL("https://" . $advRedirectDomain . "/fb-pixel.php", $arrPixelUrlParams);              
                return redirect($strPixelUrl);
            }  else{
                
                $this->redirectInterface->redirectToSignPage('analyzing_request',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,"isQualified"=>$isQualified));
                //$this->redirectInterface->redirectToSignPage('web/thankyou',array("userId"=>$intUserId,"visitorId"=>$intVisitorId));
            }
        } else {

            $strThankyouPage        =  env('APP_URL').$this->redirectInterface->redirectToPage('intermediate_thankyou',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,"isQualified"=>$isQualified));

            if (isset($advRedirectDomain) && !empty($advRedirectDomain) && !empty($pid)) { 
                //Define params for FB pixel URL
                $arrPixelUrlParams = array(
                    "type"          => "advvisid", 
                    "adv_vis_id"    => $adv_vis_id,
                    "userId"        => $intUserId,
                    "visitorId"     => $intVisitorId,
                    "pid"           => $pid,
                    "redirect_url"  => $strThankyouPage);

                $strPixelUrl =  $this->commonFunctionRepo->creatURL("https://" . $advRedirectDomain . "/fb-pixel.php", $arrPixelUrlParams);              
                return redirect($strPixelUrl);
            }  else{

                $this->redirectInterface->redirectToSignPage('intermediate_thankyou',array("userId"=>$intUserId,"visitorId"=>$intVisitorId,"isQualified"=>$isQualified)); 
            }    
        }
    }
}
