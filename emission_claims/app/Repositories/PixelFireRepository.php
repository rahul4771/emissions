<?php

namespace App\Repositories;

use App\Models\VisitorsJourney;
use App\Models\AdvPixelFiring;
use App\Models\VendorPixelFiring;
use App\Models\FollowupVendorPixelFiring;
use App\Repositories\Interfaces\PixelFireInterface;
use App\Repositories\CommonFunctionsRepository;

class PixelFireRepository implements PixelFireInterface
{
    public function __construct()
    {
        $this->commonFunctionRepo = new CommonFunctionsRepository;
    }

    public function getPixelFireStatus($pixelType = NULL, $intVisitorId = NULL, $intUserId = NULL)
    {
        if (is_null($pixelType)) {
            $pixelType = 'LP';
        }
        if (empty($intVisitorId)) {
            return false;
        }
        $visitorsPixelFiring = VisitorsJourney::where('visitor_id', '=', $intVisitorId)
                                ->where('page_type', '=', $pixelType)
                                ->select('page_type')
                                ->first();
        if (!empty($visitorsPixelFiring)) {
            return $visitorsPixelFiring->page_type;
        } else {
            return false;
        }
    }

    public function getFollowupPixelFireStatus($pixelType = NULL, $flvvisit_id = NULL)
    {
        if (is_null($pixelType)) {
            $pixelType = 'LP';
        }
        if (empty($flvvisit_id)) {
            return false;
        }
        $followupPixelFiring = FollowupVendorPixelFiring::where('followup_visit_id', '=', $flvvisit_id)
                                ->where('page_type', '=', $pixelType)
                                ->select('page_type')
                                ->first();
        if (!empty($followupPixelFiring)) {
            return $followupPixelFiring->page_type;
        } else {
            return false;
        }
    }

    public function setPixelFireStatus($pixelType = NULL, $intVisitorId = NULL, $intUserId = NULL)
    {
        if (is_null($intVisitorId)) $intVisitorId    = 0;
        if (is_null($intUserId)) $intUserId          = 0;
        if (is_null($pixelType)) $pixelType          = 'LP';
        if (empty($intVisitorId)) {
            return false;
        }
        if ($pixelType == 'LP') {
            $flUp = VisitorsJourney::where('visitor_id', '=', $intVisitorId)->first();
            if (!empty($flUp)) {
                VisitorsJourney::where('visitor_id', '=', $intVisitorId)
                    ->whereNull('page_type')
                    ->update(array('page_type'=>'LP'));
            }
        } else {
            //TY, CN, SN, QP1, QP2
            $flUp               = new VisitorsJourney;
            $flUp->visitor_id   = $intVisitorId;
            $flUp->user_id      = $intUserId;
            $flUp->page_type    = $pixelType;
            $flUp->save();
        }
        if (@$flUp->id) {
            return true;
        } else {
            return false;
        }
    }
    ///////--anvis---add.start
    public function getAdvPixelFireStatus($pixelType = NULL, $intVisitorId = NULL, $intUserId = NULL)
    {
        if (is_null($pixelType)) $pixelType = "AP";
        if (empty($intVisitorId)) {
            return false;
        }
        $visitorsPixelFiring = AdvPixelFiring::where("adv_visitor_id",'=',$intVisitorId)
                                ->where('page_type','=',$pixelType)
                                ->select('page_type')
                                ->first();
        if (!empty($visitorsPixelFiring)) {
            return $visitorsPixelFiring->page_type;
        } else{
            return false;
        }
    }

    public function setAdvPixelFireStatus($pixelType = NULL, $intVisitorId = NULL, $intUserId = NULL)
    {
        if (is_null($intVisitorId)) $intVisitorId    = 0;
        if (is_null($intUserId)) $intUserId          = 0;
        if (is_null($pixelType)) $pixelType          = "AP";
        if (empty($intVisitorId)) {
            return false;
        }
        if ($pixelType=='AP') {
            $flUp       = AdvPixelFiring::where("adv_visitor_id","=",$intVisitorId)->first();
            if (!empty($flUp)) {
                AdvPixelFiring::where("adv_visitor_id","=",$intVisitorId)->update(array("page_type"=>"AP"));
            }
        } else { //TY,CN,SN,QP1,QP2
            $flUp                   = new AdvPixelFiring;
            $flUp->adv_visitor_id   = $intVisitorId;
            $flUp->page_type        = $pixelType;
            $flUp->save();
        }
        if (@$flUp->id) {
            return true;
        } else {
            return false;
        }
    }

    public function updateIntoPixelFireLogAdv($intAdvVisitorId, $dbConn = NULL) 
    {
        //yet to complete
        /*$strFieldName = "page_type, created_at";
        $strCondition = "adv_visitor_id = ".$intAdvVisitorId;
        $this->dbResult->update_db($dbConn, TABLE_ADVERTORIAL_PIXEL_FIRING, $strFieldName, array("Adv", date('Y-m-d H:i:s')), $strCondition);*/
    }
    
    //////--anvis---add.end
    public function atpPixelFire($chkArry)
    {
        extract($chkArry);
        $arrResultDetail['result'] = $arrResultDetail['result_detail'] = $arrResultDetail['adtopiapixel'] = '';
        if (!isset($statusupdate)) {
            $statusupdate = '';
        }
        if ($tracker_type == '1') {
            $arrUrlParams   = array(
                                        'pixel'             => $pixel,
                                        'from'              => $pixel_type,
                                        'domain_visitor'    => $intVisitorId
                                    );
            if ($pixel_type == 'LP') {
                $arrUrlParams['redirecturl']            = $redirecturl;
            } else if ($pixel_type == 'TY') {
                $arrUrlParams['cake_status']            = $cakePostStatus;
                $arrUrlParams['is_test']                = $record_status;
                $arrUrlParams['buyer_id']               = $buyer_id;
                $arrUrlParams['pay_in']                 = $revenue;
                $arrUrlParams['currency']               = $currency;
                $arrUrlParams['vender_pixel_status']    = $intVoluumtrk2PixelFired;
            }
            $appEnv         = env('APP_ENV');
            if (strpos($pixel, '_') !== false) {
                if ($appEnv == 'live') {
                    $adtopiapixel = $this->commonFunctionRepo->creatURL('http://track.adtopia.club/global_pixel.php', $arrUrlParams);
                } elseif ($appEnv == 'pre') {
                    $adtopiapixel = $this->commonFunctionRepo->creatURL('http://pre.track.adtopia.club/global_pixel.php', $arrUrlParams);
                } else {
                    $adtopiapixel = $this->commonFunctionRepo->creatURL('http://dev.track.adtopia.club/global_pixel.php', $arrUrlParams);
                }
                $arrResultDetail    = $this->commonFunctionRepo->fileGetContent($adtopiapixel, 'adtopia_'.$pixel_type.'_curl_info');
                $arrResultDetail['adtopiapixel'] = $adtopiapixel;
            } else {
                if ($atp_vendor == 'facebook') {
                    if ($appEnv == 'live') {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://track.adtopia.club/social_pixel.php', $arrUrlParams);
                    } elseif ($appEnv == 'pre') {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://pre.track.adtopia.club/social_pixel.php', $arrUrlParams);
                    } else {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://dev.track.adtopia.club/social_pixel.php', $arrUrlParams);
                    }
                } else {
                    if ($appEnv == 'live') {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://track.adtopia.club/native_pixel.php', $arrUrlParams);
                    } elseif ($appEnv == 'pre') {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://pre.track.adtopia.club/native_pixel.php', $arrUrlParams);
                    } else {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://dev.track.adtopia.club/native_pixel.php', $arrUrlParams);
                    }
                }
                $arrResultDetail    = $this->commonFunctionRepo->fileGetContent($adtopiapixel, 'adtopia_'.$pixel_type.'_curl_info');
                $arrResultDetail['adtopiapixel'] = $adtopiapixel;
            }
            //else no
        }
        //if tracker = 1
        if ($tracker_type == '1') {
            if ($pixel_type == 'LP') {
                $vpFiringObj                = new VendorPixelFiring();
                $vpFiringObj->visitor_id    = $intVisitorId;
                $vpFiringObj->vendor        = 'adtopia';
                $vpFiringObj->page_type     = $pixel_type;
                $vpFiringObj->pixel_type    = 'web';
                $vpFiringObj->pixel_log     = $arrResultDetail['result_detail'];
                $vpFiringObj->pixel_result  = $arrResultDetail['result'];
                $vpFiringObj->save();
            } else {
                if (!isset($intUserId)) {
                    $intUserId = null;
                }
                $vpFiringObj                = new VendorPixelFiring();
                $vpFiringObj->visitor_id    = $intVisitorId;
                $vpFiringObj->user_id       = @$intUserId;
                $vpFiringObj->vendor        = 'adtopia';
                $vpFiringObj->page_type     = $pixel_type;
                $vpFiringObj->pixel_type    = 'web';
                $vpFiringObj->pixel_log     = $arrResultDetail['result_detail'];
                $vpFiringObj->pixel_result  = $arrResultDetail['result'];
                $vpFiringObj->save();
            }
        }
        ## Update Advertorial Vendor pixel fire status
        if ($statusupdate == 'ADV') {
            Static::setAdvPixelFireStatus($intVisitorId);
        } else if ($statusupdate == 'SPLIT') {
            if (!isset($intUserId)) {
                $intUserId = 0;
            }
            $flagPageVisit = Static::getPixelFireStatus($pixel_type, $intVisitorId);
            if (!$flagPageVisit) {
                Static::setPixelFireStatus($pixel_type, $intVisitorId, $intUserId);
            }
        }
        return $arrResultDetail;
    }

    public function atpFollowupPixelFire($chkArry)
    {
        extract($chkArry);
        $intVisitorId   = $chkArry['intVisitorId'];
        $intUserId      = $chkArry['user_id'];
        $arrResultDetail['result'] = $arrResultDetail['result_detail'] = $arrResultDetail['adtopiapixel'] = '';
        if (!isset($statusupdate)) {
            $statusupdate = '';
        }
        $tracker_type   = '1';
        if ($tracker_type == '1') { 
            $arrUrlParams   = array(
                                        'pixel'             => $pixel,
                                        'from'              => $pixel_type,
                                        'domain_visitor'    => $intVisitorId
                                    );
            if ($pixel_type == 'LP') {
                $arrUrlParams['redirecturl'] = $redirecturl;
            } else if ($pixel_type == 'TY') {
                $arrUrlParams['redirecturl'] = $redirecturl;
            }
            $appEnv         = env('APP_ENV');
            if (strpos($pixel, '_') !== false) {
                if ($appEnv == 'live') {
                    $adtopiapixel = $this->commonFunctionRepo->creatURL('http://track.adtopia.club/global_pixel.php', $arrUrlParams);
                } elseif ($appEnv == 'pre') {
                    $adtopiapixel = $this->commonFunctionRepo->creatURL('http://pre.track.adtopia.club/global_pixel.php', $arrUrlParams);
                } else {
                    $adtopiapixel = $this->commonFunctionRepo->creatURL('http://dev.track.adtopia.club/global_pixel.php', $arrUrlParams);
                }
                $arrResultDetail    = $this->commonFunctionRepo->fileGetContent($adtopiapixel, 'adtopia_'.$pixel_type.'_curl_info');
                $arrResultDetail['adtopiapixel'] = $adtopiapixel;
            } else {
                if ($atp_vendor == 'facebook') {
                    if ($appEnv == 'live') {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://track.adtopia.club/social_pixel.php', $arrUrlParams);
                    } elseif ($appEnv == 'pre') {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://pre.track.adtopia.club/social_pixel.php', $arrUrlParams);
                    } else {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://dev.track.adtopia.club/social_pixel.php', $arrUrlParams);
                    }
                } else {
                    if ($appEnv == 'live') {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://track.adtopia.club/native_pixel.php', $arrUrlParams);
                    } elseif ($appEnv == 'pre') {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://pre.track.adtopia.club/native_pixel.php', $arrUrlParams);
                    } else {
                        $adtopiapixel = $this->commonFunctionRepo->creatURL('http://dev.track.adtopia.club/native_pixel.php', $arrUrlParams);
                    }
                }
                $arrResultDetail    = $this->commonFunctionRepo->fileGetContent($adtopiapixel, 'adtopia_'.$pixel_type.'_curl_info');
                $arrResultDetail['adtopiapixel'] = $adtopiapixel;
            }
            //else no _
        } 
        //if tracker = 1
        if ($tracker_type == '1') {
            if ($pixel_type == 'LP') {
                $vpFiringObj                     = new FollowupVendorPixelFiring();
                $vpFiringObj->visitor_id         = $intVisitorId;
                $vpFiringObj->vendor             = 'adtopia';
                $vpFiringObj->page_type          = 'LP';
                $vpFiringObj->pixel_type         = 'web';
                $vpFiringObj->pixel_log          = $arrResultDetail['result_detail'];
                $vpFiringObj->followup_visit_id  = $flvvisit_id;
                $vpFiringObj->save();
            } else {
                $vpFiringObj                     = new FollowupVendorPixelFiring();
                $vpFiringObj->visitor_id         = $intVisitorId;
                $vpFiringObj->user_id            = $intUserId;
                $vpFiringObj->vendor             = 'adtopia';
                $vpFiringObj->page_type          = $pixel_type;
                $vpFiringObj->pixel_type         = 'web';
                $vpFiringObj->pixel_log          = $arrResultDetail['result_detail'];
                $vpFiringObj->followup_visit_id  = $flvvisit_id;
                $vpFiringObj->save();
            }
        }
        return $arrResultDetail;
    }
}
