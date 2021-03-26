<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HausfeldApiResponses;
use App\Models\UserVehicleDetails;
use App\Models\User;
use Carbon\Carbon;
use App\Repositories\LogRepository;

class BuyerResponseController extends Controller
{
    public function buyerApiResponse(Request $request)
    {   

        if ( isset($request->userid) && !is_integer($request->userid) ) {
            $userId     =   $request->userid;
            
            //$ifClientExist = HausfeldApiResponses::where( 'user_id', $userId )->where( 'status', 'success' )->where( 'api', 'clientCreateAPI' )->latest()->first();
            $ifClientExist = HausfeldApiResponses::where( 'user_id', $userId )->latest()->first();

            if ($ifClientExist) {
                /*
                $user_data  = User::join('user_extra_details', 'users.id', '=', 'user_extra_details.user_id')
                        ->join('visitors', 'users.visitor_id', '=', 'visitors.id')
                        ->where('users.id', $userId)
                        ->select('users.title', 'users.first_name', 'users.last_name', 'users.email', 'users.dob', 'users.telephone', 'users.is_qualified', 'users.created_at', 'users.recent_visit', 'users.response_result', 'visitors.ip_address','visitors.country as countryCode', 'visitors.user_agent','user_extra_details.postcode', 'user_extra_details.street','user_extra_details.town','user_extra_details.county', 'user_extra_details.country as user_country','user_extra_details.housenumber', 'user_extra_details.address', 'user_extra_details.gender','user_extra_details.housename' )
                        ->first();
                
                $createdAt = Carbon::parse($user_data->created_at);
                $user_created = $createdAt->format('Y-m-d');
            
                $createdAt = Carbon::parse($user_data->dob);
                $user_dob = $createdAt->format('Y-m-d');
            
                $address = $user_data->housenumber.', '.$user_data->street.', ' .$user_data->town.', '.$user_data->county.', '.$user_data->user_country;

                $userVehicleDetails = UserVehicleDetails::where('user_id',$userId)->first();
                if ($userVehicleDetails) {
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

                    $make       = $userVehicleDetailsJSON['DataItems']['ClassificationDetails']['Smmt']['Make'];
                    $vin        = $userVehicleDetailsJSON['DataItems']['VehicleRegistration']['Vin'];
                    $model      = $userVehicleDetails->tr_smmt_range;
                    $manufactur = $userVehicleDetails->year_of_manufacture;
                    $registration_number =  $userVehicleDetails->registration_number;
                } else {

                    $api_response = unserialize($ifClientExist->params);
                    $make = $api_response['claims'][0]['make'];
                    $model = $api_response['claims'][0]['model'];
                    $manufactur = $api_response['claims'][0]['manufactur'];
                    $vin = $api_response['claims'][0]['vin'];
                    $registration_number = $api_response['claims'][0]['registration_number'];
                    $owner = $api_response['claims'][0]['owner'];
                    $claim_from = $api_response['claims'][0]['claim_from'];
                }

                $formParams = [
                    'reference_id'          => $userId,
                    //'title'                   => $user_data->title,
                    'firstname'             => $user_data->first_name,
                    'lastname'              => $user_data->last_name,
                    'email_address'         => $user_data->email,
                    'phone_number'          => $user_data->telephone,
                    'created_date'          => $user_created,
                    'user_from'             => "LeadGen",
                    'dob'                   => $user_dob,

                    'ccode'                 => $user_data->countryCode,
                    //'terms_and_condition'     => 1,
                    //'receive_email'       => 1,
                    //'ipaddress'           => $user_data->ip_address,      
                    //'useragent'               => $user_data->user_agent,
                    'address'               => $address,
                    //'address_flat_number': "123",
                    'address_house_number'  => $user_data->housenumber,
                    'address_street'        => $user_data->street,
                    //'address_locality': "",
                    'address_city'          => $user_data->town,
                    'address_postcode'      => $user_data->postcode,
                    'address_state'         => $user_data->county,
                    'address_country'       => ($user_data->user_country=='England')?'UK':$user_data->user_country, //: "UK", 
                    //'user_status'             => $user_data->is_qualified,
                    //'user_status'             => 2,

                    'claims' => [
                        [
                        'make'          => $make,
                        'model'         => $model,
                        'manufactur'    => $manufactur,
                        'vin'           => $vin,
                        'registration_number'   => $registration_number,
                        'owner'         => 'current',
                        'claim_from'    => "LeadGen",

                        //'updated_date'     => $updated_date,
                        //'purchase_month' => $purchase_month,                   // 01 - 12
                        //'purchase_year"' => $purchase_year,                    // 2015 - 2021
                        //"vehicle_modified"=> $vehicle_modified,                // 1=Yes, 1=No
                        ],
                    ],
                ];
                */
                //print_r($ifClientExist);
                //echo $ifClientExist->api_response;

                $api_response = json_decode(unserialize($ifClientExist->api_response),true);
                $response  = $api_response;       

            } else {
                $response  = array('message'=>'User ID doesn\'t exist');
            }
        } else {
            $response  = array('message'=>'User ID doesn\'t exist');
        }
        
        // Write the contents back to the file
        $strFileContent = "\n----------\n Date: " . date('Y-m-d H:i:s') . "\n userId : $userId \n" . " response : ".serialize($response)." \n";
        $logRepo    = new LogRepository;
        $logWrite   = $logRepo->writeLog('-hausfeld_api_responses_by_user',$strFileContent);

        return response()->json( $response );
    }    
}