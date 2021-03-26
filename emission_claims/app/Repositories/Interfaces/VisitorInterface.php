<?php 

namespace App\Repositories\Interfaces;

interface VisitorInterface 
{
	public function saveVisitor($arrParam);
	public function defineTrackerType($arrParam);
	public function getVisitorUserTransDetails($intVisitorId, $intUserId, $sqlField = '');
	public function updateLastVisit($intVisitorId, $strFileName);
	public function updateScreenSize($intVisitorId, $resolution);


}