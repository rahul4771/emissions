<?php 

namespace App\Repositories\Interfaces;

interface CommonSplitsInterface
{
	public function initSplit($request,$splitName);
	public function dynamicSplitAdd($strFileName, $splitPath);
	public function getSplitIdFromName($strSplitName, $intSiteFlagId);
}