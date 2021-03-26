<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\UserMilestoneStats;
use App\Models\PartnerMilestoneStats;
use App\Repositories\QuestionnairesRepository;
use App\Repositories\Interfaces\LiveSessionInterface;
use DB;
// use App\Repositories\UserRepository;

class LiveSessionRepository implements LiveSessionInterface
{
    public function __construct()
    {
        $this->userRepository = new UserRepository;
    }

    public function insertBasicLiveSession($request)
    {
        if (!empty($request->spouses_first_name) && !empty($request->spouses_last_name) && !empty($request->spouses_dob)) {
            $this->createUserMilestoneStats(array(
                                                        'user_id'           => $request->id,
                                                        'partner_details'   => 1,
                                                        'source'            => 'live'
                                                    ));
        }
    }

    public function createUserMilestoneStats($request)
    {
        UserMilestoneStats::updateOrCreate(
            [    
                'user_id'   => $request['user_id'],
                'source'    => $request['source']
            ],
            $request
        );
    }

    public function createPartnerMilestoneStats($request)
    {
        PartnerMilestoneStats::updateOrCreate(
            [    
                'user_id'   => $request['user_id'],
                'is_share'  => $request['is_share']
            ],
            $request
        );
    }

    public function taxPayerQuestComplete($taxpayer, $userId, $source='live')
    {
        if ($taxpayer=='me') {
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
        if (@$answerCount==4) {
            $questionnaire_com = UserMilestoneStats::where('user_id',$userId)
                                    ->where('questions', 1)->first();
            if (empty($questionnaire_com)) {
                $this->createUserMilestoneStats(array('user_id'=>$userId, 'questions'=>1, 'source'=>$source));
            }
            if ($source=='live') {
                $questionRepo = new QuestionnairesRepository();
                $questionRepo->createquestionnaireMeta(array('user_id'=>$userId, 'status'=>1));
            }
        }
    }

    public function partnerQuestComplete($taxpayer, $userId, $source='live', $page="")
    {
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
        if (@$answerCount >= 4) {
            $patner_questionnaire_com = UserMilestoneStats::where('user_id', $userId)
                                            ->where('partner_questions', 1)->first();
            if (empty($patner_questionnaire_com)) {
                $this->createUserMilestoneStats(array('user_id'=>$userId, 'partner_questions'=>1, 'source'=>$source));
            }
            if ($page=='share') {
                $is_share = 1;
            } else {
                $is_share = 0;
            }
            $this->createPartnerMilestoneStats(array('user_id'=>$userId, 'partner_questions'=>1, 'source'=>$source, 'is_share'=>$is_share));
        }
    }

    public function completedStatusUpdate($userId, $source = 'live') // $person = user, partner, total 
    {
        if ($userId) {
            $user_completed_flag    = $partner_completed_flag = $time_now = $ums_db_column = $update_statement = $search_statement = "";
            $user_completed_flag    = $this->userRepository->isUserComplete($userId);
            $partner_completed_flag = $this->userRepository->isPartnerComplete($userId);
            $time_now               = Carbon::now();
            $people                 = array('user', 'partner', 'total');
            if ($source) {
                foreach ($people as $person) {
                    if ($person) {
                        switch ($person) {
                            case 'user':
                                $ums_db_column = "user_completed";
                                break;
                            case 'partner':
                                $ums_db_column = "partner_completed";
                                break;
                            case 'total':
                                $ums_db_column = "completed";
                                break;
                        }
                        $search_statement = DB::table('user_milestone_stats')
                                                ->where('user_id', $userId)
                                                ->whereRaw($ums_db_column." = 1")
                                                ->get();
                        $update_statement = DB::table('user_milestone_stats')
                                                ->where('user_id', $userId)
                                                ->where('source', $source)
                                                ->where('user_id', $userId)
                                                ->whereRaw("(".$ums_db_column." = 0 or ".$ums_db_column." is null)");
                        if (sizeof($search_statement) == 0) {
                            if ($user_completed_flag == 1 && $partner_completed_flag == 1 && $person == "total") {
                                // Update completed time and flag to user_milestone_stats table
                                $update_statement->update(['completed' => 1, 'completed_date'=> $time_now]);
                            } else if ($user_completed_flag == 1 && $person == "user") {
                                // Update user_completed time and flag to user_milestone_stats table
                                $update_statement->update(['user_completed' => 1, 'user_completed_date'=> $time_now]);
                            } else if ($partner_completed_flag == 1 && $person == "partner") {
                                // Update partner_completed time and flag to user_milestone_stats table
                                $update_statement->update(['partner_completed' => 1, 'partner_completed_date'=> $time_now]);
                            }
                        }
                    }
                }
            } else {
                return array('status' => 'error', 'response' => 'no source passed');
            }
        } else {
            return array('status' => 'error', 'response' => 'no user passed');
        }
    }
}