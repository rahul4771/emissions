<?php

namespace App\Http\Controllers\Splits;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\Visitor;
use App\Repositories\Interfaces\VisitorInterface;
use App\Repositories\Interfaces\PreviousDetailsInterface;
use App\Repositories\LiveSessionRepository;
use App\Repositories\Interfaces\UAInterface;
use App\Repositories\Interfaces\HistoryInterface;
use App\Repositories\Interfaces\PixelFireInterface;
use App\Repositories\Interfaces\RedirectInterface;
use App\Repositories\Interfaces\UserInterface;


class SignatureController extends Controller
{
    public function __construct(PixelFireInterface $pixelfireRepo, RedirectInterface $redirectInterface,PreviousDetailsInterface $previousDetailsRepo, VisitorInterface $visitorRepo, HistoryInterface $historyInterface, UAInterface $ua)
    {
        $this->pixelfireRepo        = $pixelfireRepo;
        $this->redirectInterface    = $redirectInterface;
        $this->liveSession          = new LiveSessionRepository();
        $this->followHistory        = $historyInterface;
        $this->previousDetailsRepo  = $previousDetailsRepo;
        $this->visitorRepo          = $visitorRepo;
        $this->ua                   = $ua;

    }
    public function index(Request $request, UserInterface $userRepo)
    {
        if (empty($request->visitor_id) || empty($request->user_id) ) {
            return redirect(403);
        } else {
            $intVisitorId   = $request->visitor_id;
            $intUserId      = $request->user_id;
            $split_name     = "";
            if($request->has('split')) {
                $split_name = $request->split;
            }
            //Check tax payer
            $userRepo->checkTaxPayer($intUserId);
        }
        $resourcePath           = asset('assets/signature').'/';
        $data                   = array();
        $data['title']          = 'Hausfeld';
        $data['APP_URL']        = env('APP_URL');
        $data['intVisitorId']   = $intVisitorId;
        $data['intUserId']      = $intUserId;
        $arrUserAgentInfo       =   $this->ua->parse_user_agent();
        $data['device']         =   $arrUserAgentInfo['device'];
        $txtTitle               = '';
        $signature_id           = '';
        $filePath1              = '';
        $is_pdf_sucess          = '';
        $arrVisitorUserData     =  $this->visitorRepo->getVisitorUserTransDetails($intVisitorId,$intUserId);
        if(!empty($arrVisitorUserData)){
            $txtTitle   = $arrVisitorUserData->title;
        }
        $data['txtTitle']       = $txtTitle;
        $actionpage             = route('signature.store');
        if(empty($request->visitor_id) || empty($request->user_id) ){
            return redirect(403);
        }

        $split_name = Visitor::join('split_info', 'visitors.split_id', '=', 'split_info.id')->where('visitors.id','=',$request->visitor_id)->first()->split_name;

        $data['split_name'] = $split_name;


        return view('splits.signature',compact('data','arrVisitorUserData','resourcePath','actionpage'));
    }

    public function store(Request $request)
    {
        if (empty($request->visitor_id) || empty($request->user_id) ) {
            return redirect(403);
        } else {
            $intVisitorId   = $request->visitor_id;
            $intUserId      = $request->user_id;
        } 
        $PreviousArray          = $this->createPreviousArray($request->all());
        $signature_id           = $this->previousDetailsRepo->previousDetailsHandle($PreviousArray);
        // PDF CREATION
        if ($signature_id) {
            $this->liveSession->createUserMilestoneStats(array(
                    "user_id" =>$intUserId,
                    "source" =>'live',
                    "user_signature" =>1,
                )
            );

            $this->pixelfireRepo->SetPixelFireStatus("SN",$intVisitorId,$intUserId);  
            $this->followHistory->insertFollowupLiveHistory(array(
                        "user_id" =>$intUserId,
                        "type" =>'signature',
                        "type_id" =>0,
                        "source" =>'live',
                        "value" =>'1',
                        "post_crm" =>0,
                    )
                );
        }

        $this->liveSession->completedStatusUpdate($intUserId, 'live');

        $this->redirectInterface->redirectToConfirmPageDesktop( 'web.confirm.store', array( 'userId'=>$intUserId, 'visitorId'=>$intVisitorId,'postToCake'=>''));

    }

    public function createPreviousArray($request)
    {
        $previousAray = array (
            'user_id'           => $request['user_id'],
            'visitor_id'        => $request['visitor_id'],
            'previous_name'     => "",
            'signature_data'    => $request['signature_data'],
            'bank_id'           => '0',
            'previous_postcode' =>  @array('0' => $request['previous_postcode_1'], '1' => $request['previous_postcode_2']),
            'previous_address'  => @array('0' => $request['previous_address_1'], '1' => $request['previous_address_2']),
            'previous_address_pk'  => @array('0' => $request['previous_address_1_pk'], '1' => $request['previous_address_2_pk']),
            'previous_address_line1'  => @array('0' => $request['previous_address_1_line1'], '1' => $request['previous_address_2_line1']),
            'previous_address_line2'  => @array('0' => $request['previous_address_1_line2'], '1' => $request['previous_address_2_line2']),
            'previous_address_line3'  => @array('0' => $request['previous_address_1_line3'], '1' => $request['previous_address_2_line3']),
            'previous_address_city'  => @array('0' => $request['previous_address_1_city'], '1' => $request['previous_address_2_city']),
            'previous_address_province'  => @array('0' => $request['previous_address_1_province'], '1' => $request['previous_address_2_province']),
            'previous_address_country'  => @array('0' => $request['previous_address_1_country'], '1' => $request['previous_address_2_country']),
            'previous_address_company'  => @array('0' => $request['previous_address_1_company'], '1' => $request['previous_address_2_company'])
        );

        return $previousAray;
    }
    public function terms()
    {
        $resourcePath           = asset('assets/signature-terms').'/';
        $data                   = array();
        $data['title']          = 'Hausfeld';
        $data['APP_URL']        = env('APP_URL');
        return view('splits.signature-terms',compact('data','resourcePath'));
    }
}
