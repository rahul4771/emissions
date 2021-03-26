<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\LeadDoc;
use App\Models\SiteConfig;
use App\Models\UserQuestionnaireStat;
use App\Models\UserQuestionnaireMeta;
use App\Models\UserQuestionnaireAnswers;
use App\Models\Questionnaire;
use App\Repositories\UserRepository;
use DB;
use App\Repositories\Interfaces\QuestionnairesInterface;

class QuestionnairesRepository implements QuestionnairesInterface
{
    public function __construct()
    {
        $this->userRepository = new userRepository();
    }

    public function isQuestionnaireComplete($userId)
    {
        $taxpayer = $this->userRepository->getTaxPayer($userId);
        if ($taxpayer == 'me') {
            $answerCount    = DB::table('questionnaires AS Q')
                                ->leftJoin('user_questionnaire_answers AS UQA', 'Q.id', '=', 'questionnaire_id')
                                ->where('UQA.user_id', '=', $userId)
                                ->where('Q.extra_param', '=', 'section2')
                                ->count();
        } elseif ($taxpayer=='partner') {
            $answerCount    = DB::table('questionnaires AS Q')
                                ->leftJoin('user_questionnaire_answers AS UQA', 'Q.id', '=', 'questionnaire_id')
                                ->where('UQA.user_id', '=', $userId)
                                ->where('Q.extra_param', '=', 'section1')
                                ->count();
        }
        if (@$answerCount > 3) {
            return 1;
        } else {
            return 0;
        }
    }

    public function isPartnerQuestionnaireComplete($userId)
    {
        $taxpayer       = $this->userRepository->getTaxPayer($userId);
        if ($taxpayer=='me') {
            $answerCount    = DB::table('questionnaires AS Q')
                                ->leftJoin('user_questionnaire_answers AS UQA', 'Q.id', '=', 'questionnaire_id')
                                ->where('UQA.user_id', '=', $userId)
                                ->where('Q.extra_param', '=', 'section1')
                                ->count();
        } elseif ($taxpayer=='partner') {
            $answerCount    = DB::table('questionnaires AS Q')
                                ->leftJoin('user_questionnaire_answers AS UQA', 'Q.id', '=', 'questionnaire_id')
                                ->where('UQA.user_id', '=', $userId)
                                ->where('Q.extra_param', '=', 'section2')
                                ->count();
        }
        if (@$answerCount > 3) {
            return 1;
        } else {
            return 0;
        }
    }

    public function isQuestionnairePageComplete ($userId)
    {
        $isQustComplete = $this->isQuestionnaireComplete($userId);
        $leadDoc        = LeadDoc::whereUserId($userId)->first();
        $bothNin        = 0;
        if (!empty($leadDoc)) {
            if (!empty($leadDoc->user_insurance_number) && !empty($leadDoc->spouses_insurance_number)) {
                $bothNin = 1;
            }
        }
        if ($bothNin == 1 && $isQustComplete ==1) {
            return 1;
        } else {
            return 0;
        }
    }

    public function createUserQuestionnaireStats($request)
    {
        UserQuestionnaireStat::updateOrCreate(
                                                    [   
                                                        'user_id'           => $request['user_id'],
                                                        'source'            => $request['source'],
                                                        'questionnaire_id'  => $request['questionnaire_id']
                                                    ],
                                                    $request
                                                );
    }

    public function getQuestionnaireVersion()
    {
        $strategydata   = SiteConfig::whereConfigInfo('questionnaire')->get(); 
        $url_array      = [];                    
        if (isset($strategydata) && $strategydata->count()>0) {
            $cnt = 0;
            foreach ($strategydata as $key => $value) {
                $url_array[$cnt]['config_title'] = $value->config_title;
                $url_array[$cnt]['config_value'] = $value->config_value;   
                $cnt++;
            }
        }
        $numerical_array = array();
        do {
            $index_key  = (mt_rand(1, 100));
            $numerical_array[$index_key]['config_title']           = '';
            $numerical_array[$index_key]['config_value']     = '';
        } while(count($numerical_array) < 100);
        $url_full_arry  = $this->getRandom($url_array, $numerical_array);
        $url            = $url_full_arry;

        return $url['config_title'];
    }

    public function getRandom($url_array, $numerical_array)
    {
        $winner         = (mt_rand(1, 100));
        $inital_value   = 0;
        $final_value    = 0;
        foreach ($url_array  as $key => $value) {
            $final_value    = $final_value + $value['config_value'];
            $output         = array_slice($numerical_array, $inital_value, $final_value, true);
            foreach ($output as $key1 => $value1) {
                $numerical_array[$key1]['config_title'] = $value['config_title'];
                $numerical_array[$key1]['config_value'] = $value['config_value'];
            }
            $inital_value     = $final_value;
        }
        return $numerical_array[$winner];
    }

    public function createquestionnaireMeta($request)
    {
        UserQuestionnaireMeta::updateOrCreate(
                                                    ['user_id' => $request['user_id']],
                                                    $request
                                                );
    }

    public function checkQuestionnaireVersion($userId)
    {
        $userQuestionnaireMeta = UserQuestionnaireMeta::whereUserId($userId)->first();
        if (!empty($userQuestionnaireMeta)) {
            return $userQuestionnaireMeta->version;
        } else {
            $questionnaireVersion   = $this->getQuestionnaireVersion();
            $questionnaireMeta      = $this->createquestionnaireMeta(array('user_id'=>$userId, 'version'=>$questionnaireVersion));
            return $questionnaireVersion;
        }
    }

    public function getPendingQuestions($user_id, $tax_type)
    {
        $user_questions = UserQuestionnaireAnswers::where('user_id', '=', $user_id)->pluck('questionnaire_id');
        if ($tax_type == "tax_payer") {
            $questionnaires = Questionnaire::with(['options'])
                                ->where('extra_param', '=', 'section2')
                                ->whereNotIn('id', $user_questions)
                                ->get();
        } else {
            $questionnaires = Questionnaire::with(['options'])
                                ->where('extra_param', '=', 'section1')
                                ->whereNotIn('id', $user_questions)
                                ->get();
        }
        $data['questionnaire'] = array();
        if ($questionnaires->count() >0) {
            foreach ($questionnaires as $key=>$questionnaire) {
               $data['questionnaire'][$key+1] = array(
                                                            'id'=>$questionnaire->id,
                                                            'title'=>$questionnaire->title,
                                                            'options' => $questionnaire->options
                                                        ); 
            }
        }
        return $data['questionnaire'];
    }
}
