<?php

namespace App\Repositories\Interfaces;

interface FollowupInterface 
{
	public function getFollowupUserTransDetails($atp_sub2, $sqlField = '');
	// public function getFollowupUserQuestionAnswers($userId);
	// public function getFollowupUserBankDetails($userId);
	// public function getFollowupUserSignatureDetails($userId);
}