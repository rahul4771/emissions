<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\Visitor;
use App\Models\VisitorsJourney;
use App\Models\VisitorsSlide;
use App\Models\AdtopiaVisitor;
use App\Models\User;
use App\Models\UserExtraDetail;
use App\Models\LeadDoc;
use App\Models\DomainDetail;
use App\Models\FollowupHistories;
use App\Models\BuyerApiResponse;
use App\Models\BuyerApiResponseDetails;
use App\Models\UserQuestionnaireAnswers;
use App\Models\UserQuestionnaireAnswersHistories;
use App\Repositories\QuestionnairesRepository;
use App\Repositories\PdfRepository;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\UserRepository;
use App\Repositories\VisitorRepository;
use App\Repositories\LogRepository;
use App\Repositories\RedirectRepository;
use App\Models\PostcodeLookupResult;
use App\Models\PostcodeValidation;
use App\Models\UserSpousesDetails;
use App\Models\UserSpousesExtraDetails;
use App\Repositories\HistoryRepository;
use App\Repositories\CommonFunctionsRepository;
use App\Repositories\CakeRepository;
use App\Repositories\PixelFireRepository;
use DB;
use App\Repositories\ValidationRepository;
use Illuminate\Support\Facades\URL;
use App\Models\UserVehicleDetails;
use App\Models\VehicleDataLookup;
use App\Models\UserFlowLog;
use App\Models\SplitInfo;

class UserRepository implements UserInterface
{
    public function __construct()
    {
        $this->pixelfireRepo    = new PixelFireRepository;
        $this->validationRepo   = new ValidationRepository;
        $this->visitorRepo      = new VisitorRepository;
        $this->redirectRepo     = new RedirectRepository;
    }

    public function updateUserTimestamp($userId)
    {
        $user = User::find($userId);
        $user->touch();
    }
    
    public function isUserComplete($userId)
    {   
        $QuestionnairesRepository   = new QuestionnairesRepository;
        $questionnaire              = $QuestionnairesRepository->isQuestionnaireComplete($userId);
        $userComplete               = DB::table("users as user")
                                        ->leftJoin('user_extra_details as ue', 'ue.user_id', '=', 'user.id')
                                        ->leftJoin('signatures as s', 'user.id', '=', 's.user_id')
                                        ->join('lead_docs as ld', 'ld.user_id', '=', 'user.id')
                                        ->select('user.first_name as first_name','user.last_name as last_name','ue.gender as gender','user.dob as dob','user.email as email','user.telephone as phone','ue.country as country','ue.postcode as postcode','s.id as userSignature','ld.user_insurance_number as insurance_number','ld.user_identification_type as id_type','ld.user_identification_image_s3 as id_url','ld.spouses_identification_type as p_id_type','ld.spouses_identification_image_s3 as p_id_url')
                                            ->where('user.id','=',$userId)
                                            ->distinct('user.id')
                                            ->first();
        $basicDetails               = 0;
        $taxPayerDetails            = 0;
        $questionnaireDetails       = 0;
        if (!empty($userComplete->first_name) && !empty($userComplete->last_name) && !empty($userComplete->gender) && !empty($userComplete->dob) && !empty($userComplete->email) && !empty($userComplete->phone) && !empty($userComplete->postcode) && !empty($userComplete->country) && !empty($userComplete->insurance_number) && !empty($userComplete->userSignature)) {
                $basicDetails = 1;
        }
        $taxpayer                   = $this->getTaxPayer($userId);
        if ($taxpayer=='partner') {
            if (!empty($userComplete->id_type) && !empty($userComplete->id_url)) {
                $taxPayerDetails = 1;
            }
        } else {
            $taxPayerDetails = 1;
        }
        if ($questionnaire == 1) {
            $questionnaireDetails = 1;
        }
        if ($basicDetails == 1 && $taxPayerDetails ==1 && $questionnaireDetails == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function isPartnerComplete($userId)
    {   
        $QuestionnairesRepository       = new QuestionnairesRepository;
        $questionnaire                  = $QuestionnairesRepository->isPartnerQuestionnaireComplete($userId);
        $partnerComplete                = DB::table("users as user")
                                            ->join('user_spouses_details as usp', 'usp.user_id', '=', 'user.id')
                                            ->join('lead_docs as ld', 'ld.user_id', '=', 'user.id')
                                            ->select('usp.spouses_first_name as p_first_name','usp.spouses_last_name as p_last_name','usp.dob as p_dob','usp.date_of_marriage as dom','usp.signature as p_signature','ld.spouses_insurance_number as spouses_insurance_number','ld.user_identification_type as id_type','ld.user_identification_image_s3 as id_url','ld.spouses_identification_type as p_id_type','ld.spouses_identification_image_s3 as p_id_url')
                                                ->where('user.id','=',$userId)
                                                ->distinct('user.id')
                                                ->first();
        $partnerBasicDetails            = 0;
        $partnerTaxPayerDetails         = 0;
        $partnerQuestionnaireDetails    = 0;                                               
        if (!empty($partnerComplete->p_first_name) && !empty($partnerComplete->p_last_name) && !empty($partnerComplete->p_dob) && !empty($partnerComplete->dom) && !empty($partnerComplete->p_signature) && !empty($partnerComplete->spouses_insurance_number)) {
            $partnerBasicDetails = 1;
        }
        $taxpayer                       = $this->getTaxPayer($userId);
        if ($taxpayer=='me') {
            if (!empty($partnerComplete->p_id_type) && !empty($partnerComplete->p_id_url)) {
                $partnerTaxPayerDetails = 1;
            }
        } else {
            $partnerTaxPayerDetails = 1;
        }
        if ($questionnaire == 1) {
            $partnerQuestionnaireDetails = 1;
        }
        if ($partnerBasicDetails == 1 && $partnerTaxPayerDetails ==1 && $partnerQuestionnaireDetails == 1) {
                return 1;
        } else {
                return 0;
        }   
    }

    public function isPdfDocComplete($userId)
    {   
        $QuestionnairesRepository   = new QuestionnairesRepository;
        $questionnaire              = $QuestionnairesRepository->isQuestionnaireComplete($userId);
        $pdfDocComplete             = DB::table("users as user")
                                        ->join('lead_docs as ld', 'ld.user_id', '=', 'user.id')
                                        ->select('ld.user_identification_type as id_type','ld.user_identification_image_s3 as id_url','ld.spouses_identification_type as p_id_type','ld.spouses_identification_image_s3 as p_id_url','ld.terms_file as terms_file','ld.cover_page as cover_page','ld.pdf_file as pdf_file')
                                            ->where('user.id','=',$userId)
                                            ->distinct('user.id')
                                            ->first();
        $pdfFileDetails             = 0;
        $pdfTaxPayerDetails         = 0;                                                        
        if (!empty($pdfDocComplete->terms_file) && !empty($pdfDocComplete->cover_page) && !empty($pdfDocComplete->pdf_file)) {
            $pdfFileDetails = 1;
        }
        $taxpayer                   = $this->getTaxPayer($userId);
        if ($taxpayer=='me') {
            if (!empty($pdfDocComplete->p_id_type) && !empty($pdfDocComplete->p_id_url)) {
                $pdfTaxPayerDetails = 1;
            }
        } elseif ($taxpayer=='partner') {
            if (!empty($pdfDocComplete->id_type) && !empty($pdfDocComplete->id_url)) {
                $pdfTaxPayerDetails = 1;
            }       
        }
        if ($pdfFileDetails == 1 && $pdfTaxPayerDetails ==1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function validLeadYear($userId)
    {   
        $tax_year                   = [];
        $self_1                     = 'unsure';
        $self_2                     = 'unsure';
        $self_3                     = 'unsure';
        $self_4                     = 'unsure';
        $partner_1                  = 'unsure';
        $partner_2                  = 'unsure';
        $partner_3                  = 'unsure';
        $partner_4                  = 'unsure';
        $tax_payer_question_ans     = DB::table('user_questionnaire_answers AS UQA')
                                        ->leftJoin('questionnaire_options AS QO','UQA.questionnaire_option_id','=','QO.id')
                                        ->where('UQA.questionnaire_id', '>', 10)
                                        ->where('UQA.questionnaire_id', '<', 15)
                                        ->where('UQA.user_id',$userId)->get();

        $non_tax_payer_question_ans = DB::table('user_questionnaire_answers AS UQA')
                                        ->leftJoin('questionnaire_options AS QO','UQA.questionnaire_option_id','=','QO.id')
                                        ->where('UQA.questionnaire_id', '>', 6)
                                        ->where('UQA.questionnaire_id', '<', 11)
                                        ->where('UQA.user_id',$userId)->get();

        $lead_extra                 = DB::table('user_spouses_details')
                                        ->select('date_of_marriage')
                                        ->where('user_id',$userId)
                                        ->first();
        if (!empty($lead_extra)) {
            $dom = $lead_extra->date_of_marriage; 
        } else {
            $dom = '';
        }
        $first_ans                  = DB::table('user_questionnaire_answers AS UQA')
                                        ->leftJoin('questionnaire_options AS QO','UQA.questionnaire_option_id','=','QO.id')
                                        ->where('UQA.questionnaire_id', 1)
                                        ->where('UQA.user_id',$userId)->first();
        $tax_year = array();
        if ($first_ans->value == 'No') {
            if ($dom != '' && $dom != '0000-00-00') {
                if ($dom <= '2017-04-05') {
                    $tax_year['2016/2017'] = 'No';
                    $tax_year['2017/2018'] = 'No';
                    $tax_year['2018/2019'] = 'No';
                    $tax_year['2019/2020'] = 'No';
                } else if ($dom >= '2017-04-06' && $dom <= '2018-04-05') {
                    $tax_year['2017/2018'] = 'No';
                    $tax_year['2018/2019'] = 'No';
                    $tax_year['2019/2020'] = 'No';
                } else if ($dom >= '2018-04-06' && $dom <= '2019-04-05') {
                    $tax_year['2018/2019'] = 'No';
                    $tax_year['2019/2020'] = 'No';
                } else if ($dom >= '2019-04-06' && $dom <= '2020-04-05') {
                    $tax_year['2019/2020'] = 'No';
                }
            } else {
                $tax_year['2016/2017'] = 'No';
                $tax_year['2017/2018'] = 'No';
                $tax_year['2018/2019'] = 'No';
                $tax_year['2019/2020'] = 'No';
            }
        }
        if ($dom == '' || $dom == '0000-00-00') {
            $tax_year['2016/2017'] = 'Unsure';
            $tax_year['2017/2018'] = 'Unsure';
            $tax_year['2018/2019'] = 'Unsure';
            $tax_year['2019/2020'] = 'Unsure';    
        }
        ///********//
        //echo "<pre>----tax_payer_question_ans:";print_r($tax_payer_question_ans);echo "</pre>";
        //echo "<pre>----non_tax_payer_question_ans:";print_r($non_tax_payer_question_ans);echo "<pre>";
        //die("11111");
        if ($dom != '' && $dom != '0000-00-00') {
            $self_1 = 'unsure';
            $self_2 = 'unsure';
            $self_3 = 'unsure';
            $self_4 = 'unsure';
            foreach($tax_payer_question_ans as $value) {
                if ($value->questionnaire_id == 11) {
                    if (!empty($value->value)) {
                        $self_1 = $value->value;
                    } else {
                        $self_1 = 'unsure';
                    }
                    $self_1 = strtolower($self_1);
                }
                if ($value->questionnaire_id == 12) {
                    if (!empty($value->value)) {
                        $self_2 = $value->value;
                    } else {
                        $self_2 = 'unsure';
                    }
                    $self_2 = strtolower($self_2);
                }
                if ($value->questionnaire_id == 13) {
                    if (!empty($value->value)) {
                        $self_3 = $value->value;
                    } else {
                        $self_3 = 'unsure';
                    }
                    $self_3 = strtolower($self_3);
                }
                if ($value->questionnaire_id == 14) {
                    if (!empty($value->value)) {
                        $self_4 = $value->value;
                    } else {
                        $self_4 = 'unsure';
                    }
                    $self_4 = strtolower($self_4);
                }               
            }
            foreach($non_tax_payer_question_ans as $value) {
                if ($value->questionnaire_id == 7) {
                    if (!empty($value->value)) {
                        $partner_1 = $value->value;
                    } else {
                        $partner_1 = 'unsure';
                    }
                    $partner_1 = strtolower($partner_1);
                }
                if ($value->questionnaire_id == 8) {
                    if (!empty($value->value)) {
                        $partner_2 = $value->value;
                    } else {
                        $partner_2 = 'unsure';
                    }
                    $partner_2 = strtolower($partner_2);
                }
                if ($value->questionnaire_id == 9) {
                    if (!empty($value->value)) {
                        $partner_3 = $value->value;
                    } else {
                        $partner_3 = 'unsure';
                    }
                    $partner_3 = strtolower($partner_3);
                }
                if ($value->questionnaire_id == 10) {
                    if (!empty($value->value)) {
                        $partner_4 = $value->value;
                    } else {
                        $partner_4 = 'unsure';
                    }
                    $partner_4 = strtolower($partner_4);
                }
            }
            //echo "<br>self_1:".$self_1."  _______self_2:".$self_2."______self_3:".$self_3."self_4:".$self_4;
            //echo "<br>partner_1:".$partner_1."____  partner_2:".$partner_2." _____partner_3:".$partner_3."  ____partner_4:".$partner_4;
            //die("aaaaa33333");
            $years  = [];//No. of yes initinal value = 0
            $skip   = []; //No. of unsure initinal value = 0
            if ($dom <= '2017-04-05') {
                // 2016/2017
                if ($self_1 == 'yes' && $partner_1 == 'yes') {
                    $years[]                = '2016/2017'; 
                    $tax_year['2016/2017']  = 'Yes';
                } else if ($self_1 == 'no' || $partner_1 == 'no') {
                    $tax_year['2016/2017']  = 'No';
                } else {
                    $skip[]                 = '2016/2017'; 
                    $tax_year['2016/2017']  = 'Unsure';
                }
                // 2017/2018
                if ($self_2 == 'yes' && $partner_2 == 'yes') {
                    $years[] = '2017/2018'; 
                    $tax_year['2017/2018']  = 'Yes';
                } else if ($self_2 == 'no' || $partner_2 == 'no') {
                    $tax_year['2017/2018']  = 'No';
                } else {
                    $skip[] = '2017/2018'; 
                    $tax_year['2017/2018']  = 'Unsure';
                }
                // 2018/2019
                if ($self_3 == 'yes' && $partner_3 == 'yes') {
                    $years[] = '2018/2019'; 
                    $tax_year['2018/2019']  = 'Yes';
                } else if ($self_3 == 'no' || $partner_3 == 'no') {
                    $tax_year['2018/2019']  = 'No';
                } else {
                    $skip[]                 = '2018/2019'; 
                    $tax_year['2018/2019']  = 'Unsure';
                }
                // 2019/2020
                if ($self_4 == 'yes' && $partner_4 == 'yes') {
                    $years[] = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Yes';
                } else if ($self_4 == 'no' || $partner_4 == 'no') {
                    $tax_year['2019/2020']  = 'No';
                } else {
                    $skip[]                 = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Unsure';
                }
            } else if ($dom >= '2017-04-06' && $dom <= '2018-04-05') {
                // 2017/2018
                if ($self_2 == 'yes' && $partner_2 == 'yes') {
                    $years[]                = '2017/2018'; 
                    $tax_year['2017/2018']  = 'Yes';
                } else if ($self_2 == 'no' || $partner_2 == 'no') {
                    $tax_year['2017/2018']  = 'No';
                } else {
                    $skip[]                 = '2017/2018'; 
                    $tax_year['2017/2018']  = 'Unsure';
                }
                // 2018/2019
                if ($self_3 == 'yes' && $partner_3 == 'yes') {
                    $years[]                = '2018/2019'; 
                    $tax_year['2018/2019']  = 'Yes';
                } else if ($self_3 == 'no' || $partner_3 == 'no') {
                    $tax_year['2018/2019']  = 'No';
                } else {
                    $skip[]                 = '2018/2019'; 
                    $tax_year['2018/2019']  = 'Unsure';
                }
                // 2019/2020
                if ($self_4 == 'yes' && $partner_4 == 'yes') {
                    $years[]                = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Yes';
                } else if ($self_4 == 'no' || $partner_4 == 'no') {
                    $tax_year['2019/2020']  = 'No';
                } else {
                    $skip[]                 = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Unsure';
                }   
            } else if ($dom >= '2018-04-06' && $dom <= '2019-04-05') {
                // 2018/2019
                if ($self_3 == 'yes' && $partner_3 == 'yes') {
                    $years[] = '2018/2019'; 
                    $tax_year['2018/2019'] = 'Yes';
                } else if ($self_3 == 'no' || $partner_3 == 'no') {
                    $tax_year['2018/2019'] = 'No';
                } else {
                    $skip[] = '2018/2019'; 
                    $tax_year['2018/2019'] = 'Unsure';
                }
                // 2019/2020
                if ($self_4 == 'yes' && $partner_4 == 'yes') {
                    $years[] = '2019/2020'; 
                    $tax_year['2019/2020'] = 'Yes';
                } else if ($self_4 == 'no' || $partner_4 == 'no') {
                    $tax_year['2019/2020'] = 'No';
                } else {
                    $skip[] = '2019/2020'; 
                    $tax_year['2019/2020'] = 'Unsure';
                }
            } else if ($dom >= '2019-04-06' && $dom <= '2020-04-05') {
                // 2019/2020
                if ($self_4 == 'yes' && $partner_4 == 'yes') {
                    $years[]                = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Yes';
                } else if ($self_4 == 'no' || $partner_4 == 'no') {
                    $tax_year['2019/2020']  = 'No';
                } else {
                    $skip[]                 = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Unsure';
                }
            } else {
                $tax_year = '';
            }
        } else {
            $tax_year = '';
        }
        return $tax_year;
    }

    public function isQualified($userId)
    {
        $userQualified  = DB::table("users as user")
                            ->leftJoin('user_extra_details as ue', 'ue.user_id', '=', 'user.id')
                            ->where('user.id','=',$userId)
                            ->whereIn('user.is_qualified',array(1,2))
                            ->where('ue.qualify_status',1)
                            ->distinct('user.id')
                            ->count();
        if ($userQualified == 1) {
            return 1;
        } else {
            return 0;
        }                           
    }

    public function checkStatus($userId)
    {
        $tax_year                   = [];
        $self_1                     = 'unsure';
        $self_2                     = 'unsure';
        $self_3                     = 'unsure';
        $self_4                     = 'unsure';
        $partner_1                  = 'unsure';
        $partner_2                  = 'unsure';
        $partner_3                  = 'unsure';
        $partner_4                  = 'unsure';
        $tax_payer_question_ans     = DB::table('user_questionnaire_answers AS UQA')
                                        ->leftJoin('questionnaire_options AS QO','UQA.questionnaire_option_id','=','QO.id')
                                        ->where('UQA.questionnaire_id', '>', 10)
                                        ->where('UQA.questionnaire_id', '<', 15)
                                        ->where('UQA.user_id',$userId)->get();
        $non_tax_payer_question_ans = DB::table('user_questionnaire_answers AS UQA')
                                        ->leftJoin('questionnaire_options AS QO','UQA.questionnaire_option_id','=','QO.id')
                                        ->where('UQA.questionnaire_id', '>', 6)
                                        ->where('UQA.questionnaire_id', '<', 11)
                                        ->where('UQA.user_id',$userId)->get();
        $lead_extra                 = DB::table('user_spouses_details')
                                        ->select('date_of_marriage')
                                        ->where('user_id',$userId)
                                        ->first();
        if (!empty($lead_extra)) {
            $dom = $lead_extra->date_of_marriage; 
        } else {
            $dom = '';
        }
        $first_ans                  = DB::table('user_questionnaire_answers AS UQA')
                                        ->leftJoin('questionnaire_options AS QO','UQA.questionnaire_option_id','=','QO.id')
                                        ->where('UQA.questionnaire_id', 1)
                                        ->where('UQA.user_id',$userId)
                                        ->first();
        $tax_year                   = array();
        if (@$first_ans->value == 'no') {
            if ($dom != '' && $dom != '0000-00-00') {
                if ($dom <= '2017-04-05') {
                    $tax_year['2016/2017'] = 'No';
                    $tax_year['2017/2018'] = 'No';
                    $tax_year['2018/2019'] = 'No';
                    $tax_year['2019/2020'] = 'No';
                } else if ($dom >= '2017-04-06' && $dom <= '2018-04-05') {
                    $tax_year['2017/2018'] = 'No';
                    $tax_year['2018/2019'] = 'No';
                    $tax_year['2019/2020'] = 'No';
                } else if ($dom >= '2018-04-06' && $dom <= '2019-04-05') {
                    $tax_year['2018/2019'] = 'No';
                    $tax_year['2019/2020'] = 'No';
                } else if ($dom >= '2019-04-06' && $dom <= '2020-04-05') {
                    $tax_year['2019/2020'] = 'No';
                }
            } else {
                $tax_year['2016/2017'] = 'No';
                $tax_year['2017/2018'] = 'No';
                $tax_year['2018/2019'] = 'No';
                $tax_year['2019/2020'] = 'No';
            }
            $tax_year               = serialize($tax_year);
            $result                 = 'no';
            $result                 = ucfirst($result);
            UserExtraDetail::where('user_id','=',$userId)->update(array('qualify_status' =>0));

            return 0;
        }
        if ($dom == '' || $dom == '0000-00-00') {
            $tax_year['2016/2017']  = 'Unsure';
            $tax_year['2017/2018']  = 'Unsure';
            $tax_year['2018/2019']  = 'Unsure';
            $tax_year['2019/2020']  = 'Unsure';
            $tax_year               = serialize($tax_year);
            $result                 = 'unsure';
            $result                 = ucfirst($result);
            /*DB::table('mtr_docs')
                    ->where('lead_id', $lead_id)
                    ->update(
                    ['qualifying_status' => $result,
                    'qualifying_years_status' => $tax_year
                    ]);
            //return true;
            */
            UserExtraDetail::where('user_id','=',$userId)->update(array('qualify_status' => 2));

            return 2;
        }
        ///********//
        //echo "<pre>----tax_payer_question_ans:";print_r($tax_payer_question_ans);echo "</pre>";
        //echo "<pre>----non_tax_payer_question_ans:";print_r($non_tax_payer_question_ans);echo "<pre>";
        //die("11111");
        if ($dom != '' && $dom != '0000-00-00') {
            $self_1 = 'unsure';
            $self_2 = 'unsure';
            $self_3 = 'unsure';
            $self_4 = 'unsure';
            foreach($tax_payer_question_ans as $value) {
                if ($value->questionnaire_id == 11) {
                    if (!empty($value->value)) {
                        $self_1 = $value->value;
                    } else {
                        $self_1 = 'unsure';
                    }
                    $self_1 = strtolower($self_1);
                }
                if ($value->questionnaire_id == 12) {
                    if (!empty($value->value)) {
                        $self_2 = $value->value;
                    } else {
                        $self_2 = 'unsure';
                    }
                    $self_2 = strtolower($self_2);
                }
                if ($value->questionnaire_id == 13) {
                    if (!empty($value->value)) {
                        $self_3 = $value->value;
                    } else {
                        $self_3 = 'unsure';
                    }
                    $self_3 = strtolower($self_3);
                }
                if ($value->questionnaire_id == 14) {
                    if (!empty($value->value)) {
                        $self_4 = $value->value;
                    } else {
                        $self_4 = 'unsure';
                    }
                    $self_4 = strtolower($self_4);
                }               
            }
            foreach($non_tax_payer_question_ans as $value) {
                if ($value->questionnaire_id == 7) {
                    if (!empty($value->value)) {
                        $partner_1 = $value->value;
                    } else {
                        $partner_1 = 'unsure';
                    }
                    $partner_1 = strtolower($partner_1);
                }
                if ($value->questionnaire_id == 8) {
                    if (!empty($value->value)) {
                        $partner_2 = $value->value;
                    } else {
                        $partner_2 = 'unsure';
                    }
                    $partner_2 = strtolower($partner_2);
                }
                if ($value->questionnaire_id == 9) {
                    if (!empty($value->value)) {
                        $partner_3 = $value->value;
                    } else {
                        $partner_3 = 'unsure';
                    }
                    $partner_3 = strtolower($partner_3);
                }
                if ($value->questionnaire_id == 10) {
                    if (!empty($value->value)) {
                        $partner_4 = $value->value;
                    } else {
                        $partner_4 = 'unsure';
                    }
                    $partner_4 = strtolower($partner_4);
                }
            }
            //echo "<br>self_1:".$self_1."  _______self_2:".$self_2."______self_3:".$self_3."self_4:".$self_4;
            //echo "<br>partner_1:".$partner_1."____  partner_2:".$partner_2." _____partner_3:".$partner_3."  ____partner_4:".$partner_4;
            //die("aaaaa33333");
            $result = '';
            $years  = [];//No. of yes initinal value = 0
            $skip   = []; //No. of unsure initinal value = 0
            if ($dom <= '2017-04-05') {
                // 2016/2017
                if ($self_1 == 'yes' && $partner_1 == 'yes') {
                    $years[] = '2016/2017'; 
                    $tax_year['2016/2017']  = 'Yes';
                } else if ($self_1 == 'no' || $partner_1 == 'no') {
                    $tax_year['2016/2017']  = 'No';
                } else {
                    $skip[]                 = '2016/2017'; 
                    $tax_year['2016/2017']  = 'Unsure';
                }
                // 2017/2018
                if ($self_2 == 'yes' && $partner_2 == 'yes') {
                    $years[]                = '2017/2018'; 
                    $tax_year['2017/2018']  = 'Yes';
                } else if ($self_2 == 'no' || $partner_2 == 'no') {
                    $tax_year['2017/2018']  = 'No';
                } else {
                    $skip[] = '2017/2018'; 
                    $tax_year['2017/2018']  = 'Unsure';
                }
                // 2018/2019
                if ($self_3 == 'yes' && $partner_3 == 'yes') {
                    $years[]                = '2018/2019'; 
                    $tax_year['2018/2019']  = 'Yes';
                } else if ($self_3 == 'no' || $partner_3 == 'no') {
                    $tax_year['2018/2019']  = 'No';
                } else {
                    $skip[] = '2018/2019'; 
                    $tax_year['2018/2019']  = 'Unsure';
                }
                // 2019/2020
                if ($self_4 == 'yes' && $partner_4 == 'yes') {
                    $years[]                = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Yes';
                } else if ($self_4 == 'no' || $partner_4 == 'no') {
                    $tax_year['2019/2020']  = 'No';
                } else {
                    $skip[]                 = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Unsure';
                }
                if (count($skip)>0) { //if any unsure
                    $result = 'unsure';
                } else if ((count($years)>0) && (count($skip)==0)) { //if no unsure and atleast one yes
                    $result = 'yes';
                } else {
                    $result = 'No';
                }
            } else if ($dom >= '2017-04-06' && $dom <= '2018-04-05') {
                // 2017/2018
                if ($self_2 == 'yes' && $partner_2 == 'yes') {
                    $years[]                = '2017/2018'; 
                    $tax_year['2017/2018']  = 'Yes';
                } else if ($self_2 == 'no' || $partner_2 == 'no') {
                    $tax_year['2017/2018']  = 'No';
                } else {
                    $skip[]                 = '2017/2018'; 
                    $tax_year['2017/2018']  = 'Unsure';
                }
                // 2018/2019
                if ($self_3 == 'yes' && $partner_3 == 'yes') {
                    $years[]                = '2018/2019'; 
                    $tax_year['2018/2019']  = 'Yes';
                } else if ($self_3 == 'no' || $partner_3 == 'no') {
                    $tax_year['2018/2019']  = 'No';
                } else {
                    $skip[]                 = '2018/2019'; 
                    $tax_year['2018/2019']  = 'Unsure';
                }
                // 2019/2020
                if ($self_4 == 'yes' && $partner_4 == 'yes') {
                    $years[] = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Yes';
                } else if ($self_4 == 'no' || $partner_4 == 'no') {
                    $tax_year['2019/2020']  = 'No';
                } else {
                    $skip[]                 = '2019/2020'; 
                    $tax_year['2019/2020']  = 'Unsure';
                }
                if (count($skip)>0) {
                    $result = 'unsure';
                } else if ((count($years)>0) && (count($skip)==0)) {
                    $result = 'yes';
                } else {
                    $result = 'No';
                }   
            } else if ($dom >= '2018-04-06' && $dom <= '2019-04-05') {
                // 2018/2019
                if ($self_3 == 'yes' && $partner_3 == 'yes') {
                    $years[] = '2018/2019'; 
                    $tax_year['2018/2019'] = 'Yes';
                } else if ($self_3 == 'no' || $partner_3 == 'no') {
                    $tax_year['2018/2019'] = 'No';
                } else {
                    $skip[] = '2018/2019'; 
                    $tax_year['2018/2019'] = 'Unsure';
                }
                // 2019/2020
                if ($self_4 == 'yes' && $partner_4 == 'yes') {
                    $years[] = '2019/2020'; 
                    $tax_year['2019/2020'] = 'Yes';
                } else if ($self_4 == 'no' || $partner_4 == 'no') {
                    $tax_year['2019/2020'] = 'No';
                } else {
                    $skip[] = '2019/2020'; 
                    $tax_year['2019/2020'] = 'Unsure';
                }
                if (count($skip)>0) {
                    $result = 'unsure';
                } else if ((count($years)>0) && (count($skip)==0)) {
                    $result = 'yes';
                } else {
                    $result = 'No';
                }
            } else if ($dom >= '2019-04-06' && $dom <= '2020-04-05') {
                // 2019/2020
                if ($self_4 == 'yes' && $partner_4 == 'yes') {
                    $years[] = '2019/2020'; 
                    $tax_year['2019/2020'] = 'Yes';
                } else if ($self_4 == 'no' || $partner_4 == 'no') {
                    $tax_year['2019/2020'] = 'No';
                } else {
                    $skip[] = '2019/2020'; 
                    $tax_year['2019/2020'] = 'Unsure';
                }
                if (count($skip)>0) {
                    $result = 'unsure';
                } else if ((count($years)>0) && (count($skip)==0)) {
                    $result = 'Yes';
                } else {
                    $result = 'No';
                }
            } else {
                $result = 'Unsure';
            }
            //echo'<pre>';
            //echo $result;
        } else {
            $result = 'Unsure';
        }
        //if (!empty($tax_year)) {
        $tax_year = serialize($tax_year);
        //}
        $result = ucfirst($result);
        //echo "<br>tax_year:".$tax_year;
        //echo "<br>result:".$result;
        //die("LASSSSSSSSSSSSSSSt");
        if ($result=='Yes') {
            $qualify_status = 1;
        } elseif ($result=='Unsure') {
            $qualify_status = 2;
        } elseif ($result=='No') {
            $qualify_status = 0;
        }
        UserExtraDetail::where('user_id','=',$userId)->update(array('qualify_status' => $qualify_status));

        return $qualify_status;
    }

    public function user_completed_details($user_id)
    {
        $user_details = User::where('id',$user_id)->first();
        $taxPayer     = $this->getTaxPayer($user_id);
        if ($taxPayer) {
            $data['tax_payer'] = $taxPayer;
        }
        $user_sign = $user_details->userSignature;
        if (!empty($user_sign) && $user_sign->signature_image!=NULL) {
            $user_signature = $user_sign->signature_image;   
        } else {
            $user_signature = NULL;
        }
        $partner_sign = $user_details->partnerDetails;
        if (!empty($partner_sign) && $partner_sign->signature!=NULL) {
            $spouse_signature = $partner_sign->signature;   
        } else {
            $spouse_signature = NULL;
        }
        $lead_docs = $user_details->leadDocsDetails;
        if (!empty($lead_docs) && $lead_docs->user_insurance_number!=NULL) {
            $user_insurance_number = $lead_docs->user_insurance_number;   
        } else {
            $user_insurance_number = NULL;
        }
        if (!empty($lead_docs) && $lead_docs->spouses_insurance_number!=NULL) {
            $spouses_insurance_number = $lead_docs->spouses_insurance_number;   
        } else {
            $spouses_insurance_number = NULL;
        }
        if ($taxPayer=="partner") {
            if (!empty($lead_docs) && $lead_docs->user_identification_image_s3!=NULL) {
                 $user_identification_image = $lead_docs->user_identification_image_s3;   
            } else {
                 $user_identification_image = NULL;
            }
        } else if ($taxPayer=="me") {
            if (!empty($lead_docs) && $lead_docs->spouses_identification_image_s3!=NULL) {
                 $spouses_identification_image  = $lead_docs->spouses_identification_image_s3;   
            } else {
                 $spouses_identification_image  = NULL;
            }
        }
        $QuestionnairesRepository   = new QuestionnairesRepository;
        $user_questionnaire         = $QuestionnairesRepository->isQuestionnaireComplete($user_id);
        $partner_questionnaire      = $QuestionnairesRepository->isPartnerQuestionnaireComplete($user_id);
        if ($taxPayer=='me') {
            $data['tax_payer_details']      = array(
                                                        'first_name'    => @$user_details->first_name,
                                                        'last_name'     => @$user_details->last_name,
                                                        'signature'     => $user_signature,
                                                        'nic'           => $user_insurance_number,
                                                        'questionair'   => $user_questionnaire
                                                    );
            $data['non_tax_payer_details']  = array(
                                                        'first_name'            => @$user_details->partnerDetails->spouses_first_name,
                                                        'last_name'             => @$user_details->partnerDetails->spouses_last_name,
                                                        'signature'             => $spouse_signature,
                                                        'nic'                   => $spouses_insurance_number,
                                                        'identification_image'  => $spouses_identification_image,
                                                        'questionair'           => $partner_questionnaire
                                                    );
        } elseif ($taxPayer=='partner') {
           $data['tax_payer_details']       = array(
                                                        'first_name'    => @$user_details->partnerDetails->spouses_first_name,
                                                        'last_name'     => @$user_details->partnerDetails->spouses_last_name,
                                                        'signature'     => $spouse_signature,
                                                        'nic'           => $spouses_insurance_number,
                                                        'questionair'   => $partner_questionnaire
                                                    );
            $data['non_tax_payer_details']  = array(
                                                        'first_name'            => @$user_details->first_name,
                                                        'last_name'             => @$user_details->last_name,
                                                        'signature'             => $user_signature,
                                                        'nic'                   => $user_insurance_number,
                                                        'identification_image'  => $user_identification_image,
                                                        'questionair'           => $user_questionnaire
                                                    );
        }
        return $data;
    }

    public function getVisitorUserTransDetails($intVisitorId, $intUserId, $sqlField = '')
    {
        $recSet     = DB::table('visitors AS V')
                        ->leftJoin('users AS U','V.id','=','U.visitor_id')
                        ->leftJoin('user_extra_details','U.id','=','user_extra_details.user_id')
                        ->leftJoin('buyer_api_responses','U.id','=','buyer_api_responses.user_id')
                        ->leftJoin('buyer_api_response_details AS BD','BD.buyer_api_response_id','=','buyer_api_responses.id');
        if ($sqlField == '') {
            $recSet->select('b.id AS bank_id','V.ip_address','V.campaign','V.tracker_master_id',
                                   'V.sub_tracker','U.created_at',
                                   'U.title','U.first_name', 'U.last_name', 'U.email' ,'U.telephone', 'U.dob', 'buyer_api_responses.api_response', 'buyer_api_responses.result', 'U.record_status', 'BD.lead_value','buyer_api_responses.lead_id','V.adv_visitor_id','V.pid','V.adv_redirect_domain', 'buyer_api_responses.buyer_id', 
                                   DB::raw("(" . date("Y") . " - YEAR(STR_TO_DATE(U.dob, '%d/%m/%Y'))) AS dobYearDiff")
                                );
        } else {
            $recSet->leftJoin('thrive_visitors AS TV','V.id','=','TV.visitor_id')
                   ->leftJoin('adtopia_visitors AS AV','V.id','=','AV.visitor_id')
                   ->leftJoin('user_extra_details AS UD','U.id','=','UD.user_id')
                   ->leftJoin('ho_cake_visitors AS HV','V.id','=','HV.visitor_id')
                   ->select();
        }
        $arrData = $recSet->where('V.id','=',$intVisitorId)
                    ->where('U.id','=',$intUserId)
                    ->first($sqlField);
        if (!empty($arrData)) {
            return $arrData;
        } else {
            return $arrData = array();
        }
    }

    #########################################
    #                   User                #
    #########################################
    public function insertIntoUser($intVisitorId, $arrData)
    {
        $arrData['bankDetails']     = '';
        $arrData['response_result'] = (isset($arrData['response_result']) ? serialize($arrData['response_result']) : '');
        $arrData['address_id']      = isset($arrData['address_id']) ? $arrData['address_id'] : '';
        $domain_id                  = null;
        $domain_name                = $arrData['domain'];
        $domain_result              = DomainDetail::where('domain_name','=',$domain_name)
                                        ->select('id')
                                        ->first();
        if (!empty($domain_result)) {
            $domain_id   = $domain_result->id;
        } else {
            $date = date('Y-m-d H:i:s');
            $domain_data = array(
                                    'domain_name'       => $domain_name,
                                    'status'            => '1',
                                    'type'              => 'LP',
                                    'last_active_date'  => $date
                                );
            $domain_id   = DomainDetail::insertGetId($domain_data);
        }
        //Insert into db User  table
        if($arrData['carRegNo'] == null){
            $arrData['is_qualified'] = 2;
        }
        $user_data                  = array(
                                                'visitor_id'        => $intVisitorId,
                                                'first_name'        => @$arrData['fname'],
                                                'last_name'         => @$arrData['lname'],
                                                'email'             => @$arrData['email'],
                                                'telephone'         => @$arrData['telephone'],
                                                'dob'               => @$arrData['dob'],
                                                'is_qualified'      => @$arrData['is_qualified'],
                                                'adv_vis_id'        => @$arrData['adv_visitor_id'],
                                                'domain_id'         => @$domain_id,
                                                'record_status'     => @$arrData['record_status'],
                                                'response_result'   => @$arrData['response_result'],
                                                'recent_visit'      => NULL,
                                                'created_at'        => date("Y-m-d H:i:s")
                                            );
        $intUserId                  = User::insertGetId($user_data);
        if ($intUserId > 0) {
            $password_tkn = $intUserId.'thedebtexchange';
            do {
                $salt = random_bytes(16);
                $token = hash_pbkdf2("sha1", $password_tkn, $salt, 20000,10);
            } while (User::where('token','=',$token)->exists());
            User::whereId($intUserId)->update(array('token'=> $token));
            //Insert into db  user_details table
            $user_details_data              = array(
                                                        'user_id'               => $intUserId,
                                                        'gender'                => isset($arrData['gender'])?$arrData['gender']:'',
                                                        'postcode'              => $arrData['postcode'],
                                                        'street'                => $arrData['street'],
                                                        'town'                  => $arrData['town'],
                                                        'county'                => $arrData['county'],
                                                        'housenumber'           => $arrData['housenumber'],
                                                        'address'               => $arrData['address'],
                                                        'addressid'             => $arrData['addressid'],
                                                        'country'               => $arrData['country'],
                                                        'housename'             => $arrData['housename'],
                                                        'address3'              => $arrData['address3'],
                                                        'udprn'                 => $arrData['udprn'],
                                                        'pz_mailsort'           => $arrData['pz_mailsort'],
                                                        'deliverypointsuffix'   => $arrData['deliverypointsuffix'],
                                                        'addressid'             => $arrData['addressid'],
                                                        'unique_key'            => $arrData['unique_key']
                                                    );
            // dd($user_details_data);
            $intUserDetailsId               = UserExtraDetail::insertGetId($user_details_data);
            // $spouses_details                = array(
            //                                             'user_id'               => $intUserId,
            //                                             'spouses_first_name'    => $arrData['spouses_fname'],
            //                                             'spouses_last_name'     => $arrData['spouses_lname'],
            //                                             'dob'                   => $arrData['spouses_dob'],
            //                                             'date_of_marriage'      => $arrData['dom'],
            //                                         );
            // $intUserSpousesDetailsId        = UserSpousesDetails::insertGetId($spouses_details);
            // $spouses_extra_details          = array(
            //                                         'spouses_id'    => $intUserSpousesDetailsId,
            //                                         'spouses_phone' => $arrData['spouses_phone']
            //                                     );
            // $intUserSpousesExtraDetailsId   = UserSpousesExtraDetails::insertGetId($spouses_extra_details);
            // Update user id into pixel firing log table
            VisitorsJourney::where('visitor_id', '=', $intVisitorId)
               ->whereNull('user_id')
               ->update(array('user_id' => $intUserId));

            return $intUserId;
        } else {
            // Write the contents back to the file
            $strFileContent = "\n----------\n Date: " . date('Y-m-d H:i:s') . "\n intVisitorId : $intVisitorId \n";
            //Function call for write log 
            //MAIN::writeLog("insert_into_user_failed", $strFileContent);
            $logRepo    = new LogRepository;
            $logWrite   = $logRepo->writeLog('-insert_into_user_failed',$strFileContent);

            return 0;
        }
    }

    #########################################
    #                   User                #
    #########################################
    public function checkBuyerApiResponse($intUserId)
    {
        $checkBuyerApiId  = BuyerApiResponse::select('id')
                                    ->where('user_id','=',$intUserId)
                                    ->where('lead_id','!=', NULL)
                                    ->first();
        if (isset($checkBuyerApiId)) {
            return 0;
        } else {
            return 1;
        }
    }

    public function insertBuyerApiResponse($intUserId, $arrData)
    {
        $user_trans_data        = array(
                                            'user_id'       => $intUserId,
                                            'buyer_id'      => $arrData['leadBuyerId'],
                                            'lead_id'       => $arrData['leadId'],
                                            'result'        => $arrData['result'],
                                            'api_response'  => $arrData['postingResponse'],
                                         );
        $intBuyerApiResponseId  = BuyerApiResponse::insertGetId($user_trans_data);
        if ($intBuyerApiResponseId > 0) {
            return $intBuyerApiResponseId;
        } else {
            // Write the contents back to the file
            $strFileContent = "\n----------\n Date: " . date('Y-m-d H:i:s') . "\n intUserId : $intUserId  \n ";
            //Function call for write log 
            // MAIN::writeLog("insert_into_usertrans_failed", $strFileContent);
            $logRepo        = new LogRepository;
            $logWrite       = $logRepo->writeLog('-insert_into_usertrans_failed',$strFileContent);

            return 0;
        }
    }

    public function insertBuyerApiResponseDetails($buyer_api_response_id,$arrData)
    {
        $data                           = array(
                                                    'buyer_api_response_id' => $buyer_api_response_id,
                                                    'lead_value'            => @$arrData['leadValue'],
                                                    'post_param'            => $arrData['postingParam'],
                                                 );
        $intBuyerApiResponseDetailsId   = BuyerApiResponseDetails::insertGetId($data);
        if ($intBuyerApiResponseDetailsId > 0) {
            return $intBuyerApiResponseDetailsId;
        } else {
            // Write the contents back to the file
            $strFileContent = "\n----------\n Date: " . date('Y-m-d H:i:s') . "\n intUserId : \n";
            //Function call for write log 
            // MAIN::writeLog("insert_into_usertrans_failed", $strFileContent);
            $logRepo        = new LogRepository;
            $logWrite       = $logRepo->writeLog('-insert_into_usertrans_failed',$strFileContent);

            return 0;
        }
    }

    //Get lead id from user transaction page
    public function getLeadId($intUserId)
    { 
        $lead = BuyerApiResponse::where('user_id',$intUserId)->first();
        if (isset($lead)) {
            return $lead->lead_id;
        }
    }

    public function storeUser($request,$recordStatus)
    {  
        //dd($request->all());
        //dd($recordStatus);
        $strJoinDob = '';
        $strDob     = '';
        $strDom     = '';
        $sp_strDob  = '';
        if (!empty($request->lstDobDay) && !empty($request->lstDobMonth) && !empty($request->lstDobYear)) {
            $strDob = $request->lstDobYear.'-'.$request->lstDobMonth.'-'.$request->lstDobDay;
        }
        if (!empty($request->lstDomDay) && !empty($request->lstDomMonth) && !empty($request->lstDomYear)) {
            $strDom = $request->lstDomYear.'-'.$request->lstDomMonth.'-'.$request->lstDomDay;
        }
        if (!empty($request->sp_lstDobDay) && !empty($request->sp_lstDobMonth) && !empty($request->sp_lstDobYear)) {
            $sp_strDob = $request->sp_lstDobYear.'-'.$request->sp_lstDobMonth.'-'.$request->sp_lstDobDay;
        }
        $intVisitorId = trim($request->visitor_id);
        // $Estimatedebtamiunt = trim($request->debtLevel );
        // $Howmanycredit = trim($request->howmanycredit );
        // $resstatus              = trim($request->residentstatus );
        $strPostcode            = strtoupper($request->txtPostCode);
        $unique_key             = 'mtr_' . $intVisitorId;
        $strFname               = trim($request->txtFName );
        $strLname               = trim($request->txtLName );
        $spouse_strFname        = trim($request->sp_txtFName );
        $spouse_Lname           = trim($request->sp_txtLName );
        $strEmail               = trim($request->txtEmail );
        $street                 = trim($request->txtStreet );
        $county                 = trim($request->txtCounty );
        $town                   = trim($request->txtTown );
        $housename              = trim($request->txtHouseName );
        $address3               = trim($request->txtAddress3 );
        $udprn                  = trim($request->txtUdprn );
        $deliverypointsuffix    = trim($request->txtDeliveryPointSuffix );
        $pz_mailsort            = trim($request->txtPz_mailsort );
        $country                = trim($request->txtCountry );
        $commonFunctionRepo     = new CommonFunctionsRepository;
        $arrData                = array(
                                    'visitor_id'            => $intVisitorId,
                                    'ip_address'            => $commonFunctionRepo->get_client_ip(),
                                    // 'Estimatedebtamiunt'  => $Estimatedebtamiunt,
                                    // 'resstatus'           => $resstatus,
                                    'split_info_id'         => $request->split_info_id,
                                    // 'Howmanycredit'       => $Howmanycredit,
                                    'fname'                 => trim($strFname ),
                                    'lname'                 => trim($strLname ),
                                    'dob'                   => @$strDob,
                                    'gender'                => isset($request->gender)?$request->gender:'',
                                    'spouses_fname'         => $spouse_strFname,
                                    'spouses_lname'         => $spouse_Lname,
                                    'spouses_dob'           => @$sp_strDob,
                                    'dom'                   => @$strDom,
                                    'spouses_phone'         => trim($request->txtPhone_sp ),
                                    'telephone'             => trim($request->txtPhone ),
                                    'email'                 => trim($strEmail ),
                                    'postcode'              => trim($strPostcode ),
                                    'housenumber'           => trim($request->txtHouseNumber ),
                                    'street'                => $street,
                                    'county'                => $county,
                                    'town'                  => $town,
                                    'housename'             => $housename,
                                    'address3'              => $address3,
                                    'udprn'                 => $udprn,
                                    'pz_mailsort'           => $pz_mailsort,
                                    'country'               => $country,
                                    'deliverypointsuffix'   => $deliverypointsuffix,
                                    'recent_visit'          => trim($request->strFileName),
                                    'countryCode'           => $request->countryCode,
                                    'response_result'       => $request->response_result,
                                    'address1'              => $request->address1,
                                    'addressid'             => @$request->address1,
                                    'address'               => @$request->address,
                                    'record_status'         => $recordStatus,
                                    'unique_key'            => $unique_key,
                                    'carRegNo'              => @$request->carRegNo,
                                    'question1'             => @$request->carAcquiredDate,
                                    'question2'             => @$request->purchase_finance_lease,
                                    'question3'             => @$request->joined_another_claim,

                                    'question4'             => @$request->vehicle_class,
                                    'question5'             => @$request->mercedes_letter,
                                    'question6'             => @$request->question6,
                                    'question7'             => @$request->question7
                                    );

        // Declare all variables from arrData
        $intVisitorId           = @$arrData['visitor_id'];
        $unique_key             = 'mtr_' . $intVisitorId;
        $strFname               = @$arrData['fname'];
        $strLname               = @$arrData['lname'];
        $split_info_id          = (isset($arrData['split_info_id'])) ? $arrData['split_info_id'] : null;
        $strDob                 = @$arrData['dob'];
        $strPostcode            = str_replace(' ', '', $arrData['postcode']);
        $strHouseNumberName     = @$arrData['housenumber'];
        $strAddress             = @$arrData['address'];
        $strstreet              = @$arrData['street'];
        $strCounty              = @$arrData['county'];
        $strTown                = @$arrData['town'];
        $housename              = @$arrData['housename'];
        $address3               = @$arrData['address3'];
        $udprn                  = @$arrData['udprn'];
        $pz_mailsort            = @$arrData['pz_mailsort'];
        $country                = @$arrData['country'];
        $deliverypointsuffix    = @$arrData['deliverypointsuffix'];
        $strTelephone           = @$arrData['telephone'];
        $strMobile              = @$arrData['mobile'];
        $strEmail               = @$arrData['email'];
        $strFileName            = @$arrData['recent_visit'];
        $countryCode            = @$arrData['countryCode'];
        $strRecordStatus        = @$arrData['response_result'];
        $strLeadBuyer           = @$arrData['lead_buyer'];
        $intLeadBuyerId         = @$arrData['lead_buyer_id'];
        $strIpAddres            = @$arrData['ip_address'];
        $strDomainName          = env('APP_URL');
        $arrData['unique_key']  = @$unique_key;
        $arrData['domain']      = @$strDomainName;
        $AddressID              = @$arrData['address1'];

        ################# Get AddressID ####################
        $intAddressId           = "";
        $ArrAddid               = PostcodeLookupResult::where('visitor_id','=',$intVisitorId)
                                    ->select('paf_id')
                                    ->first();
        if (!empty($ArrAddid)) {
            $intAddressId       = $ArrAddid->paf_id;
        }
        $num = '';
        /* Address Lookup Section is updated - 2018/02/27*/
        if ($strAddress == "") {}
        $arrVTrans = Visitor::with(['adtopia_visitor','thrive_visitor','ho_cake_visitor'])->where('id',$intVisitorId)
                            ->first();
        if (isset($arrVTrans)) {
            if (isset($arrVTrans->ho_cake_visitor)) {
                $arrData['aff_id']             = $arrVTrans->ho_cake_visitor->aff_id;
                $arrData['aff_sub']            = $arrVTrans->ho_cake_visitor->aff_sub;
                $arrData['offer_id']           = $arrVTrans->ho_cake_visitor->offer_id;
            }
            if (isset($arrVTrans->thrive_visitor)) {
                $arrData['thr_sub1']           = $arrVTrans->thrive_visitor->thr_sub1;
                $arrData['thr_source']         = $arrVTrans->thrive_visitor->thr_source;
            }
            if (isset($arrVTrans->adtopia_visitor)) {
                $arrData['atp_source']         = $arrVTrans->adtopia_visitor->atp_source;
                $arrData['atp_vendor']         = $arrVTrans->adtopia_visitor->atp_vendor;
                $arrData['atp_sub4']           = $arrVTrans->adtopia_visitor->atp_sub4;
                $arrData['atp_sub5']           = $arrVTrans->adtopia_visitor->atp_sub5;
            }
            $arrData['adv_visitor_id']      = $arrVTrans->adv_visitor_id;
            $arrData['sub_tracker']         = $arrVTrans->sub_tracker;
            $arrData['tracker_unique_id']   = $arrVTrans->tracker_unique_id;
            $arrData['tracker_master_id']   = $arrVTrans->tracker_master_id;
            $arrData['tid']                 = $arrVTrans->tid;
            $arrData['pid']                 = $arrVTrans->pid;
            $arrData['campaign']            = $arrVTrans->campaign;
        } else {
            $arrData['tracker_unique_id']   = "";
            $arrData['aff_id']              = "";
            $arrData['aff_sub']             = "";
            $arrData['offer_id']            = "";
            $arrData['tid']                 = "";
            $arrData['pid']                 = "";
            $arrData['campaign']            = "";
            $arrData['thr_sub1']            = "";
            $arrData['thr_source']          = "";
            $arrData['sub_tracker']         = "";
            $arrData['atp_source']          = "";
            $arrData['atp_vendor']          = "";
            $arrData['atp_sub4']            = "";
            $arrData['atp_sub5']            = "";
            $arrData['adv_visitor_id']      = 0;
            $arrData['tracker_master_id']   = 7;
        }
        if (!empty($product)) {
            $product_id = $product->id;
        } else {
            $product_id = 0;
        }
        $r=$this->validationRepo->fnUserDuplicateCheck(array("email" => $strEmail, "phone" => $strTelephone,"product_id"=>$product_id));

        if ($this->validationRepo->fnUserDuplicateCheck(array("email" => $strEmail, "phone" => $strTelephone,"product_id"=>$product_id))) {
            $posttocake         = "1";
            $intUserId          = "0";
            $strErrorMessage    = 'Duplicate Lead Found';
        } else {

            //Function call for insert user details into DB
            // if (trim($arrData['town']) == "" || trim($arrData['housenumber']) == "") {
            //     $num        .= "-77777-"; 
            //     $caUrl      = env('APP_URL')."ajax/get-addr-split-postcode-api?visitor_id=".$arrData['visitor_id']."&AddressID=".$AddressID."&postcode=".$arrData['postcode'];
            //     $caUrl      = str_replace(' ', '', $caUrl);
            //     $arrContextOptions=array(
            //                                 "ssl" => array(
            //                                                 "verify_peer"=>false,
            //                                                 "verify_peer_name"=>false,
            //                                                 ),
            //                             );
            //     $info       = file_get_contents(htmlspecialchars_decode($caUrl),false,stream_context_create($arrContextOptions));

            //     $myArray    = json_decode($info, true);
            
            // }
            

            $arrData['is_qualified'] = 1;
            $get_keeper_end_date     = NULL;
            // $car_acq_date            = @$request->carAcquiredDate;


            // if($car_acq_date=="") {
            //     $arrData['is_qualified'] = 0;
            // } else { 
            //     //$get_keeper_end_date    = $request->keeperDate==""?NULL:@$request->keeperDate;
            //     $entry_starting_date    = strtotime('01-01-2009');
            //     $entry_end_date         = strtotime('31-12-2018');
            //     $car_acq_date_time      = strtotime($car_acq_date);

            //     if($car_acq_date_time >= $entry_starting_date && $car_acq_date_time <=$entry_end_date) {
            //         $arrData['is_qualified'] = 1;
            //     } else {
            //         $arrData['is_qualified'] = 0;
            //     }
            // }
            
            $intUserId          = $this->insertIntoUser($intVisitorId, $arrData);
            //update car no with entry in user_flow_logs table
            if(isset($request->carRegNo)){
                $UpdateCarDetails    = $this->UpdateUserCarDetails($intUserId, $intVisitorId, $request->carRegNo);
            }
            /*** Adtopia Pixel Fire ****/ 
            $visitor_deatil     = Visitor::select("tracker_master_id","sub_tracker","tracker_unique_id","split_id")->whereId($intVisitorId)->first();
            $tracker_type       = $visitor_deatil->tracker_master_id;
            $tracker            = $visitor_deatil->sub_tracker;
            $currentUrl         = URL::full();
            $split_name         = SplitInfo::select("split_name")
                                    ->whereId($visitor_deatil->split_id)->first();
            //if (isset($tracker_type) && $tracker_type == 1) {
            if($split_name->split_name == "HFDC_V4.php"){
                if (isset($tracker_type) && $tracker_type == 1) {    
                    $pixel          = $visitor_deatil->tracker_unique_id;
                    $atp_vendor     = AdtopiaVisitor::select("atp_vendor")->whereVisitorId($intVisitorId)->first();
                    $buyer_response = $this->visitorRepo->getVisitorUserTransDetails($intVisitorId, $intUserId,"");
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
                                            // "cakePostStatus"          => @$trans_deatil->is_pixel_fire,
                                            "cakePostStatus"          => '',
                                            "record_status"           => @$buyer_response->record_status,
                                            "buyer_id"                => @$buyer_response->buyer_id,
                                            "revenue"                 => @$buyer_response->lead_value,
                                            "currency"                => $currency,
                                            "intVoluumtrk2PixelFired" => '',
                                        );
                    $arrResultDetail        = $this->pixelfireRepo->atpPixelFire($chkArry);
                    if ($arrResultDetail) {
                        $strResult          = $arrResultDetail['result'];
                        $response           = $arrResultDetail['result_detail'];
                        $adtopiapixel       = $arrResultDetail['adtopiapixel'];
                        // UserDetail::where('user_id'=> $intUserId)->update('is_pixel_fire'=>1,'pixel_log'=>$response,'pixel_type'=>'web');
                    }
                }
            } else {
                if (isset($tracker_type) && $tracker_type == 1 && @$request->carRegNo!=null) {    
                    $pixel          = $visitor_deatil->tracker_unique_id;
                    $atp_vendor     = AdtopiaVisitor::select("atp_vendor")->whereVisitorId($intVisitorId)->first();
                    $buyer_response = $this->visitorRepo->getVisitorUserTransDetails($intVisitorId, $intUserId,"");
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
                                            // "cakePostStatus"          => @$trans_deatil->is_pixel_fire,
                                            "cakePostStatus"          => '',
                                            "record_status"           => @$buyer_response->record_status,
                                            "buyer_id"                => @$buyer_response->buyer_id,
                                            "revenue"                 => @$buyer_response->lead_value,
                                            "currency"                => $currency,
                                            "intVoluumtrk2PixelFired" => '',
                                        );
                    $arrResultDetail        = $this->pixelfireRepo->atpPixelFire($chkArry);
                    if ($arrResultDetail) {
                        $strResult          = $arrResultDetail['result'];
                        $response           = $arrResultDetail['result_detail'];
                        $adtopiapixel       = $arrResultDetail['adtopiapixel'];
                        // UserDetail::where('user_id'=> $intUserId)->update('is_pixel_fire'=>1,'pixel_log'=>$response,'pixel_type'=>'web');
                    }
                }
            }
            
            /*** Adtopia Pixel Fire ****/ 
            $arrData['userid']  = $intUserId;
            $is_qualified       = $arrData['is_qualified'];

            $posttocake         = "";
            if (trim($arrData['town']) == "" || trim($arrData['housenumber']) == "" ) {  
                $num .= "-8888-"; 
            }
            if (!substr_count($arrData['email'], "@922.com")) {
                // Define ip that need to be block
                $ips = array(
                                "179.43.", 
                                "31.132.", 
                                "77.75.", 
                                "78.157.", 
                                "89.47."
                            );
                // block users based on blacklisted IPs
                foreach ($ips as $ip) {
                    if (strpos($strIpAddres, $ip) === 0) {
                        $posttocake = "no";
                        $strResult  = "Not Posted to CAKE - IP not Valid";
                    }
                }
            }
        }
        $strResultMsg   = "";
        $sql_select     =''; 
        //here adding cake posting
        $lead_id        = $this->getLeadId($intUserId);
        // $post_to_cake   = CommonFunctions::getLeadBuyerID('CAKE');
        $post_to_cake   = 0;
        
        //here ending cake posting
        if ($intUserId > 0) {
            $qualifiedLead  = 1;
            $historyArr     = [];
            if ($arrData['question7']) {
                if ($arrData['question7'] == 41) {
                    $qualifiedLead = 0;
                }
                $objUserQuestionnaireAnswers                            = new UserQuestionnaireAnswers;
                $objUserQuestionnaireAnswers->user_id                   = $intUserId;
                $objUserQuestionnaireAnswers->questionnaire_option_id   = $arrData['question7'];
                $objUserQuestionnaireAnswers->questionnaire_id          = 15;
                $objUserQuestionnaireAnswers->save();
                $user_answers_arr[] = [
                                            'user_id'                   => $intUserId,
                                            'questionnaire_id'          => 15,
                                            'questionnaire_option_id'   => $arrData['question7'],
                                            'input_answer'              => "",
                                            'status'                    => 1
                                        ];
                $historyArr[]       = [
                                            'user_id'           => $intUserId,
                                            'bank_id'           => 0,
                                            'type'              => 'questionnaire0',
                                            'type_id'           => 15,
                                            'value'             => $arrData['question7'],
                                            'source'            => 'live'
                                        ];
            }
            if ($arrData['question1']) {
                if ($arrData['question1'] == 2) {
                    $qualifiedLead = 0;
                }
                $objUserQuestionnaireAnswers                            = new UserQuestionnaireAnswers;
                $objUserQuestionnaireAnswers->user_id                   = $intUserId;
                $objUserQuestionnaireAnswers->input_answer              =    $arrData['question1'];
                $objUserQuestionnaireAnswers->questionnaire_id          = 1;
                $objUserQuestionnaireAnswers->save();
                $user_answers_arr[] = [
                                            'user_id'                   => $intUserId,
                                            'questionnaire_id'          => 1,
                                            'questionnaire_option_id'   => "",
                                            'input_answer'              => $arrData['question1'],
                                            'status'                    => 1
                                        ];
                $historyArr[]       = [
                                            'user_id'           => $intUserId,
                                            'bank_id'           => 0,
                                            'type'              => 'questionnaire0',
                                            'type_id'           => 1,
                                            'value'             => $arrData['question1'],
                                            'source'            => 'live'
                                      ];

            }
            if ($arrData['question2']) {
                $objUserQuestionnaireAnswers = new UserQuestionnaireAnswers;
                $objUserQuestionnaireAnswers->user_id                   = $intUserId;
                $objUserQuestionnaireAnswers->input_answer              =    $arrData['question2'];
                $objUserQuestionnaireAnswers->questionnaire_id          =    2;
                $objUserQuestionnaireAnswers->save();
                $user_answers_arr[] = [
                                            'user_id'                   => $intUserId,
                                            'questionnaire_id'          => 2,
                                            'questionnaire_option_id'   => "",
                                            'input_answer'              => $arrData['question2'],
                                            'status'                    => 1
                                        ];

                 $historyArr[]      = [
                                            'user_id'           => $intUserId,
                                            'bank_id'           => 0,
                                            'type'              => 'questionnaire0',
                                            'type_id'           => 2,
                                            'value'             => $arrData['question2'],
                                            'source'            => 'live'
                                          ];
            }
            if ($arrData['question3']) {
                if ($arrData['question3'] == 7) {
                    $qualifiedLead = 0;
                }else if ($arrData['question3'] == 6) {
                    $qualifiedLead = 2;
                }
                $objUserQuestionnaireAnswers = new UserQuestionnaireAnswers;
                $objUserQuestionnaireAnswers->user_id                   = $intUserId;
                $objUserQuestionnaireAnswers->questionnaire_id          = 3;
                $objUserQuestionnaireAnswers->input_answer              = $arrData['question3'];
                $objUserQuestionnaireAnswers->save();
                $user_answers_arr[] = [
                                            'user_id'                   => $intUserId,
                                            'questionnaire_id'          => 3,
                                            'questionnaire_option_id'   => "",
                                            'input_answer'              => $arrData['question3'],
                                            'status'                    => 1
                                        ];

                 $historyArr[]      = [
                                            'user_id'           => $intUserId,
                                            'bank_id'           => 0,
                                            'type'              => 'questionnaire0',
                                            'type_id'           => 3,
                                            'value'             => $arrData['question3'],
                                            'source'            => 'live'
                                        ];
            }
            if ($arrData['question4']) {
                if ($arrData['question4'] == 10) {
                    $qualifiedLead = 0;
                }else if ($arrData['question4'] == 9) {
                    $qualifiedLead = 2;
                }
                $objUserQuestionnaireAnswers = new UserQuestionnaireAnswers;
                $objUserQuestionnaireAnswers->user_id           = $intUserId;
                $objUserQuestionnaireAnswers->questionnaire_id  = 4;
                $objUserQuestionnaireAnswers->input_answer      = $arrData['question4'];
                $objUserQuestionnaireAnswers->save();
                $user_answers_arr[] = [
                                            'user_id'                   => $intUserId,
                                            'questionnaire_id'          => 4,
                                            'questionnaire_option_id'   => "",
                                            'input_answer'              => $arrData['question4'],
                                            'status'                    => 1
                                        ];
                $historyArr[]       = [
                                        'user_id'           => $intUserId,
                                        'bank_id'           => 0,
                                        'type'              => 'questionnaire0',
                                        'type_id'           => 4,
                                        'value'             => $arrData['question4'],
                                        'source'            => 'live'
                                      ];
            }
            if ($arrData['question5']) {
                if ($arrData['question5'] == 13) {
                    $qualifiedLead = 0;
                }else if ($arrData['question5'] == 12) {
                    $qualifiedLead = 2;
                }
                $objUserQuestionnaireAnswers                            = new UserQuestionnaireAnswers;
                $objUserQuestionnaireAnswers->user_id                   = $intUserId;
                $objUserQuestionnaireAnswers->questionnaire_id          = 5;
                $objUserQuestionnaireAnswers->input_answer              = $arrData['question5'];
                $objUserQuestionnaireAnswers->save();
                $user_answers_arr[] = [
                                            'user_id'                   => $intUserId,
                                            'questionnaire_id'          => 5,
                                            'questionnaire_option_id'   => "",
                                            'input_answer'              => $arrData['question5'],
                                            'status'                    => 1
                                        ];
                $historyArr[]       = [
                                            'user_id'           => $intUserId,
                                            'bank_id'           => 0,
                                            'type'              => 'questionnaire0',
                                            'type_id'           => 5,
                                            'value'             => $arrData['question5'],
                                            'source'            => 'live'
                                      ];
            }
            if ($arrData['question6']) {
                if ($arrData['question6'] == 16) {
                    $qualifiedLead = 0;
                }else if ($arrData['question6'] == 15) {
                    $qualifiedLead = 2;
                }
                $objUserQuestionnaireAnswers                            = new UserQuestionnaireAnswers;
                $objUserQuestionnaireAnswers->user_id                   = $intUserId;
                $objUserQuestionnaireAnswers->questionnaire_id          = 6;
                $objUserQuestionnaireAnswers->input_answer              = $arrData['question6'];
                $objUserQuestionnaireAnswers->save();
                $user_answers_arr[] = [
                                            'user_id'                   => $intUserId,
                                            'questionnaire_id'          => 6,
                                            'questionnaire_option_id'   => "",
                                            'input_answer'              => $arrData['question6'],
                                            'status'                    => 1
                                        ];

                $historyArr[]       = [
                                            'user_id'   => $intUserId,
                                            'bank_id'   => 0,
                                            'type'      => 'questionnaire0',
                                            'type_id'   => 6,
                                            'value'     => $arrData['question6'],
                                            'source'    => 'live'
                                        ];

            }
            foreach ($user_answers_arr as $key => $value) {
                $user_qa_history = [
                                        'user_id'                   => $intUserId,
                                        'bank_id'                   => 0,
                                        'type'                      => 'questionnaire0',
                                        'raw_data'                  => json_encode($value),
                                        'source'                    => 'live'
                                    ];
                UserQuestionnaireAnswersHistories::create($user_qa_history);
            }
            if ($historyArr) {
                FollowupHistories::insert($historyArr);
            }

            //User::whereId($intUserId)->update(array('is_qualified'=> $qualifiedLead));
            

            if ($split_info_id != null) {
                $intVisitorSlides   = new VisitorsSlide();
                $intVisitorSlides->name = 'slide_info';
                $intVisitorSlides->visitor_id = $intVisitorId;
                $intVisitorSlides->user_id = ($intUserId) ? $intUserId : null;
                $intVisitorSlides->split_id = $split_info_id;
                $intVisitorSlides->save();
                $slide_arr = array($slide1,$slide2,$intVisitorSlides->id);
                VisitorsSlide::whereIn('id',$slide_arr)
                    ->update(array('user_id'=> $intUserId));
            }
            $strResult          = "";
            $strResultMsg       = ""; 
            $posttocake         = 1;           
            $intResult          = ($strResult == 'Success') ? 1 : 0;
            $arrResult          = array(
                                        'result'        => $intResult, 
                                        'flag'          => $strResult, 
                                        'post_to_cake'  => $posttocake,
                                        'userId'        => $intUserId, 
                                        'msg'           => $strResultMsg,
                                        'isQualified'   => $is_qualified,
                                    );

            return $arrResult;
        } else {
            $arrUrlParams = array("visitor_id" => $intVisitorId,"user_email" => $arrData['email']);
            $this->redirectRepo->autoRedirect("web/thanx",$arrUrlParams);
        }
    }

    public function checkTaxPayer($intUserId)
    { 
        //Get tax payer
        $tax_payer = $this->getTaxPayer($intUserId);
        $lead_docs = LeadDoc::where('user_id',$intUserId)->first();
        if ($lead_docs) {
           if ($lead_docs->tax_payer == '' || $lead_docs->tax_payer == NULL) {
             $lead_docs->tax_payer = $tax_payer;
             $lead_docs->save();
           }
        } else {
           $tax_payer_arr = array('user_id'=> $intUserId,'tax_payer'=>$tax_payer);
           //Insert into tax payer table
           $this->addTaxPayer($tax_payer_arr);
        }
    }
    
    //Insert into tax payer table
    public function addTaxPayer($requestArr)
    {
        $add_tax_payer              = new LeadDoc();
        $add_tax_payer->user_id     = $requestArr['user_id'];
        $add_tax_payer->tax_payer   = $requestArr['tax_payer'];
        $add_tax_payer->save();
    }

    //get tax payer
    public function getTaxPayer($intUserId)
    {
        $getQuest2Answer        = UserQuestionnaireAnswers::whereUserId($intUserId)
                                    ->whereQuestionnaireId('2')
                                    ->first();
        $taxPayer               = '';
        if (!empty($getQuest2Answer)) {
            if ($getQuest2Answer->questionnaire_option_id =='4') {
                $taxPayer       = 'partner';
            } else {
                $taxPayer       = 'me';
            }
        }
        /*$getUserQuestAnswers    = DB::table('user_questionnaire_answers AS UQA' )
        ->Join('questionnaires AS Q', 'UQA.questionnaire_id', '=', 'Q.id' )
        ->leftJoin('questionnaire_options as QO', 'UQA.questionnaire_option_id', '=', 'QO.id' )
        ->select('UQA.id', 'UQA.user_id', 'UQA.questionnaire_id', 'UQA.questionnaire_option_id', 'Q.type', 'QO.value' )
        ->where('Q.type', '=', 'questionnaire0' )
        ->where('UQA.user_id', $intUserId )
        ->orderBy('UQA.questionnaire_id', 'ASC' )
        ->get();

        $taxPayer                = '';

        if ($getUserQuestAnswers->count() >0 ) {
            $question0Arr            = array();
            foreach ($getUserQuestAnswers as $userQuestAnswer ) {
                $question0Arr[$userQuestAnswer->questionnaire_id]    = $userQuestAnswer->value;
            }
            

            if (@$question0Arr[2] == 'Me' && @$question0Arr[3] == 'Yes' && @$question0Arr[5] == 'Yes' ) {
                $taxPayer            = 'me';
            } else if (@$question0Arr[2] == 'My Partner' && @$question0Arr[4] == 'Yes' && @$question0Arr[6] == 'Yes' ) {
                $taxPayer            = 'partner';
            } else if ((@$question0Arr[2] == 'Me' || @$question0Arr[2] == 'Partner' ) && (@$question0Arr[3] == 'Not Sure' || @$question0Arr[4] == 'Not Sure' ) && (@$question0Arr[5] == 'Not Sure' || @$question0Arr[6] == 'Not Sure')) {
                $taxPayer            = 'unsure';
            } else {
                $taxPayer            = 'unsure';
            }
        }*/
        
        return $taxPayer;
    }

    public function storeHistory($intUserId)
    {
        $getUserDetails = DB::table('users AS U')
                            ->leftJoin('user_extra_details AS UED','U.id',"=","UED.user_id")
                            ->leftJoin('user_spouses_details AS USD','U.id',"=","USD.user_id")
                            ->select('U.id','U.first_name','U.last_name','U.email','U.telephone','U.dob','UED.gender','UED.postcode','USD.spouses_first_name','USD.spouses_last_name','USD.dob AS spouses_dob','USD.date_of_marriage')
                            ->where('U.id','=',$intUserId)
                            ->first();
        if (!empty($getUserDetails)) {
            $followHistory  = new HistoryRepository();
            $liveSession    = new LiveSessionRepository();
            $followHistory->insertFollowupBasicHistory($getUserDetails);
            $liveSession->insertBasicLiveSession($getUserDetails);
        }
    }

    public function userDetails($userId)
    {
        $getUserDetails = DB::table('users AS U')
                            ->leftJoin('user_extra_details AS UED','U.id',"=","UED.user_id")
                            ->leftJoin('user_spouses_details AS USD','U.id',"=","USD.user_id")
                            ->leftJoin('signatures AS S','S.user_id','=','U.id')
                            ->select('U.id','U.first_name','U.last_name','U.email','U.telephone','U.dob','U.is_qualified','U.created_at','UED.gender','UED.housenumber', 'UED.town', 'UED.county', 'UED.country','UED.postcode','USD.spouses_first_name','USD.spouses_last_name','USD.dob AS spouses_dob','USD.date_of_marriage','S.signature_image')
                            ->where('U.id','=',$userId)
                            ->first();
        return $getUserDetails;
    }

    public function userQuestionnaireAnswers($userId)
    {
        $getUserQuestAnswers = DB::table('user_questionnaire_answers AS UQA')
                                ->leftJoin('questionnaires AS Q','UQA.questionnaire_id',"=","Q.id")
                                ->leftJoin('questionnaire_options AS QO','UQA.questionnaire_option_id',"=","QO.id")
                                ->select('Q.title','QO.value','Q.id')
                                ->where('UQA.user_id','=',$userId)
                                ->get();
        return $getUserQuestAnswers;
    }

    public function userCRM($userId)
    {
        $followHistory  = new HistoryRepository();
        $userCRMs       = $followHistory->userCRMHistory($userId);

        return $userCRMs;
    }

    public function userFollowup($userId)
    {
        $followHistory  = new HistoryRepository();
        $userFollowups  = $followHistory->userFollowHistory($userId);

        return $userFollowups;
    }

    public function BuyerPostingDetails($userId)
    {
        $buyerPostingDetails = DB::table('buyer_api_responses AS BAP')
                                ->leftJoin('buyer_details AS BD','BAP.buyer_id',"=","BD.id")
                                ->select('BAP.result','BD.buyer_name')
                                ->where('BAP.user_id','=',$userId)
                                ->get();

        return $buyerPostingDetails;    
    }

    public static function UpdateUserCarDetails($userId, $intVisitorId, $carRegNo)
    {
        
        $userVehicleId    =  null;
        $carRegNo         =  str_replace(' ','',$carRegNo);
        $user_split       = Visitor::select('split_id')
                                    ->where('id','=',$intVisitorId)
                                    ->first();
        $UserVehicle      = UserVehicleDetails::select('id')
                                    ->where('user_id','=',$userId)
                                    ->first();
        $param  =  "a";
        if(!isset($UserVehicle)){
            $param  .=  "-b";
            $VisitorCarData  = VehicleDataLookup::select('id','split_id','source','tr_smmt_range','make','engine_number','england_or_wales','model','fuel_type','registration_number','year_of_manufacture','tr_smmt_series','cherished_transfer_history','ma_vehicle_data','status')
                    ->where('source','=','LP')
                    // ->where('split_id','=',$user_split->split_id)
                    ->where('car_reg_no','=',$carRegNo)
                    ->where('visitor_id','=',$intVisitorId)
                    // ->where('status','=','1')
                    ->orderBy('id', 'DESC')
                    ->first();
            // VehicleDataLookup::whereId($VisitorCarData->id)->update(['user_id' => $userId]);
            if(isset($VisitorCarData)){
                $param  .=  "-c";
                $get_car_response         = VehicleDataLookup::select('ma_vehicle_data')
                ->where('car_reg_no', '=',$carRegNo)
                ->where('ma_vehicle_data', '!=',NULL)
                ->orderBy('id', 'DESC')
                ->first();
                if(!isset($get_car_response))
                {
                $param  .=  "-d";    
                $get_car_response         = UserVehicleDetails::select('ma_vehicle_data')
                ->where('car_reg_no', '=',$carRegNo)
                ->orderBy('id', 'DESC')
                ->where('ma_vehicle_data', '!=',NULL)
                ->first();  
                }
                        $user_car_data  = array('user_id'            =>  $userId,
                       'visitor_id'            =>  $intVisitorId,
                       'split_id'              =>  $VisitorCarData->split_id,
                       'source'                =>  $VisitorCarData->source,
                       'car_reg_no'            =>  $carRegNo,
                       'tr_smmt_range'         =>  $VisitorCarData->tr_smmt_range,
                       'make'                  =>  $VisitorCarData->make,
                        'engine_number'        =>  $VisitorCarData->engine_number,
                        'england_or_wales'=>$VisitorCarData->england_or_wales,
                        'model'=>$VisitorCarData->model,
                        'fuel_type'=>$VisitorCarData->fuel_type,
                        'registration_number'=>$VisitorCarData->registration_number,
                        'year_of_manufacture'=>$VisitorCarData->year_of_manufacture,
                        'tr_smmt_series'=>$VisitorCarData->tr_smmt_series,
                        'cherished_transfer_history'=>$VisitorCarData->cherished_transfer_history,
                        'status'                =>  $VisitorCarData->status,
                 'ma_vehicle_data' =>  isset( $get_car_response->ma_vehicle_data) ? $get_car_response->ma_vehicle_data:NULL,
                                    );
                                     
                $userVehicleId    = UserVehicleDetails::insertGetId($user_car_data);
            }
        }
        $user_flow_data  = array('user_id'            =>  $userId,
                       'visitor_id'                   =>  $intVisitorId,
                       'car_reg_no'                   =>  $carRegNo,
                       'vehicle_table_id'             =>  @$userVehicleId,
                       'type'                         =>  'UpdateUserCarDetails['.$param.']'
                   );
        $user_flow_id  =  UserFlowLog::insertGetId($user_flow_data);
        return $userVehicleId;
    }
}
