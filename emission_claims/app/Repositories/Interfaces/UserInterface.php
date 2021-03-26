<?php 

namespace App\Repositories\Interfaces;

interface UserInterface
{
	public function updateUserTimestamp($userId);
	public function isUserComplete($userId);
	public function isPartnerComplete($userId);
	public function isPdfDocComplete($userId);
	public function validLeadYear($userId);
	public function isQualified($userId);
	public function checkStatus($userId);
	public function user_completed_details($userId);
	public function getVisitorUserTransDetails($intVisitorId, $intUserId, $sqlField);
	public function insertIntoUser($intVisitorId, $arrData);
	public function insertBuyerApiResponse($intUserId, $arrData);
	public function insertBuyerApiResponseDetails($buyer_api_response_id,$arrData);
	public function getLeadId($intUserId);
	public function storeUser($request,$recordStatus);
	public function checkTaxPayer($intUserId);
	public function addTaxPayer($requestArr);
	public function getTaxPayer($intUserId);
	public function storeHistory($intUserId);
	public function userDetails($userId);
	public function userQuestionnaireAnswers($userId);
	public function userCRM($userId);
	public function userFollowup($userId);
	public function BuyerPostingDetails($userId);
}