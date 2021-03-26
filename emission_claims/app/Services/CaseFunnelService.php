<?php

namespace App\Services;

use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use App\Models\User;
use App\Models\UserVehicleDetails;
//use App\Models\CasefunnelApiResponses;
use App\Models\HausfeldApiResponses;
use App\Repositories\LogRepository;
//use App\Helpers\LogClass;
use Carbon\Carbon;

use App\Jobs\HausfeldCakePosting;

class CaseFunnelService
{
	protected $client;
	protected $api_Test_Key;
	protected $api_Live_Key;
	protected $caseId;

	/**
	 * __construct
	 *
	 * @return void
	 */
	public function __construct()
   	{
		$this->client = new Client();
		$this->api_Test_Key = env("BUYER_API_KEY", 'lcjfYaXhHHZ9Uoe7YieV8oguNPRWq6M1fqcLjLK3');
		$this->api_Live_Key = env("BUYER_API_KEY", 'lUGxiJUhqu27uwkDkGwVz6j60Eo4Llbr1JOF8rhO');
		//$this->caseId = env("BUYER_CASE_ID", 'f674e6fe-1819-422b-a00e-e5f58e21245f');
	}

	/**
	 * Manages the buyer api call.
	 * 
	 * @return void
	 */
	public function buyerPost( $userId, $visitorId, $requestSource = null ) {

		$initialPingResponse = [];

		try {
			
			$ifClientExist = HausfeldApiResponses::where( 'user_id', $userId )->where( 'status', 'success' )->where( 'api', 'clientCreateAPI' )->latest()->first();

			if ( $ifClientExist ) {
				$initialPingResponse['status'] = $ifClientExist->status;
				$initialPingResponse['api_response'] = $ifClientExist->api_response;
				$api_response = json_decode(unserialize($ifClientExist->api_response),true);

				// if ($api_response['error']==0) {
				// 	$initialPingResponse['status'] 	= 'success';
				// 	$initialPingResponse['url'] 	= $api_response['url'];
				// } else {
				 	$initialPingResponse['status'] 	= 'error';
				 	$initialPingResponse['url'] 	= '';
				// }

			} else {
				$initialPingResponse = $this->clientCreateAPI( $userId, $visitorId );
				$api_response = json_decode(unserialize($initialPingResponse['api_response']),true);
				if ($api_response['error']==0) {
					$initialPingResponse['status'] 	= 'success';
					$initialPingResponse['url'] 	= $api_response['url'];
				} else {
					$initialPingResponse['status'] 	= 'error';
					$initialPingResponse['url'] 	= '';
				}

				$initialPingResponse['request_source'] = $requestSource;
				HausfeldApiResponses::create( $initialPingResponse );
			}
			
			if ($initialPingResponse['status'] && $initialPingResponse['status']=='error') {
				 $strFileContent = 'No redirection, user_id: '.$userId;
				 $logRepo    = new LogRepository;
	   			 $logRepo->writeLog('-casefunnel-service',$strFileContent);
			}
			//dd($initialPingResponse);
        	return $initialPingResponse;
			
		} catch (\Exception $e) {
			
			$logRepo    = new LogRepository;
            $logRepo->writeLog('-casefunnel-service',$e->getMessage());
		}

		return $initialPingResponse;
	}

	/**
	 * Creates a client.
	 * Email is the only required param for creating client.
	 * 
	 * @return array
	 */
	private function clientCreateAPI( $userId, $visitorId ) {

		$response = [
			'user_id' => $userId,
			'api' => 'clientCreateAPI',
		];
		
		try {

			// Client creation endpoint
			// POST https://devapi.mercedesemissionsclaim.co.uk/claim
			$url = 'https://devapi.mercedesemissionsclaim.co.uk/claim';

			$headers = [
				'Content-Type:application/json',
				'Accept:application/json',
				'X-api-key:'.$this->api_Test_Key,
			];

			$user_data  = User::join('user_extra_details', 'users.id', '=', 'user_extra_details.user_id')
                        ->join('visitors', 'users.visitor_id', '=', 'visitors.id')
                        ->where('users.id', $userId)
                        ->select('users.title', 'users.first_name', 'users.last_name', 'users.email', 'users.dob', 'users.telephone', 'users.is_qualified', 'users.created_at', 'users.recent_visit', 'users.response_result', 'visitors.ip_address','visitors.country as countryCode', 'visitors.user_agent','user_extra_details.postcode', 'user_extra_details.street','user_extra_details.town','user_extra_details.county', 'user_extra_details.country as user_country','user_extra_details.housenumber', 'user_extra_details.address', 'user_extra_details.gender','user_extra_details.housename','users.record_status' )
                        ->first();
            
			//$userDetails = User::find($userId);
			$createdAt = Carbon::parse($user_data->created_at);
			$user_created = $createdAt->format('Y-m-d');
			
			$createdAt = Carbon::parse($user_data->dob);
			$user_dob = $createdAt->format('Y-m-d');
            
			$address = $user_data->housenumber.', '.$user_data->street.', ' .$user_data->town.', '.$user_data->county.', '.$user_data->user_country;

			$userVehicleDetails = UserVehicleDetails::where('user_id',$userId)->first();
			$userVehicleDetailsJSON = json_decode($userVehicleDetails->ma_vehicle_data,true);
			
			$DateOfLastUpdate = Carbon::parse($userVehicleDetailsJSON['DataItems']['VehicleRegistration']['DateOfLastUpdate']);
			$updated_date = $DateOfLastUpdate->format('Y-m-d');

			$DateFirstRegistered = Carbon::parse($userVehicleDetailsJSON['DataItems']['VehicleRegistration']['DateFirstRegistered']);
			$purchase_month = $DateFirstRegistered->format('m');
			$purchase_year = $DateFirstRegistered->format('Y');

			$BodyShape = $userVehicleDetailsJSON['DataItems']['TechnicalDetails']['Dimensions']['BodyShape'];
			if ($BodyShape=='NA') {
				$vehicle_modified = 0;
			} else {
				$vehicle_modified = 1;
			}

			$make = $userVehicleDetailsJSON['DataItems']['ClassificationDetails']['Smmt']['Make'];
			$range = $userVehicleDetailsJSON['DataItems']['ClassificationDetails']['Smmt']['Range'];
			
			$accepted_model_check = ['ACLASS','BCLASS','CCLASS','CLA','CITAN','CLSCLASS','ECLASS','GCLASS','GLC','GLE','GLK','GLS350D','MCLASS','ML','SCLASS','SLK','SPRINTER','VCLASS','VITO'];
			$accepted_models = [
						'ACLASS' => 'A-CLASS',
						'BCLASS' => 'B-CLASS',
						'CCLASS' => 'C-CLASS',
						'CLA' => 'CLA',
						'CITAN' => 'CITAN',
						'CLSCLASS' => 'CLS CLASS',
						'ECLASS' => 'E-CLASS',
						'GCLASS'=> 'G-CLASS',
						'GLC' => 'GLC',
						'GLE' =>'GLE',
						'GLK' => 'GLK',
						'GLS350D' => 'GLS 350D',
						'MCLASS' => 'M CLASS',
						'ML' => 'ML',
						'SCLASS' => 'S-CLASS',
						'SLK' => 'SLK',
						'SPRINTER' => 'SPRINTER',
						'VCLASS' => 'V-CLASS',
						'VITO' => 'VITO',
						'Other' => 'Other'];

			$range_check = preg_replace('/[\s-]+/', '', $range);

			$model_value = 'Other';
			if(in_array($range_check,$accepted_model_check)) {
				$model_value = $accepted_models[$range_check];
			} else {
				$model_value = 'Other';
			}

			//dd($userVehicleDetailsJSON);

			$formParams = [
				'reference_id'			=> $userId,
				//'title'					=> $user_data->title,
				'firstname' 			=> $user_data->first_name,
				'lastname' 				=> $user_data->last_name,
				'email_address' 		=> $user_data->email,
				'phone_number'			=> $user_data->telephone,
				'created_date'			=> $user_created,
				'user_from'				=> "LeadGen",
				'dob'					=> $user_dob,

				'ccode'					=> $user_data->countryCode,
				//'terms_and_condition' 	=> 1,
				//'receive_email' 		=> 1,
				//'ipaddress' 			=> $user_data->ip_address,		
				//'useragent'				=> $user_data->user_agent,
				'address'				=> $address,
				//'address_flat_number': "123",
				'address_house_number'	=> $user_data->housenumber,
				'address_street'		=> $user_data->street,
				//'address_locality': "",
				'address_city'			=> $user_data->town,
				'address_postcode' 		=> $user_data->postcode,
				'address_state'			=> $user_data->county,
				'address_country'		=> ($user_data->user_country=='England')?'UK':$user_data->user_country, //: "UK", 
				//'user_status' 			=> $user_data->is_qualified,
				//'user_status' 			=> 2,

				'claims' => [
					[
					//'make'			=> $userVehicleDetails->make,
					//'make'			=> $userVehicleDetailsJSON['DataItems']['ClassificationDetails']['Smmt']['Make'],
					//'model'			=> $userVehicleDetails->tr_smmt_range,
					'make'			=> isset($make)?ucfirst(strtolower($make)):null,
					'model'			=> $model_value,
					'manufactur'	=> $userVehicleDetails->year_of_manufacture,
					'vin'			=> isset($userVehicleDetailsJSON['DataItems']['VehicleRegistration']['Vin'])?$userVehicleDetailsJSON['DataItems']['VehicleRegistration']['Vin']:null,
					'registration_number'	=> $userVehicleDetails->registration_number,
					'owner'			=> 'current',
					'claim_from'	=> "LeadGen",

					//'updated_date'	 => $updated_date,
					//'purchase_month' => $purchase_month,                   // 01 - 12
					//'purchase_year"' => $purchase_year,                    // 2015 - 2021
					//"vehicle_modified"=> $vehicle_modified,                // 1=Yes, 1=No
					],
				],
			];
			//dd($formParams);
			$record_status = $user_data->record_status;
			// sUCESSED api CALL	
			$responseBody = $this->sendToFunnelServe($formParams, $userId, $record_status);
			// dd($response);

			$userVehicleId            = null;
	        $user_vehicle             = UserVehicleDetails::select('id')
	                                            ->where('user_id',$userId)
	                                            ->where('visitor_id',$visitorId)
	                                            ->where('lead_id','=',NULL)
	                                            ->first();
	        if(isset($user_vehicle)){
	            $userVehicleId  =  $user_vehicle->id;
	        }

	        if(empty($buyer_id_info)){
	            if (env('APP_ENV') == 'live') {
	            	HausfeldCakePosting::dispatch($userId, $userVehicleId)->onQueue('PROD-HAUSFELD');
	            } elseif (env('APP_ENV') == 'pre') {
	            	HausfeldCakePosting::dispatch($userId, $userVehicleId)->onQueue('PRE-HAUSFELD');
	            } elseif (env('APP_ENV') == 'dev') {
	            	HausfeldCakePosting::dispatch($userId, $userVehicleId)->onQueue('DEV-HAUSFELD');
	            } elseif (env('APP_ENV') == 'local') {
	            	HausfeldCakePosting::dispatch($userId, $userVehicleId)->onQueue('DEV-HAUSFELD');
	            }
	        }

			$response['params'] = serialize($formParams);
			$response['url'] = $url;

			$response['status'] = 'success';
			$response['api_response'] = serialize($responseBody);

		// } catch (GuzzleException $e) {

		// 	$apiResponse = $e->getResponse();
		// 	$responseString = $apiResponse->getBody()->getContents();

		// 	$response['status'] = 'api_error';
		// 	$response['remark'] = $responseString;
			
		} catch (\Exception $e) {

			$response['status'] = 'exception';
			$response['remark'] = $e->getMessage();
		}
		
		return $response;
	}
	
	public function sendToFunnelServe( $postdata, $userId, $record_status ) {
        if ( $userId) {
            if($record_status == "LIVE"){
            	$curl_url = 'https://api.mercedesemissionsclaim.co.uk/claim';
            
	            $headers     = array(
	                'Content-Type:application/json',
	                'Accept:application/json',
	                'X-api-key:'.$this->api_Live_Key,
	            );
	        }else{
	        	$curl_url = 'https://devapi.mercedesemissionsclaim.co.uk/claim';
            
	            $headers     = array(
	                'Content-Type:application/json',
	                'Accept:application/json',
	                'X-api-key:'.$this->api_Test_Key,
	            );
	        }

            $postdata  = json_encode($postdata);
            
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $curl_url );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
            curl_setopt( $ch, CURLOPT_POST, true);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $postdata);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $response = curl_exec( $ch );
            curl_close ( $ch );
            return $response;
        } else {
            return json_encode( ['status' => 'error'] );
        }
    }	
}