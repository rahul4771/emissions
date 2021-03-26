<?php

namespace App\Repositories;

use App\Models\SiteFlagMaster;
use App\Models\Visitor;
use App\Models\VisitorsCount;
use App\Models\VisitorsLastVisit;
use App\Models\AdtopiaVisitor;
use App\Models\HoCakeVisitor;
use App\Models\ThriveVisitor;
use App\Models\VisitorsJourney;
use App\Models\VisitorsExtraDetail;
use App\Models\User;
use App\Models\UserExtraDetail;
use App\Models\UsersTransaction;
use App\Models\JointAccountDetails;
use App\Models\DomainDetail;
use DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use App\Repositories\CommonFunctionsRepository;
use App\Repositories\Interfaces\VisitorInterface;
use App\Models\SplitInfo;

class VisitorRepository extends CommonSplitsRepository implements VisitorInterface
{
	public function __construct() 
    {
        $this->commonFunctionRepo = new CommonFunctionsRepository;
    }
	public function saveVisitor($arrParam)
	{

		$strFileName 		= $arrParam['file_name'];
		$splitPath			= $arrParam['split_path'];
		$strAffiliate 		= $arrParam['affiliate_id'];
		$strTransid 		= $arrParam['transid'];
		$strScrResolution 	= $arrParam['scr_resolution'];
		$countryCode 		= $arrParam['country'];
		$device	            = $arrParam['site_flag_id'];
		$strBrowserType 	= $arrParam['browser'];
		$strDeviceType 		= $arrParam['platform'];
		$intSiteFlagId 		= $arrParam['site_flag'];
		$intAffId 			= $arrParam['aff_id'];
		$intAffSub 			= $arrParam['aff_sub'];
		$strOfferId 		= $arrParam['offer_id'];
		$aff_sub2 			= $arrParam['aff_sub2'];
		$aff_sub3 			= $arrParam['aff_sub3'];
		$aff_sub4 			= $arrParam['aff_sub4'];
		$aff_sub5 			= $arrParam['aff_sub5'];
		$strCampaign 		= ($arrParam['campaign'] != "") ? $arrParam['campaign'] : "";
		$source 			= ($arrParam['source'] != "") ? $arrParam['source'] : "";
		$tid 				= ($arrParam['tid'] != "") ? $arrParam['tid'] : "";
		$pid 				= ($arrParam['pid'] != "") ? $arrParam['pid'] : "";
		$thr_source 		= ($arrParam['thr_source'] != "") ? $arrParam['thr_source'] : "";
		$thr_transid 		= ($arrParam['thr_transid'] != "") ? $arrParam['thr_transid'] : "";
		$thr_sub1 			= ($arrParam['thr_sub1'] != "") ? $arrParam['thr_sub1'] : "";
		$thr_sub2 			= ($arrParam['thr_sub2'] != "") ? $arrParam['thr_sub2'] : "";
		$thr_sub3 			= ($arrParam['thr_sub3'] != "") ? $arrParam['thr_sub3'] : "";
		$thr_sub4 			= ($arrParam['thr_sub4'] != "") ? $arrParam['thr_sub4'] : "";
		$thr_sub5 			= ($arrParam['thr_sub5'] != "") ? $arrParam['thr_sub5'] : "";
		$thr_sub6 			= ($arrParam['thr_sub6'] != "") ? $arrParam['thr_sub6'] : "";
		$thr_sub7 			= ($arrParam['thr_sub7'] != "") ? $arrParam['thr_sub7'] : "";
		$thr_sub8 			= ($arrParam['thr_sub8'] != "") ? $arrParam['thr_sub8'] : "";
		$thr_sub9 			= ($arrParam['thr_sub9'] != "") ? $arrParam['thr_sub9'] : "";
		$thr_sub10 			= ($arrParam['thr_sub10'] != "") ? $arrParam['thr_sub10'] : "";
		$pixel 				= ($arrParam['pixel'] != "") ? $arrParam['pixel'] : "";
		$tracker 			= ($arrParam['tracker'] != "") ? $arrParam['tracker'] : "";
		$atp_source 		= ($arrParam['atp_source'] != "") ? $arrParam['atp_source'] : "";
		$atp_vendor 		= ($arrParam['atp_vendor'] != "") ? $arrParam['atp_vendor'] : "";
		$atp_sub1 			= ($arrParam['atp_sub1'] != "") ? $arrParam['atp_sub1'] : "";
		$atp_sub2 			= ($arrParam['atp_sub2'] != "") ? $arrParam['atp_sub2'] : "";
		$atp_sub3 			= ($arrParam['atp_sub3'] != "") ? $arrParam['atp_sub3'] : "";
		$atp_sub4 			= ($arrParam['atp_sub4'] != "") ? $arrParam['atp_sub4'] : "";
		$atp_sub5 			= ($arrParam['atp_sub5'] != "") ? $arrParam['atp_sub5'] : "";
		$adv_vis_id 		= ($arrParam['adv_vis_id'] != "") ? $arrParam['adv_vis_id'] : "0";
		$adv_page_name 		= ($arrParam['adv_page'] != "") ? $arrParam['adv_page'] : "";
		$adv_redirect_domain = ($arrParam['redirectDomain'] != "") ? $arrParam['redirectDomain'] : "";
		## extra parameter ##
		$ext_var1       	= ($arrParam['ext_var1'] != "") ? $arrParam['ext_var1'] : "";//vendorclik
		$ext_var2       	= ($arrParam['ext_var2'] != "") ? $arrParam['ext_var2'] : "";
		$ext_var3       	= ($arrParam['ext_var3'] != "") ? $arrParam['ext_var3'] : "";
		$ext_var4       	= ($arrParam['ext_var4'] != "") ? $arrParam['ext_var4'] : "";
		$ext_var5       	= ($arrParam['ext_var5'] != "") ? $arrParam['ext_var5'] : "";
        ## extra parameter ##
        $tracker_type = $this->defineTrackerType($arrParam);
        //Redefine tracker if tracker value become empty
        if (empty($tracker)) {
        	if ($tracker_type == 2) {
        		$tracker = "HO";
        	} else if ($tracker_type == 3) {
        		$tracker = "THRIVE";
        	} else if (substr($tracker_type, 0, 2) == 'FB') {
        		$tracker = "FB";
        	} else if ($tracker_type == 5) {
        		$tracker = "GOOGLE";
        	}
        }

        parent::dynamicSplitAdd($strFileName,$splitPath);
        if ($intAffId == '') {
        	$intAffId = 0;
        }
        if ($intAffSub == '') {
        	$intAffSub = 0;
        }
        if ($strOfferId == '') {
        	$strOfferId = 0;
        }
        if (empty($strBrowserType)) {
        	$strBrowserType = 'Unknown Browser';
        }
        if ($strDeviceType == '' || $strDeviceType == NULL) {
        	$strDeviceType = 'BOT';
        }
        if ($tracker_type == 3) {
        	$intAffId  = $thr_sub1;
        }
        //Function call for check whether pixel is added with given details
        if (is_numeric($strOfferId)) {
        	$intTempAffId 	=	$this->commonFunctionRepo->checkAffiliatePixel($strCampaign, $arrParam['aff_id'], $strOfferId);
        	if (empty($strAffiliate)) {
        		$strAffiliate = $intTempAffId;
        	}
        }
        //get site flag
        $siteFlagMaster			=	SiteFlagMaster::select('id')
        								->where('site_flag_name','=',$device)
        								->first();
        if (!empty($siteFlagMaster)) {
        	$intSiteFlagId 		=	$siteFlagMaster->id;
        }
        $intSplitId  			=	parent::getSplitIdFromName($strFileName, $intSiteFlagId);
        $u_agent 				=	isset($_SERVER['HTTP_USER_AGENT']) ? $_SERVER['HTTP_USER_AGENT'] : "";
		$strIp 					=	$this->commonFunctionRepo->get_client_ip();
		$visitor 				=	Visitor::select('id')
										->whereDate('created_at','=',Carbon::now()->toDateString())
										->where('ip_address','=',$strIp)
										->where('browser_type','=',$strBrowserType)
										->where('country','=',$countryCode)
										->where('split_id','=',$intSplitId)
										->where('tracker_master_id','=',$tracker_type)
										->where('site_flag_id','=',$intSiteFlagId);
		if ($tracker_type == 1) {
			$tracker_unique_id 	=	$pixel;
		} else if ($tracker_type == 2) {
			$tracker_unique_id 	=	$strTransid;
			$visitor 	=	$visitor->where('affiliate_id','=',$strAffiliate);
		} else if ($tracker_type == 3) {
			$tracker_unique_id 	=	$thr_transid;
		} else if ($tracker_type == 7) {
			$tracker_unique_id 	=	0;
			$visitor 			=	$visitor->where('campaign','=',$strCampaign);
		} else {
			$tracker_unique_id 	=	$strTransid;
			$visitor 			=	$visitor->where('affiliate_id','=',$strAffiliate);
		}
		$visitor 				=	$visitor->where('tracker_unique_id','=',$tracker_unique_id)
									->first();
		if (!empty($visitor)) {
			$intVisitorId 		=	$visitor->id;
			$visitorsCount 		=	VisitorsCount::select(DB::raw('count(visitor_id) as cnt'))
										->where('visitor_id','=',$intVisitorId)
										->where('split_id','=',$intSplitId)
										->first();
			if (!empty($visitorsCount)) {
				$vCount 		=	(int) $visitorsCount->cnt+1;
				$visitorsCount->update(array('count'=>$vCount));
				VisitorsLastVisit::where('visitor_id','=',$intVisitorId)
									->update(array('last_visit_page'=>$strFileName));
			} else {
				$objVisitorsCount 	=	new VisitorsCount;
				$objVisitorsCount->visitor_id 	=	$intVisitorId;
				$objVisitorsCount->count 		=	1;
				$objVisitorsCount->split_id 	=	$intSplitId;
				VisitorsLastVisit::where('visitor_id','=',$intVisitorId)
									->update(array('last_visit_page'=>$strFileName));
			}
		} else {
			$fullReferenceUrl		=	URL::full();
			$strExistingDomain 		=	env('APP_URL');
			if ($strExistingDomain == "") {
				$strExistingDomain 	=	$_SERVER['SERVER_NAME'];
			}
			$strRefererSite 		=	isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : "";
			$objVisitor 					=	new Visitor;
			$objVisitor->ip_address 		=	$strIp;
			$objVisitor->browser_type 		=	$strBrowserType;
			$objVisitor->country 			=	$countryCode;
			$objVisitor->referer_site 		=	$strRefererSite;
			$objVisitor->existing_domain 	=	$strExistingDomain;
			$objVisitor->full_reference_url =	$fullReferenceUrl;
			$objVisitor->resolution 		=	$strScrResolution;
			$objVisitor->device_type 		=	$strDeviceType;
			$objVisitor->user_agent 		=	$u_agent;
			$objVisitor->affiliate_id 		=	$strAffiliate;
			$objVisitor->tracker_unique_id  =	$tracker_unique_id;
			$objVisitor->site_flag_id 		=	$intSiteFlagId;
			$objVisitor->campaign 			=	$strCampaign;
			$objVisitor->source 			=	$source;
			$objVisitor->tid 				=	$tid;
			$objVisitor->tracker_master_id 	=	$tracker_type;
			$objVisitor->sub_tracker 		=	$tracker;
			$objVisitor->pid 				=	$pid;
			$objVisitor->adv_visitor_id 	=	$adv_vis_id;
			$objVisitor->adv_page_name	 	=	$adv_page_name;
			$objVisitor->split_id 			=	$intSplitId;
			$objVisitor->adv_redirect_domain=	$adv_redirect_domain;
			$objVisitor->save();
			$intVisitorId 					=	$objVisitor->id;
			if ($intVisitorId > 0) {
				if ($tracker_type == 1) {
					$objAdtopiaVisitor 				=	new AdtopiaVisitor;
					$objAdtopiaVisitor->visitor_id 	=	$intVisitorId;
					$objAdtopiaVisitor->atp_source 	=	$atp_source;
					$objAdtopiaVisitor->atp_vendor 	=	$atp_vendor;
					$objAdtopiaVisitor->atp_sub1	=	$atp_sub1;
					$objAdtopiaVisitor->atp_sub2 	=	$atp_sub2;
					$objAdtopiaVisitor->atp_sub3 	=	$atp_sub3;
					$objAdtopiaVisitor->atp_sub4 	=	$atp_sub4;
					$objAdtopiaVisitor->atp_sub5	=	$atp_sub5;
					$objAdtopiaVisitor->save();
				} else if ($tracker_type == 3) {
					$objThriveVisitor 				=	new ThriveVisitor;
					$objThriveVisitor->visitor_id 	=	$intVisitorId;
					$objThriveVisitor->thr_source	=	$thr_source;
					$objThriveVisitor->thr_sub1 	=	$thr_sub1;
					$objThriveVisitor->thr_sub2 	=	$thr_sub2;
					$objThriveVisitor->thr_sub3 	=	$thr_sub3;
					$objThriveVisitor->thr_sub4 	=	$thr_sub4;
					$objThriveVisitor->thr_sub5 	=	$thr_sub5;
					$objThriveVisitor->thr_sub6 	=	$thr_sub6;
					$objThriveVisitor->thr_sub7 	=	$thr_sub7;
					$objThriveVisitor->thr_sub8 	=	$thr_sub8;
					$objThriveVisitor->thr_sub9 	=	$thr_sub9;
					$objThriveVisitor->thr_sub10 	=	$thr_sub10;
					$objThriveVisitor->save();
				} else if ($tracker_type == 2) {
					$objHoCakeVisitor 				=	new HoCakeVisitor;
					$objHoCakeVisitor->visitor_id 	=	$intVisitorId;
					$objHoCakeVisitor->aff_id 		=	$intAffId;
					$objHoCakeVisitor->aff_sub 		=	$intAffSub;
					$objHoCakeVisitor->offer_id 	=	$strOfferId;
					$objHoCakeVisitor->aff_sub2 	=	$aff_sub2;
					$objHoCakeVisitor->aff_sub3 	=	$aff_sub3;
					$objHoCakeVisitor->aff_sub4 	=	$aff_sub4;
					$objHoCakeVisitor->aff_sub5 	=	$aff_sub5;
					$objHoCakeVisitor->save();
				}
				$objVisitorsCount 					=	new VisitorsCount;
				$objVisitorsCount->visitor_id 		=	$intVisitorId;
				$objVisitorsCount->count 			=	1;
				$objVisitorsCount->split_id 		=	$intSplitId;
				$objVisitorsCount->save();

				$objVisitorsLastVisit 				=	new VisitorsLastVisit;
				$objVisitorsLastVisit->visitor_id 	=	$intVisitorId;
				$objVisitorsLastVisit->last_visit_page=	$strFileName;
				$objVisitorsLastVisit->save();

				$objVisitorsPixelFiring 			=	new VisitorsJourney;
				$objVisitorsPixelFiring->visitor_id =	$intVisitorId;
				$objVisitorsPixelFiring->save();
		        ## insert extra parameter ##
		    	if($ext_var1!="" || $ext_var2 !="" || $ext_var3!="" || $ext_var4!="" || $ext_var5!="" || $strFileName!="") {
		    		$objVisitorsExtraDetail 			=	new VisitorsExtraDetail;
		    		$objVisitorsExtraDetail->visitor_id =	$intVisitorId;
		    		$objVisitorsExtraDetail->ext_var1	=	$ext_var1;
		    		$objVisitorsExtraDetail->ext_var2	=	$ext_var2;
		    		$objVisitorsExtraDetail->ext_var3 	=	$ext_var3;
		    		$objVisitorsExtraDetail->ext_var4	=	$ext_var4;
		    		$objVisitorsExtraDetail->ext_var5 	=	$ext_var5;
		    		$objVisitorsExtraDetail->split_id	=	$intSplitId;
		    	}
                ## insert extra parameter ##
		    }
		}
		//return $intVisitorId;
		return array('tracker_type'=>$tracker_type,'visitor_id'=>$intVisitorId);
	}

	public function defineTrackerType($arrParam)
	{
		//1.ADTOPIA,2.HO,3.THRIVE,4.FB,5.GDT,6.Direct,7.UN_KNOWN
		if (isset($arrParam['pixel']) && !empty($arrParam['pixel'])) {
	        //$tracker_type = "ADTOPIA";
			$tracker_type = 1;
		} else if (isset($arrParam['thr_source']) && !empty($arrParam['thr_source'])) {
		        //$tracker_type = "THRIVE";
				$tracker_type = 3;
		} else if (substr($arrParam['campaign'], 0, 2) == 'FB') {
			$tracker_type = $arrParam['campaign'];
		} else if ($arrParam['campaign'] == 'GDT') {
	        //$tracker_type = "GDT";
			$tracker_type = 5;
		} else if (!empty($arrParam['transid'])) {
	        //$tracker_type = "HO";
			$tracker_type = 2;
		} else if ($arrParam['tracker'] == 'Direct') {
	        //$tracker_type = "Direct";
			$tracker_type = 6;
		} else {
	        //$tracker_type = "UN_KNOWN";
			$tracker_type = 7;
		}
		return $tracker_type;
	}

	public function getVisitorUserTransDetails($intVisitorId, $intUserId, $sqlField = '')
	{
		
		$recSet 		=	DB::table('visitors AS V')
								->leftJoin('users AS U','V.id','=','U.visitor_id')
								->leftJoin('buyer_api_responses','U.id','=','buyer_api_responses.user_id')
								->leftJoin('buyer_api_response_details','buyer_api_responses.id','=','buyer_api_response_details.buyer_api_response_id')
								->leftJoin('user_extra_details','U.id','=','user_extra_details.user_id')
								->leftJoin('users','U.id','=','users.id');
								

								
		if ($sqlField == ''){ 
		
			$recSet->select('V.ip_address','V.campaign','V.tracker_master_id',
								   'V.sub_tracker','U.created_at',
								   'U.title','U.first_name', 'U.last_name', 'U.email' ,'U.telephone', 'U.dob', 'buyer_api_responses.result','users.record_status', 'buyer_api_response_details.lead_value','buyer_api_responses.lead_id','V.adv_visitor_id','V.pid','V.adv_redirect_domain', 'buyer_api_responses.buyer_id',
								   DB::raw("(" . date("Y") . " - YEAR(STR_TO_DATE(U.dob, '%d/%m/%Y'))) AS dobYearDiff")
								);
		} else {

			$recSet->leftJoin('thrive_visitors AS TV','V.id','=','TV.visitor_id')
				   ->leftJoin('adtopia_visitors AS AV','V.id','=','AV.visitor_id')
				   ->leftJoin('user_extra_details AS UD','U.id','=','UD.user_id')
				   ->leftJoin('ho_cake_visitors AS HV','V.id','=','HV.visitor_id')
				   ->select();
		}

		$arrData		=   $recSet->where('V.id','=',$intVisitorId)
								->where('U.id','=',$intUserId)
								->first($sqlField);
		if (!empty($arrData)) {
			return $arrData;
		} else {
			return $arrData = array();
		}
	}

	public function updateLastVisit($intVisitorId, $strFileName)
	{
		$today_date 	=	date('Y-m-d H:i:s');
		$affectedRows = VisitorsLastVisit::where('visitor_id', '=', $intVisitorId)->update(['last_visit_page' => DB::raw("CONCAT(last_visit_page,'||','$strFileName')"),'updated_at' => $today_date]);

		return $affectedRows;

	}

	public function updateScreenSize($intVisitorId, $resolution)
	{
			$objVisitor 					=	Visitor::find($intVisitorId);
 			$objVisitor->resolution 		=	$resolution;
 			$objVisitor->save();
 			return true;

	}

	// public function dynamicSplitAdd( $strFileName, $splitPath ) {

 //        $strSplitName    = strtolower( $strFileName );
 //        $splitInfo       = SplitInfo::where( 'split_name', 'LIKE', $strSplitName )->first();

 //        if ( !$splitInfo ) {
 //            $domain_name     =  env( 'APP_URL' );
 //            $domain_result   =  DomainDetail::select( 'id', 'type' )
 //            ->where( 'domain_name', '=', $domain_name )
 //            ->first();
 //            if ( !empty( $domain_result ) ) {
 //                $domain_id   =  $domain_result->id;
 //                $domain_type =  $domain_result->type;
 //                if ( $domain_result->type == 'Adv' ) {
 //                    $domain_result->update( array( 'type'=>'Both' ) );
 //                }
 //            } else {
 //                $domainDetail                =  new DomainDetail;
 //                $domainDetail->domain_name   =  $domain_name;
 //                $domainDetail->type          =  'LP';
 //                $domainDetail->last_active_date = Carbon::now();
 //                $domainDetail->save();
 //                $domain_id                   =  $domainDetail->id;
 //            }
 //            $objSplitInfo                    =  new SplitInfo;
 //            $objSplitInfo->domain_id         =  $domain_id;
 //            $objSplitInfo->split_name        =  $strFileName;
 //            $objSplitInfo->split_path        =  $splitPath;
 //            $objSplitInfo->last_active_date =   Carbon::now();
 //            $objSplitInfo->save();

 //            return $objSplitInfo->id;

 //        } else {
 //            return $splitInfo->id;
 //        }
 //    }

 //    public function getSplitIdFromName( $strSplitName, $intSiteFlagId ) {
 //        $intSplitId          =  0;
 //        $splitInfo           =  SplitInfo::select( 'id' )
 //        ->where( 'split_name', '=', $strSplitName )
 //        ->first();
 //        if ( !empty( $splitInfo ) ) {
 //            $intSplitId      =  $splitInfo->id;
 //        }
 //        return $intSplitId;
 //    }
	// public function initSplit($request,$splitName);
	//  public function dynamicSplitAdd( $strFileName, $splitPath );
	//  public function getSplitIdFromName( $strSplitName, $intSiteFlagId );
}
