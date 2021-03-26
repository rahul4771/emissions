<?php

namespace App\Repositories;

use App\Repositories\CommonFunctionsRepository;
use App\Repositories\Interfaces\RedirectInterface;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Request;

class RedirectRepository implements RedirectInterface
{
    /**
    * Redirect to given named route
    *
    * @param  string $namedRoute
    * @param  array $urlParams
    * @return url
    */
    public function __construct()
    {
        $this->commonFunctionRepo = new CommonFunctionsRepository;
    }

    public function autoRedirect($namedRoute, $urlParams = array(), $fl301Header = false)
    { 
        if ($fl301Header) {
            if ( is_array($urlParams) && count($urlParams) > 0) {
                return redirect()->route($namedRoute, $urlParams, 301)->send();
            } else {
                return redirect()->route($namedRoute, [], 301)->send();
            }
        }
        if (is_array($urlParams) && count($urlParams) > 0) {
            return redirect()->route($namedRoute, $urlParams)->send();
        } else {
            return redirect()->route($namedRoute)->send();
        }
    }

    public function redirectToThankyouUnqualifiedPage($strFileName = 'confirm', $urlParams)
    {
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'vu_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId'])
                            );

        self::autoRedirect($strFileName, $arrUrlParams);
    }

    public function redirectToSignPage($strFileName = 'confirm', $urlParams)
    {
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'is_qualified'  => $urlParams['isQualified'],
                                'vu_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId'])
                            );

        self::autoRedirect($strFileName, $arrUrlParams);
    }

    public function redirectToConfirmPage($strFileName = 'signature', $urlParams)
    {
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'vu_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId'])
                            );

        self::autoRedirect($strFileName, $arrUrlParams);
    }


    public function redirectToPartnerConfirmPage($strFileName = 'signature', $urlParams)
    {
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'flp_visit_id'  => $urlParams['flp_visit_id'],
                                'vu_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId'])
                            );

        self::autoRedirect($strFileName, $arrUrlParams);
    }


    public function redirectToConfirmPageDesktop($strFileName = 'confirm', $urlParams)
    {
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'post_to_cake'  => $urlParams['postToCake'],
                                'vu_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId'])
                            );

        self::autoRedirect($strFileName, $arrUrlParams);
    }


    public function redirectToThankyouPage($strFileName = 'confirm', $urlParams)
    {
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'is_qualified'=> (isset($urlParams['isQualified'])?$urlParams['isQualified']:0),
                                'vu_id'         =>  $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId'])
                            );
        //return thankyou page url;
        $strRedirPage =  $this->commonFunctionRepo->creatURL($strFileName, $arrUrlParams);

        return $strRedirPage;
    }

    public function fbPixelRedirect($url, $fl301Header = false)
    {
        if ($fl301Header) {
            header( 'HTTP/1.1 301 Moved Permanently');
        }
        header( 'Location: ' .$url);
        exit();
    }

    public function redirectToQuestionnaire($strFileName, $urlParams)
    {
        if(isset($urlParams['page'])) {
            $page = $urlParams['page'];
        } else {
            $page = '';
        }
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'vu_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId']),
                                'source'        => $urlParams['source'],
                                'page'          => $page
                            );

        self::autoRedirect($strFileName, $arrUrlParams);
    }

    public function redirectToFollowUpQuestionnaire($strFileName, $urlParams)
    { 
        if (isset($urlParams['page'])) {
            $page = $urlParams['page'];
        } else {
            $page = '';
        }
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'source'        => $urlParams['source'],
                                'flp_visit_id'  => $urlParams['flp_visit_id'],
                                'vu_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId']),
                                'page'          => $page,
                            );

        self::autoRedirect($strFileName, $arrUrlParams);
    }

    public function partnerShareURL($strFileName, $urlParams)
    {
        if (isset($urlParams['page'])) {
            $arrUrlParams = array(
                                    'user_id'       => $urlParams['user_tocken'],
                                    'visitor_id'    => $urlParams['visitor_id'],
                                    'uv_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitor_id'] . config( 'constants.VU_SEPARATOR') . $urlParams['user_id']),
                                    'source'        => $urlParams['source'],
                                    'flp_visit_id'  => $urlParams['flp_visit_id'],
                                    'page'          => $urlParams['page']
                                );
        } else {
            $arrUrlParams = array(
                                    'user_id'       =>$urlParams['user_tocken'],
                                    'visitor_id'    =>$urlParams['visitor_id'],
                                    'uv_id'         =>$this->commonFunctionRepo->base64url_encode($urlParams['visitor_id'] . config( 'constants.VU_SEPARATOR') . $urlParams['user_id']),
                                    'source'        =>$urlParams['source'],
                                    'flp_visit_id'  =>$urlParams['flp_visit_id']
                                );
        }
        $share_url = route($strFileName, $arrUrlParams);

        return $share_url;
    }


    public function followupV2ShareURL($strFileName, $urlParams,$type)

    {
        $arrUrlParams   = array(
                                    'user_id'       => $urlParams['user_id'],
                                    'visitor_id'    => $urlParams['visitor_id'],
                                    'source'        => $urlParams['source'],
                                    'page'          => $urlParams['page'],
                                    'user_type'     => $type
                                );
        $share_url      = route($strFileName, $arrUrlParams);

        return $share_url;
    }

    public function confirmURL($strFileName, $urlParams)
    {
        $arrUrlParams   = array(
                                    'user_id'       => $urlParams['user_id'],
                                    'visitor_id'    => $urlParams['visitor_id'],
                                    'uv_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitor_id'] . config( 'constants.VU_SEPARATOR') . $urlParams['user_id'])
                                );
        $share_url      = route($strFileName, $arrUrlParams);

        return $share_url;
    }

    public function v2ConfirmURL($strFileName, $urlParams)
    { 
       $arrUrlParams    = array(
                                    'user_id'       => $urlParams['user_id'],
                                    'visitor_id'    => $urlParams['visitor_id'],
                                    'flp_visit_id'  => $urlParams['flp_visit_id'],
                                    'source'        => $urlParams['source']
                                );
        $share_url      =   route($strFileName, $arrUrlParams);

        return $share_url;
    }

    public function redirectToSharePage($strFileName, $urlParams)
    { 
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'flp_visit_id'  => @$urlParams['flp_visit_id'],
                                'source'        => $urlParams['source'],
                                'vu_id'         => $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId']),
                            );

        self::autoRedirect($strFileName, $arrUrlParams);
    }

    public function redirectToPage($strFileName = 'confirm', $urlParams)
    {
        $arrUrlParams = array(
                                'user_id'       => $urlParams['userId'],
                                'visitor_id'    => $urlParams['visitorId'],
                                'is_qualified'  => $urlParams['isQualified'],
                                'vu_id'         =>  $this->commonFunctionRepo->base64url_encode($urlParams['visitorId'] . config( 'constants.VU_SEPARATOR') . $urlParams['userId'])
                            );
        //return thankyou page url;
        $strRedirPage =  $this->commonFunctionRepo->creatURL($strFileName, $arrUrlParams);

        return $strRedirPage;
    }
}