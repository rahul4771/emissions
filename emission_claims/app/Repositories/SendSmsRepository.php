<?php

namespace App\Repositories;

use Illuminate\Http\Request;
use Config;
use DB;
use App\Models\Connection;

class SendSmsRepository
{
    function __construct()
    {

    }

    /*
     * Function to send SMS using esendex service
     * Return : (string) Success / Error
     */
    public function smsSendingStrategy($recipient,$adto_url,$data_Arr,$atp_url_id,$domain_id,$first_name = '',$strat_typ = '',$sms_creds,$sms_stage='')
    {
        $status = "SENT";
        $dataSMS  = DB::connection('mysql_adto_db')
                                              ->table('atp_redirect_urls')
                                              ->select('content')
                                              ->where('template_id','=',$atp_url_id)
                                              ->first();
        if(isset($dataSMS))
        {
  
            if($adto_url!='')
                $content = str_replace('{adtourl}', $adto_url,$dataSMS->content);
            else
                $content =   $dataSMS->content;
      
            if($first_name!='')
                $content = str_replace('{First Name}', $first_name,$content);
            else
                $content =   $content;
            
            //echo "<br/>";echo $content;echo "<br/>";
  
            $username   = $sms_creds['username'];
            $pwd        = $sms_creds['password'];
            $account    = $sms_creds['account'];
      
            $postdata   = 'username='.$username.'&account='.$account.'&password='.$pwd.'&recipient='.$recipient.'&body='.$content.'&plaintext=1';
            // echo $postdata;   

            // exit();
            ### new ###

            $ch = curl_init(); 
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt($ch, CURLOPT_URL,"https://www.esendex.com/secure/messenger/formpost/SendSMS.aspx");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            
            curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_ANY);
            curl_setopt($ch, CURLOPT_TIMEOUT, 10);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt($ch, CURLOPT_HTTPHEADER, array(
              'Accept: application/json',
              'Content-Length: ' . strlen($postdata))
              );
            $response = curl_exec($ch); 
            curl_close($ch);

            ### new end ###  
            
            // $response=""; 
            $data_Arr['status']     = $status;
            $data_Arr['response']   = $response;
            $data_Arr['atp_url_id'] = $atp_url_id;
            $data_Arr['domain_id']  = $domain_id;
            $user_token             = $data_Arr['token'];
            unset($data_Arr['token']);

            $insrt_id  = DB::connection('mysql_followup_db')
                    ->table('sms_scheduleds')
                    ->insertGetId($data_Arr);
  
            if($sms_stage!='') {
                $data_arr_stage['user_id']  = $data_Arr['user_id'];
                $data_arr_stage['token']    = $user_token;
                $data_arr_stage['stage']    = $sms_stage;
                $data_arr_stage['created_at'] = date('Y-m-d H:i:s');
                $insrt_id_2  = DB::connection('mysql_verticals')
                        ->table('followup_stages')
                        ->insertGetId($data_arr_stage);
            }
        }
    }
}