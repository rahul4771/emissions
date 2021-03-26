<?php

namespace App\Repositories;

use App\Repositories\Interfaces\FollowupInterface;
use App\Models\User;
// use App\Models\UserQuestionnaireAnswers;
// use App\Models\UserBank;
// use App\Models\Signature;

class FollowupRepository implements FollowupInterface
{
    public function getFollowupUserTransDetails($atp_sub2, $sqlField = '')
    {
        $recSet  = User::leftJoin('user_spouses_details AS US', 'US.user_id', '=', 'users.id')
                        ->leftJoin('visitors AS V', 'V.id', '=', 'users.visitor_id')
                        ->leftJoin('user_extra_details AS UD', 'UD.user_id', '=', 'users.id')
                        ->leftJoin('user_questionnaire_answers AS UQA', 'UQA.user_id', '=', 'users.id')
                        ->leftJoin('signatures AS S', 'S.user_id', '=', 'users.id')
                        ->where('users.token','=',$atp_sub2)
                        ->select('users.id as user_id','users.first_name','users.last_name','users.visitor_id', 'users.domain_id', 'users.adv_vis_id', 'users.title', 'users.email', 'users.telephone', 'users.dob', 'users.token', 'users.response_result', 'users.recent_visit', 'users.is_qualified', 'US.spouses_first_name','US.spouses_last_name', 'V.tracker_master_id', 'V.site_flag_id', 'V.tracker_unique_id', 'V.ip_address', 'V.browser_type', 'V.country', 'V.device_type', 'V.user_agent', 'V.resolution', 'V.version', 'V.referer_site', 'V.existing_domain', 'V.full_reference_url', 'V.affiliate_id', 'V.campaign', 'V.split_id', 'V.source', 'V.sub_tracker', 'V.tid', 'V.pid', 'V.adv_visitor_id', 'V.adv_page_name', 'V.adv_redirect_domain',    'UD.postcode', 'UD.street', 'UD.town', 'UD.county', 'UD.address', 'UD.country', 'UD.housenumber', 'UD.housename', 'UD.address3', 'UD.udprn', 'UD.pz_mailsort', 'UD.deliverypointsuffix', 'UD.addressid', 'UD.previous_name','S.bank_id', 'S.type', 'S.signature_image', 'S.pdf_file', 'S.s3_file_path', 'S.status', 'S.previous_name',  'UQA.questionnaire_id', 'UQA.questionnaire_option_id', 'UQA.input_answer', 'UQA.status')
                        ->first();
        if (!empty($recSet)) {
            return $recSet;
        } else {
            return $recSet = array();
        }
    }

    // public function getFollowupUserQuestionAnswers($userId)
    // {
    //     $arrData         =  UserQuestionnaireAnswers::where('user_id','=',$userId)
    //                             ->orderBy('questionnaire_id')
    //                             ->get();
    //     if (!empty($arrData)) {
    //         return $arrData;
    //     } else {
    //         return $arrData = array();
    //     }
    // }

    // public static function getFollowupUserBankDetails($userId)
    // {
        
    //     $arrData         =  UserBank::where('user_id','=',$userId)
    //                             ->get();

    //     if (!empty($arrData)) {
    //         return $arrData;
    //     } else {
    //         return $arrData = array();
    //     }
    // }

    // public static function getFollowupUserSignatureDetails($userId)
    // {
    //     $arrData         =  Signature::where('user_id','=',$userId)
    //                             ->get();
    //     if (!empty($arrData)) {
    //         return $arrData;
    //     } else {
    //         return $arrData = array();
    //     }
    // }
}
