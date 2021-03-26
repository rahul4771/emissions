<?php 

namespace App\Repositories\Interfaces;

interface LiveSessionInterface
{
	public function insertBasicLiveSession($request);
	public function createUserMilestoneStats($request);
	public function createPartnerMilestoneStats($request);
	public function taxPayerQuestComplete($taxpayer,$userId,$source='live');
	public function partnerQuestComplete($taxpayer,$userId,$source='live',$page="");
	public function completedStatusUpdate($userId, $source = 'live');
	
}