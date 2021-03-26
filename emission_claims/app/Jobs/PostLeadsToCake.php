<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\BuyerDetail;
use App\Models\User;
use Exception;
use App\Repositories\Interfaces\CakeInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\Interfaces\RedirectInterface;
use App\Repositories\Interfaces\EmailInterface;


class PostLeadsToCake implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
      protected $userId,$recordStatus;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($userId,$recordStatus)
    {
     
        $this->userId        = $userId;
        $this->recordStatus  = $recordStatus;
      
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(CakeInterface $cakeRepo, UserInterface $userRepo, EmailInterface $emailRepo,RedirectInterface $redirectRepo)
    {
        $post_to_cake = BuyerDetail::where('buyer_name','=','cake')
               ->where('status','=','1')
               ->first();  
         if(!empty($post_to_cake)) {
            // Function call to send user details into cake platform
            try {
                $arrCakeResult      = $cakeRepo->cakePost( $this->userId,$post_to_cake->id);
                $strLeadId          = '';
                $intLeadValue       = '00.00';
                $strPostingParam    = $arrCakeResult['posting_param'];
                $strPostingResponse = $arrCakeResult['posting_response'];
                $strResult          = "";
                $strErrorMessage    = "";
                if ($arrCakeResult['result'] == 'Success') {
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
                            if ($err_msg == 'No Qualified Buyers Found') {
                                $err_msg = 'Non-Success leads';
                            }
                        }
                    } 
                }
            } catch (Exception $e) {
                //exception here
                $emailRepo->fnSendGeneralMailAWS("Cake posting error", "Cake posting error ".$e->getMessage()."<br>User id :". $this->userId);
                $strThankyouPage = env('APP_URL').$redirectRepo->redirectToThankyouPage('web/thankyou',array("userId"=> $this->userId,"visitorId"=>$intVisitorId));
                return redirect($strThankyouPage);
            }
            $intLeadBuyerId                 = 1;
         $arrData= array( 'record_status'  => $this->recordStatus);
            $arrUserTransInfo               = array(
                                                        'leadBuyerId'       => @$intLeadBuyerId,
                                                        'leadValue'         => $intLeadValue,
                                                        'leadId'            => $strLeadId,
                                                        'result'            => $strResult,
                                                        'recordStatus'      => $arrData['record_status'],
                                                        'postingParam'      => $strPostingParam,
                                                        'postingResponse'   => $strPostingResponse,
                                                    );
            $intBuyerApiResponseId          =  $userRepo->insertBuyerApiResponse( $this->userId, $arrUserTransInfo);
            $intBuyerApiResponseDetailsId   =  $userRepo->insertBuyerApiResponseDetails($intBuyerApiResponseId, $arrUserTransInfo);

        }

    }
}
