<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Repositories\Interfaces\CakeInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\RedirectInterface;
use App\Repositories\Interfaces\EmailInterface;
use Exception;
use App\Models\UserVehicleDetails;
use App\Repositories\LogRepository;

class HausfeldCakePosting implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    protected $intUserId,$userVehicleId;

    public function __construct($intUserId, $userVehicleId = null)
    {
        $this->intUserId     = $intUserId;
        $this->userVehicleId = $userVehicleId;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CakeInterface $cakeRepo, UserInterface $userRepo, EmailInterface $emailRepo,RedirectInterface $redirectRepo)
    {
        $post_to_cake  = 1;
        
        $FileContent_new    = "\n-------------- Date: ".date('Y-m-d H:i:s');
        $FileContent_new    .= "\n-------------- User ID: ".$this->intUserId;
        $FileContent_new    .= "\n-------------- User Vehicle Id: ".$this->userVehicleId;
        $logFileName        ='_hausfeld_jobs';

        $logRepo    = new LogRepository;
        $logWrite   = $logRepo->writeLog($logFileName,$FileContent_new);
        // exit($FileContent_new);
        $checkBuyerApiId =  $userRepo->checkBuyerApiResponse( $this->intUserId);
        if ($post_to_cake == 1 && $checkBuyerApiId == 1) {

            // Function call to send user details into cake platform
            try {
                
                //$arrCakeResult      = CakeClass::cakePost($this->intUserId,1,$this->userVehicleId);
                $arrCakeResult      = $cakeRepo->cakePost($this->intUserId,1,$this->userVehicleId);
                //die("@@@@@@@@@@@");
                $strLeadId          = '';
                $intLeadValue       = '00.00';
                $strPostingParam    = $arrCakeResult['posting_param'];
                $strPostingResponse = $arrCakeResult['posting_response'];
                $strResult          = "";
                $strErrorMessage    =  "";
                if ($arrCakeResult['result'] == 'Success') {
                    if(isset($this->userVehicleId)){
                        UserVehicleDetails::whereId($this->userVehicleId)->update( ['lead_id' => $arrCakeResult['lead_id'], 'cake_flag' => '1']);
                    }
                    $strResult          = "Success";
                    $strLeadId          = $arrCakeResult['lead_id'];
                    $intLeadValue       = $arrCakeResult['lead_value'];
                    $strPostingParam    = $arrCakeResult['posting_param'];
                    $strPostingResponse = $arrCakeResult['posting_response'];
                } else if ($arrCakeResult['result'] == 'Other') {
                    //Send Mail as unhandle error occured
                    $strSubject         = 'CAKE: Unhandle error occured.';
                    $strContent         = "<p>Hello,<br><br> Unhandle Error Occurered.Below are details: <br><br>" . serialize($arrCakeResult) . "<br><br>Please have a look. <br>Thanks.</p>";

                    $strResult          = "Error";
                } else {
                    //Show error msg on form.
                    $strResult          = "Error";
                    $result_detail      = $arrCakeResult['result_detail'];
                    $arr_err            = $result_detail['errors'];

                    if (is_array($arr_err)) {
                        foreach ($arr_err as $k => $err_msg) {
                            if ($err_msg == 'No Qualified Buyers Found'){
                                $err_msg = 'Non-Success leads';
                            }
                        }
                    } 
                }
                
            } catch (Exception $e) {
                //exception here
                //EmailClass::fnSendGeneralMailAWS("Cake posting error", "Cake posting error ".$e->getMessage()."<br>User id :".$intUserId);
                $emailRepo->fnSendGeneralMailAWS("Cake posting error", "Cake posting error ".$e->getMessage()."<br>User id :". $this->intUserId);
                //$strThankyouPage        =   env('APP_URL').RedirectClass::redirectToThankyouPage('web/thankyou',array("userId"=>$this->intUserId,"visitorId"=>$intVisitorId));
                $strThankyouPage = env('APP_URL').$redirectRepo->redirectToThankyouPage('web/thankyou',array("userId"=> $this->intUserId,"visitorId"=>$intVisitorId));
                return redirect($strThankyouPage);

            }
            $intLeadBuyerId = 1;
            $arrUserTransInfo = array(
                'leadBuyerId'       => @$intLeadBuyerId,
                'leadValue'         => $intLeadValue,
                'leadId'            => $strLeadId,
                'result'            => $strResult,
                // 'recordStatus'      => $arrData['record_status'],
                'postingParam'      => $strPostingParam,
                'postingResponse'   => $strPostingResponse,
            );
         
            //$intBuyerApiResponseId = UserClass::insertBuyerApiResponse($this->intUserId, $arrUserTransInfo);
            $intBuyerApiResponseId =  $userRepo->insertBuyerApiResponse( $this->intUserId, $arrUserTransInfo);
            //$intBuyerApiResponseDetailsId = UserClass::insertBuyerApiResponseDetails($intBuyerApiResponseId, $arrUserTransInfo);
            $intBuyerApiResponseDetailsId   =  $userRepo->insertBuyerApiResponseDetails($intBuyerApiResponseId, $arrUserTransInfo);
            
        }
    }
}
