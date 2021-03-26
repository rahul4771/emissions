<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use App\Models\FollowupHistories;
use App\Models\ApiHistory;
use App\Repositories\Interfaces\HistoryInterface;

class HistoryRepository implements HistoryInterface
{
    public function insertFollowupHistory($request)
    {
        FollowupHistories::create($request);
    }

    public function insertFollowupLiveHistory($request)
    {
        if ($request['type'] == "identification_type" || $request['type'] == "identification_image") {
            FollowupHistories::insert($request);
        } else {
            FollowupHistories::updateOrCreate(
                                                    [   
                                                        'user_id'   => $request['user_id'], 
                                                        'type'      => $request['type'],
                                                        'type_id'   => $request['type_id'],
                                                        'source'    => $request['source'],
                                                    ],
                                                    $request
                                                );
        }
        
    }

    public function arrayWalkBasic($value, $key, $extraParam) 
    {
        if ($extraParam[0] != $key) {
            $this->insertFollowupLiveHistory(array(
                                                        'user_id'   => $extraParam[1],
                                                        'type'      => $key,
                                                        'type_id'   => 0,
                                                        'source'    => 'live',
                                                        'value'     => $value
                                                    ));
        }
    }

    public function insertFollowupBasicHistory($request)
    {
        array_walk($request, array($this, 'arrayWalkBasic'), array('id', $request->id));
    }

    public function createApiHistory($request)
    {
        ApiHistory::create($request);
    }

    public function userCRMHistory($userId)
    {
        $userCRMs = FollowupHistories::where('user_id', $userId)
                        ->where('source', 'crm')
                        //->select('type_id','value')
                        ->orderBy('id', 'DESC')
                        ->get();

        return $userCRMs;
    }

    public function userFollowHistory($userId)
    {
        $userFollows = FollowupHistories::where('user_id', $userId)
                        ->where('source', 'FLP')
                        //->select('type_id','value')
                        ->orderBy('id', 'DESC')
                        ->get();

        return $userFollows;
    }
}