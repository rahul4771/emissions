<?php

namespace App\Http\Controllers\Splits\Desktop;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Redirector;
use App\Models\Visitor;
use App\Repositories\Interfaces\PixelFireInterface;
use App\Repositories\Interfaces\RedirectInterface;
use App\Repositories\Interfaces\VisitorInterface;

class ConfirmController extends Controller
{
    public function __construct(PixelFireInterface $pixelfireRepo, RedirectInterface $redirectInterface, VisitorInterface $visitorRepo)
    {
        $this->pixelfireRepo        = $pixelfireRepo;
        $this->redirectInterface    = $redirectInterface;
        $this->visitorRepo          =  $visitorRepo;
    }

    public function index(Request $request)
    { 
        $resourcePath           =   asset('assets/confirm/').'/';
        $data                   =   array();
        $data['title']          =   'Hausfeld';
        $data['APP_URL']        =   env('APP_URL');
        $data['intVisitorId']   =   $request->visitor_id;
        $data['intUserId']      =   $request->user_id;
        $intVisitorId           =   $request->visitor_id;
        $intUserId              =   $request->user_id;
        $txtTitle               =   '';
        $strFileName            =   "Confirmation";
        $this->visitorRepo->updateLastVisit($intVisitorId,$strFileName);

        $fields = "''V.*,T.unique_key','V.campaign', 'V.pid', 'V.adv_redirect_domain', 'V.adv_vis_id'";

        $arrVisitor = $this->visitorRepo->getVisitorUserTransDetails($intVisitorId, $intUserId, $fields);

        $advRedirectDomain      = ($arrVisitor->adv_redirect_domain)??$arrVisitor->adv_redirect_domain ?? '';
        $adv_vis_id             = ($arrVisitor->adv_vis_id)??$arrVisitor->adv_vis_id ?? '';
        $pid                    = ($arrVisitor->pid)??$arrVisitor->pid ?? '';
        $flagCNVisit            =  $this->pixelfireRepo->getPixelFireStatus("CN",$intVisitorId);
       
        $arrVisitorUserData     =  $this->visitorRepo->getVisitorUserTransDetails($intVisitorId,$intUserId);
        if (!empty($arrVisitorUserData)) {
            $txtTitle           =   $arrVisitorUserData->title;
        }
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


        $data['txtTitle']       =   $txtTitle;
        $actionpage             =   route('web.confirm.store');
        $strThankyouPage        =   env('APP_URL').$this->redirectInterface->redirectToThankyouPage('web/thankyou',array("userId"=>$intUserId,"visitorId"=>$intVisitorId));

        if (!$flagCNVisit && isset($advRedirectDomain) && !empty($advRedirectDomain) && !empty($pid)) {
            if (strpos($advRedirectDomain,'http://') === false && strpos($advRedirectDomain,'https://') === false) {
                $advRedirectDomain = env('APP_URL') . $advRedirectDomain;
            } 
        }
        if (!$flagCNVisit) {
            $this->pixelfireRepo->SetPixelFireStatus("CN",$intVisitorId,$intUserId);
        }
        
        return view('splits.web.confirm',compact('data','resourcePath','actionpage','strThankyouPage','splitName'));
    }


}
