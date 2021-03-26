<?php 

namespace App\Repositories\Interfaces;

interface RedirectInterface
{
	public function autoRedirect($namedRoute, $urlParams, $fl301Header);
	public function redirectToThankyouUnqualifiedPage($strFileName, $urlParams);
	public function redirectToSignPage($strFileName, $urlParams);
	public function redirectToConfirmPage($strFileName, $urlParams);
	public function redirectToPartnerConfirmPage($strFileName, $urlParams);
	public function redirectToConfirmPageDesktop($strFileName, $urlParams);
	public function redirectToThankyouPage($strFileName, $urlParams);
	public function fbPixelRedirect($url, $fl301Header);
	public function redirectToQuestionnaire($strFileName, $urlParams);
	public function redirectToFollowUpQuestionnaire($strFileName, $urlParams);
	public function partnerShareURL($strFileName, $urlParams);
	public function followupV2ShareURL($strFileName, $urlParams,$type);
	public function confirmURL($strFileName, $urlParams);
	public function v2ConfirmURL($strFileName, $urlParams);
	public function redirectToSharePage($strFileName, $urlParams);
}