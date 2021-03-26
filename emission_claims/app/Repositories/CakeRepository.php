<?php

namespace App\Repositories;

use App\Repositories\LogRepository;
use App\Repositories\Interfaces\CakeInterface;
use App\Repositories\CommonFunctionsRepository;
use App\Models\BlacklistedItem;
use App\Models\User;
use App\Models\Visitor;
use App\Models\UserVehicleDetails;
use App\Models\UserQuestionnaireAnswers;
use App\Models\VehicleDataLookup;
use Carbon\Carbon;

class CakeRepository implements CakeInterface
{
    public function __construct()
    {  
        $this->logRepo              = new LogRepository;
        $this->commonFunctionRepo   = new CommonFunctionsRepository;
    }

    public function cakePost($userId, $buyyerId, $userVehicleId = null)
    { 

        $user_data  = User::join('user_extra_details', 'users.id', '=', 'user_extra_details.user_id')
                        ->join('visitors', 'users.visitor_id', '=', 'visitors.id')
                        ->join('user_vehicle_details', 'users.id', '=', 'user_vehicle_details.user_id')
                        ->where('users.id', $userId)
                        ->select('visitors.id as visitor_id', 'user_extra_details.addressid' , 'users.title', 'users.first_name', 'users.last_name', 'users.dob', 'user_extra_details.postcode', 'users.telephone', 'users.email', 'user_extra_details.housenumber', 'user_extra_details.address', 'user_extra_details.street', 'user_extra_details.county', 'user_extra_details.town', 'user_extra_details.gender','user_extra_details.housename', 'user_extra_details.address3', 'user_extra_details.udprn', 'user_extra_details.pz_mailsort', 'user_extra_details.country as user_country', 'user_extra_details.deliverypointsuffix', 'users.recent_visit', 'visitors.country as countryCode', 'users.response_result','visitors.user_agent', 'user_vehicle_details.car_reg_no', 'user_vehicle_details.registration_number')
                        ->first();
        //echo "<pre>"; print_r($user_data);echo "</pre>";

        $user_ques_ans = UserQuestionnaireAnswers::where('user_id', $userId)
                        ->select('questionnaire_id', 'input_answer')
                        ->get();
        //echo "<pre>"; print_r($user_ques_ans);echo "</pre>";                
        $car_reg_num = $user_data->registration_number;

        $car_acquired_date = null; $purchase_type =null;  $joined_another_claim =null;$vehicle_litre =null;
        foreach($user_ques_ans as $ques_ans){
            if($ques_ans->questionnaire_id == 1) {
                $car_acquired_date = $ques_ans->input_answer;
            } elseif($ques_ans->questionnaire_id == 2) {
                $purchase_type = ucfirst(strtolower($ques_ans->input_answer));
            } elseif($ques_ans->questionnaire_id == 3) {
                $joined_another_claim = ucfirst(strtolower($ques_ans->input_answer));
                $vehicle_litre = $joined_another_claim;
            }
        }

        ##car_acquired_date
        //$createdAt = Carbon::parse($car_acquired_date);
        //$carAcquiredDate = $createdAt->format('d-m-Y');

        //echo "carAcquiredDate:-".$carAcquiredDate."   purchase_type:-".$purchase_type."   joined_another_claim:-".$joined_another_claim;
        //echo "++++".$user_data->visitor_id;

        $vehicle_data =  VehicleDataLookup::where('visitor_id', $user_data->visitor_id)
                        ->where( 'status','=','1')
                        ->orderBy('id', 'DESC')
                        ->select('car_reg_no', 'tr_smmt_range','make','engine_number','fuel_type','registration_number','year_of_manufacture', 'ma_vehicle_data' )
                        ->first();
        if(isset($userVehicleId)){
            $vehicle_data =  UserVehicleDetails::select( 'car_reg_no', 'tr_smmt_range','make','engine_number','fuel_type','registration_number','year_of_manufacture', 'ma_vehicle_data' )
                            ->where( 'id', $userVehicleId )
                            ->first();
        }
        //dd($user_ques_ans);

        if(isset($vehicle_data)) {
            $car_reg_num        = $vehicle_data->car_reg_no;
            //$Make               = $vehicle_data->make;
            $MakeModel          = $vehicle_data->tr_smmt_range;
            $FuelType           = $vehicle_data->fuel_type;
            $YearOfManufacture  = $vehicle_data->year_of_manufacture;

            $userVehicleDetailsJSON = json_decode($vehicle_data->ma_vehicle_data,true);
            $Co2Emissions       = $userVehicleDetailsJSON['DataItems']['VehicleRegistration']['Co2Emissions'];
            $Colour             = $userVehicleDetailsJSON['DataItems']['VehicleRegistration']['Colour'];
            $NominalEngineCapacity = $userVehicleDetailsJSON['DataItems']['SmmtDetails']['NominalEngineCapacity'];            
            $vehicle_name       = $userVehicleDetailsJSON['DataItems']['ClassificationDetails']['Smmt']['Make'];
            $Make               = $userVehicleDetailsJSON['DataItems']['ClassificationDetails']['Dvla']['Model'];
        } else {
            $Make               = null;
            $MakeModel          = null;
            $FuelType           = null;
            $YearOfManufacture  = null;
            $Co2Emissions       = null;
            $Colour             = null;
            $NominalEngineCapacity = null;
            $vehicle_name       = null;
        }

        //dd($vehicle_data);
        // if ($vehicle_name=='' && $Make!='') {
        //     $vehicle_name=strtolower($Make);
        // }

        // if (isset($user_data->dob)) {
        //     $arrDob         = explode('-', $user_data->dob);
        //     $strDate        = $arrDob[2];
        //     $strMonth       = $arrDob[1];
        //     $strBirthYear   = $arrDob[0];
        // }

        if ($vehicle_litre=='' && $NominalEngineCapacity!='') {
            if ($NominalEngineCapacity==1.2 || $NominalEngineCapacity==1.6 || $NominalEngineCapacity==2 || $NominalEngineCapacity==2.0) {
                $vehicle_litre='Yes';
            } else {
                $vehicle_litre='No';
            }
        }

        $split_info = Visitor::join('split_info', 'visitors.split_id', '=', 'split_info.id')
                        ->where('visitors.id', $user_data->visitor_id)
                        ->select('split_info.split_path', 'split_info.split_name')
                        ->first();
        $splitName  = '';
        if (isset($split_info)) {
            $splitName  = $split_info->split_name;
        }


        $telephone          = @$user_data->telephone;
        $phone_home         = null;
        $mobile             = null;
        $unique_key         = 'HAUSFELD_'.$user_data->visitor_id;
        $ip_address         = $this->commonFunctionRepo->get_client_ip();
        $dob                = $user_data->dob;
        $address            = $user_data->address;
        $county             = $user_data->county;
        $recent_visit       = $user_data->recent_visit;
        $countryCode        = $user_data->countryCode;
        $response_result    = null;
        $address_id         = $user_data->addressid;
        $address1           = $user_data->address3;

        // $dobday             = $strDate;
        // $dobmonth           = $strMonth;
        // $dobyear            = $strBirthYear;
        $userid             = (String) $userId;
        $arrVTrans          = Visitor::with(['adtopia_visitor', 'thrive_visitor', 'ho_cake_visitor'])
                                ->where('id', $user_data->visitor_id)
                                ->first();
        if (isset($arrVTrans)) {
            if (isset($arrVTrans->ho_cake_visitor)) {
                $aff_id     = $arrVTrans->ho_cake_visitor->aff_id;
                $aff_sub    = $arrVTrans->ho_cake_visitor->aff_sub;
                $offer_id   = $arrVTrans->ho_cake_visitor->offer_id;
            }
            if (isset($arrVTrans->thrive_visitor)) {
                $thr_sub1       = $arrVTrans->thrive_visitor->thr_sub1;
                $thr_source     = $arrVTrans->thrive_visitor->thr_source;
            }
            if (isset($arrVTrans->adtopia_visitor)) {
                $atp_source         = $arrVTrans->adtopia_visitor->atp_source;
                $atp_vendor         = $arrVTrans->adtopia_visitor->atp_vendor;
                $atp_sub1           = $arrVTrans->adtopia_visitor->atp_sub1;
                $atp_sub2           = $arrVTrans->adtopia_visitor->atp_sub2;
                $atp_sub3           = $arrVTrans->adtopia_visitor->atp_sub3;
                $atp_sub4           = $arrVTrans->adtopia_visitor->atp_sub4;
                $atp_sub5           = $arrVTrans->adtopia_visitor->atp_sub5;
            }
            $adv_visitor_id     = $arrVTrans->adv_visitor_id;
            $sub_tracker        = $arrVTrans->sub_tracker;
            $tracker_unique_id  = $arrVTrans->tracker_unique_id;
            $tracker_master_id  = $arrVTrans->tracker_master_id;
            $tid                = $arrVTrans->tid;
            $pid                = $arrVTrans->pid;
            $campaign           = $arrVTrans->campaign;
        } else {
            $tracker_unique_id  = '';
            $aff_id             = '';
            $aff_sub            = '';
            $offer_id           = '';
            $tid                = '';
            $pid                = '';
            $campaign           = '';
            $thr_sub1           = '';
            $thr_source         = '';
            $sub_tracker        = '';
            $atp_source         = '';
            $atp_vendor         = '';
            $arratp_sub4        = '';
            $atp_sub5           = '';
            $adv_visitor_id     = 0;
            $tracker_master_id  = 7;
        }
        //Fetch bank buyer mapping info
        if (@$aff_id == 0) {
            $aff_id = '';
        }
        if (@$aff_sub == 0) {
            $aff_sub = '';
        }
        if (@$offer_id == 0) {
            $offer_id = '';
        }
        if (substr($tid, 0, 2) == 'HO') {
            $tid = $tid;
        } else {
            $tid = '';
        }
        $lenders = '';
        ## ckm_sub_id #####
        $ckm_subid       = $aff_id;
        $ckm_subid_2     = $offer_id;
        $ckm_subid_3     = $tracker_unique_id;
        $ckm_subid_4     = $tid;
        if ($tracker_master_id == '3') {
            $ckm_subid = $thr_sub1;
        } else if ($tracker_master_id == '1') {
            $ckm_subid       = $atp_vendor;
            //vendor
            $ckm_subid_2     = $tracker_master_id;
            //tracker
            $ckm_subid_3     = $tracker_unique_id;
            //pixel id
            $ckm_subid_4     = $atp_source;
            //vendor source
        }
        # ckm_sub_id #####
        if ($tracker_master_id == '1') {
            $ckm_subid_5 = 'atp##'.$atp_source.'##'.$tracker_unique_id;
        } else if (!empty($sub_tracker)) {
            if ($tracker_master_id == '2') {
                $ckm_subid_5 = $sub_tracker . '##*##' . $tracker_unique_id;
            } else if ($tracker_master_id == '3') {
                $ckm_subid_5 = $sub_tracker . '##' . $tracker_unique_id . '##' . $thr_transid;
            } else if ($tracker_master_id == '4') {
                $ckm_subid_5 = $sub_tracker . '##' . $campaign;
            } else if ($tracker_master_id == '5') {
                $ckm_subid_5 = $sub_tracker . '##' . $campaign;
            } else {
                $ckm_subid_5 = $sub_tracker;
            }
        } else {
            $ckm_subid_5 = 'UNKNOWN';
        }
        ## telephone ##
        $str_fistChar   = substr($telephone, 0, 1);
        if ($str_fistChar != 0) {
            $telephone = '0'. @$telephone;
        }
        $str_phone      = @$telephone;
        $strTelephone   = @$telephone;
        $phone_home     = '';
        if ($strTelephone != '') {
            if (substr($strTelephone, 0, 2) != '07') {
                $phone_home = $strTelephone;
            } else {
                $mobile = $strTelephone;
            }
        }
        ## telephone ##
        $Fname_new      = ucfirst(strtolower(@$user_data->first_name));
        $Lname_new      = ucfirst(strtolower(@$user_data->last_name));

        $arrSubmitData  = array(
                            //Personal Detail
                            'userid'        => @$userid,
                            'title'         => @$user_data->title,
                            'first_name'    => str_replace('&#039;', '`', str_replace("'", '`', stripslashes(@$user_data->first_name))),
                            'last_name'     => str_replace('&#039;', '`', str_replace("'", '`', stripslashes(@$user_data->last_name))),
                            'address1'      => @$user_data->housenumber,
                            //'housenumber'   => @$user_data->housenumber,
                            //'housename'     => @$user_data->housename,
                            'house_name'    => @$user_data->housename,
                            'county'        => @$user_data->county,
                            'city'          => @$user_data->town,
                            'town'          => @$user_data->town,
                            'street'        => @$user_data->street,
                            'address2'      => @$user_data->street,
                            'address3'      => @$user_data->address3,
                            'udprn'         => @$user_data->udprn,
                            'msc'           => @$user_data->pz_mailsort,
                            'dps'           => @$user_data->deliverypointsuffix,
                            'postcode'      => @$user_data->postcode,
                            'email_address' => @$user_data->email,
                            'phone_home'    => @$phone_home,
                            'mobile'        => @$mobile,
                            'phone'         => @$str_phone,
                            'Fname'         => str_replace('&#039;', '`', str_replace("'", '`', stripslashes($Fname_new))),
                            'Lname'         => str_replace('&#039;', '`', str_replace("'", '`', stripslashes($Lname_new))),
                            //'organisation'  => @$user_data->housename,
                            'ip_address'    => @$ip_address,
                            'country'       => @$user_data->user_country,
                            'Contry'        => @$user_data->user_country,
                            //'contact_time'  => date('d/m/Y H:i:s'),
                            'dob'           => $dob, //20 MAY 1988
                            //'DOB_LT'        => $this->commonFunctionRepo->changeDateFormat('d F Y', $dob),  //20 MAY 1988
                            //'DOB_TCH'       => $this->commonFunctionRepo->changeDateFormat('d/m/Y', $dob),  //20/05/1988
                            'affiliate_id'  => $aff_id, //ad_group
                            'aff_sub'       => $aff_sub, //keyword
                            'offer_id'      => $offer_id, //offer_id
                            'transid'       => $tracker_unique_id,
                            'campaign'      => $campaign,
                            'ckm_subid'     => $ckm_subid,
                            'ckm_subid_2'   => $ckm_subid_2,
                            'ckm_subid_3'   => $ckm_subid_3,
                            'ckm_subid_4'   => $ckm_subid_4,
                            'ckm_subid_5'   => $ckm_subid_5,
                            //'dob_day'       => ltrim($dobday, "0"),
                            //'dob_month'     => ltrim($dobmonth, "0"),
                            //'dob_year'      => @$dobyear,
                            //'unique_key'    => @$unique_key,
                            'split_id'      => @$splitName,
                            'domain_name'   => env('CAKE_API_URL', 'mbemissionsclaim.co.uk'),
                            'publisher_name'=> @$atp_sub4,
                            'publisher_url' => @$atp_sub5,
                            'vender'        => @$atp_vendor,
                            'vendor'        => @$atp_vendor,
                            'vendor_source' => @$atp_source,
                            //'product'       => 'postphone',
                            //'sign_status'   => 'Normal',
                            //'gender'        => $user_data->gender,
                            //'funeral_type'  => $user_data->funeral_type, //for this split only
                            'user_agent'    => $user_data->user_agent,
                            'reg_number'    => @$car_reg_num,
                            'vehicle_name'  => @$vehicle_name,
                            'co2emission'   => @$Co2Emissions,
                            'colour'        => @$Colour,
                            'fueltype'      => @$FuelType,
                            'model'          => @$Make,
                            'yearofmanufacture'  => @$YearOfManufacture,
                            'purchase_type'     => @$purchase_type,
                            'another_claim'     => @$joined_another_claim,
                            //'acquire_date'      => @$carAcquiredDate,
                            //'vehicle_litre'     => @$vehicle_litre                            
                        );
    
        //dd($arrSubmitData);
        
        $num                = '000';
        $strParam           = http_build_query($arrSubmitData);
        $strParam           = str_ireplace('%5C%27', '%27', $strParam);
        $strPostUrl         = 'http://thopecive.org/d.ashx';
        $strPostUrlField    = '';
      //  $ip_address         = $ip_address;
        if (substr_count($user_data->email, '@922.com') || $ip_address == '81.136.250.93' || $countryCode == 'IN') {
            $num                    .= '111';
            $strPostUrlField        .= 'ckm_test=1&';
            $strPostUrlField        .= 'ckm_campaign_id=' .config('constants.CAKE_CAMPAIGN_ID_TEST').'&ckm_key='.config('constants.CAKE_CKM_KEY_TEST').'&'.$strParam;
            $arrPixelResultDetail   = $this->commonFunctionRepo->fileGetContent($strPostUrl, 'cake_posting_test', 'post', $strPostUrlField);
            $strPixelResult         = $arrPixelResultDetail['result'];
            $response               = $arrPixelResultDetail['result_detail'];
            $arrResult              = $this->commonFunctionRepo->convertXmlToArray($response);
        } else if (substr_count($user_data->email, '@911.com')) {
            $num        .= '222';
            $arrResult  = array(
                                    'code'      => '0',
                                    'msg'       => 'success',
                                    'leadid'    => 'TEST010',
                                    'price'     => '1.00',
                                    'redirect'  =>  env('APP_URL') . 'affiliate-pixel.php?offer_id=' . $offer_id . '&transaction_id=' . $transid
                                );
            //dd(config('constants.CAKE_CAMPAIGN_ID_TEST'));
        } else {
            $num            .= '333';
          //  $ip_address     = $ip_address;
            $StrEmail       = $user_data->email;
            $Strtelephone   = $telephone;
            $arrInfo        = BlacklistedItem::whereIn('bi_value', [$StrEmail, $ip_address])
                                ->select('bi_value')
                                ->first();
            if ($arrInfo) {
                $num                .= '-657-';
                $strPostUrlField    .= 'ckm_test=1&';
                $strPostUrlField    .= 'ckm_campaign_id=' . config('constants.CAKE_CAMPAIGN_ID_TEST') . '&ckm_key=' . config('constants.CAKE_CKM_KEY_TEST') . '&' . $strParam;
            } else {
                $num                .= '-805-';
                $strPostUrlField    .= 'ckm_campaign_id=' . config('constants.CAKE_CAMPAIGN_ID') . '&ckm_key=' . config('constants.CAKE_CKM_KEY') . '&' . $strParam;
            }
            $arrPixelResultDetail   = $this->commonFunctionRepo->fileGetContent($strPostUrl, 'cake_posting_live', 'post', $strPostUrlField);
            $strPixelResult         = $arrPixelResultDetail['result'];
            $response               = $arrPixelResultDetail['result_detail'];
            $arrResult              = $this->commonFunctionRepo->convertXmlToArray($response);
        }
        $strPostUrl     .= '?' . $strPostUrlField;
        $intResult      = $arrResult['code'];
        $strResult      = ucfirst($arrResult['msg']);
        $intLeadValue   = '0';
        $strLeadId      = '';
        if ($strResult == 'Success') {
            $num             .= '444';
            $strLeadId       = $arrResult['leadid'];
            $intLeadValue    = $arrResult['price'];
        }
        if ($strResult != 'Success' && $strResult != 'Error') {
            $num         .= '555';
            $strResult   = 'Other';
        }
        $arrReturn      = array(
                                    'result'            => $strResult,
                                    'result_detail'     => $arrResult,
                                    'lead_id'           => $strLeadId,
                                    'lead_value'        => $intLeadValue,
                                    'posting_param'     => $strPostUrl,
                                    'posting_response'  => serialize($arrResult)
                                );
        // Write the contents back to the file
        $strLogContent  = '\n----------\n Date: ' . date('Y-m-d H:i:s') . "\n URL: $strPostUrl \n Result: " . serialize($arrResult) . ' \n Num : ' . $num . ' \n Submitted Data: ' . serialize($arrSubmitData) . '\n';
        //Function call for write log
        // MAIN::writeLog('fnPushDataToPpiCake', $strLogContent);
        $logWrite       = $this->logRepo->writeLog('-fnPushDataToPpiCake', $strPostUrl);

        return $arrReturn;
    }
}
