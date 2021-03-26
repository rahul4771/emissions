<?php

namespace App\Http\Controllers\Ajax;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\CommonFunctionsInterface;
use App\VisitorsSlide;
use App\User;
use App\LeadDoc;
use App\UserQuestionnaireAnswers;
use App\Repositories\Interfaces\LogInterface;
use App\Repositories\Interfaces\ValidationInterface;
use App\Repositories\Interfaces\VisitorInterface;

use App\Repositories\Interfaces\EmailInterface;
use App\Models\Visitor;
use App\Models\UserVehicleDetails;
use App\Models\VehicleDataLookup;
use Carbon\Carbon;

class AjaxController extends Controller 
{  
    public function __construct(LogInterface $logRepo, VisitorInterface $visitorRepo,ValidationInterface $validationRepo,CommonFunctionsInterface $commonFunctionRepo, EmailInterface $emailRepo)
    {
        $this->validationRepo = $validationRepo;
        $this->logRepo        = $logRepo;
        $this->visitorRepo    =  $visitorRepo;
        $this->commonFunctionRepo   = $commonFunctionRepo;
        $this->emailRepo            = $emailRepo;
    }
    
 
    public function postcodeValidation( Request $request ) {
     
        $strPostCode 	 = 	$request->postcode;
        $intVisitorId 	 = 	$request->visitor_id;
        $strPostCode 	 = 	strtoupper( str_replace( ' ', '', $strPostCode ) );
        if ( $strPostCode ) {
            $strPostalResult 	 = $this->validationRepo->CheckPostalCodeTpApi( $strPostCode, $intVisitorId );
            if ( $strPostalResult == 'Error' ) {
                echo 0;
            } else {
                echo 1;
            }
        }
    }

    public function getAjaxEmailVal( Request $request ) {

        $strEmail    =   $request->Email;
        $intVisitorId   =   $request->visitor_id;
        if ( isset( $request->product ) ) {
            $product = $request->product;
        } else {
            $product =  null;
        }
        $strEmail    =   strtoupper( str_replace( ' ', '', $strEmail ) );

        if ( $strEmail ) {
            $strPostalResult    = $this->validationRepo->CheckValidEmail( $strEmail, $intVisitorId, $product );
            if ( !$strPostalResult ) {
                echo 1;
            } else {
                echo 0;
            }
        }
    }

    public function getUserIdUsingEmail( Request $request ) {

        $strEmail    =   $request->Email;
        $strEmail    =   strtoupper( str_replace( ' ', '', $strEmail ) );

        if ( $strEmail ) {

            $strPostalResult    = User::where( 'email', '=', $strEmail )->orderBy( 'id', 'DESC' )->first()->id;
            if ( !$strPostalResult ) {
                echo null;

            } else {
                echo $strPostalResult;
            }
        }
    }

    public function XMLStart( $parser, $name, $attrib ) {
        global $currentElement;
        $currentElement = $name;
        //We need the name of the element to be available to the character data
        //handler. $currentElement can now be used in the XMLElements function
    }

    public function getAddrListPostCodeAPI( Request $request ) {
        $getpostcode 	 = 	$request->postcode;
        $visitor_id 	 = 	$request->visitor_id;
        $datakey 		 =  $this->commonFunctionRepo->getDataKey( $visitor_id );
        if ( empty( $datakey ) ) {
            $datakey = config( 'constants.DATA_KEY_LIVE' );
        }
        $arrResult 		 = array();
        $getpostcode 	 = str_replace( ' ', '', $getpostcode );
        $str_simplyserver = 'http://www.simplylookupadmin.co.uk/xmlservice';
        $XMLService 	 = $str_simplyserver . '/SearchForAddress.aspx?datakey=' . $datakey . '&postcode=' . $getpostcode;

        $Content = '';
        if ( $getpostcode == '' ) {
            $Content = '<option value="">Please enter a Postcode!</option>';
        } else {
            $data_array = array();
            $addressXml = simplexml_load_file( $XMLService );
            if ( isset( $addressXml->addressdata->records ) ) {
                $data_obj = $addressXml->addressdata->records;
                $data_array = json_decode( json_encode( ( array ) $data_obj ), 1 );
            }

            $data_array1 = array();
            if ( !isset( $data_array['record'][0] ) ) {
                $data_array1[0] = $data_array['record'];
                unset( $data_array );
                $data_array['record'][0] = $data_array1[0];
            }

            $Content = '<option value="">Please Select Address</option>'.$Content;
            foreach ( $data_array['record'] as $key => $value ) {
                $Content .= '<option value="'.$value['id'].'">'.$value['line'].'</option>';
            }

            $Content .= '';
            echo $Content;
            die();
        }
    }

    public function getAjaxPhoneVal( Request $request ) {

        $strTelephone    =   $request->phonenumber;
        $intVisitorId     =   $request->visitor_id;

        $strTelephone    =   preg_replace( '/[^0-9]/', '', $strTelephone );

        if ( isset( $request->product ) ) {
            $product = $request->product;
        } else {
            $product =  null;
        }

        if ( $strTelephone ) {
            $str_tel_result =$this->validationRepo->CheckValidPhoneNumberApi( $strTelephone, $intVisitorId );

            if ( !preg_match( '/success/i', $str_tel_result ) ) {
                echo 0;
            } else {
                $today_date = date( 'Y-m-d' );

                if ( $this->validationRepo->checkPhoneDuplicate( $strTelephone ) ) {
                    echo 2;
                } else {
                    echo 1;
                }
            }
        }
    }

    public function getAddrSplitPostCodeAPI( Request $request ) {

        $visitor_id             = $request->visitor_id;
        $AddressID              = $request->AddressID;
        $getpostcode            = $request->postcode;
        $arrResult              = array();
        $arrResult['paf_id']    = $AddressID;
        $datakey                =  $this->commonFunctionRepo->getDataKey( $visitor_id );
        $simplyserver           = 'http://www.simplylookupadmin.co.uk/xmlservice';
        $XMLService             = $simplyserver . '/GetAddressRecord.aspx?datakey=' . $datakey . '&id=' . $AddressID;

        ##Open the XML Document##
        $data = array();
        $XMLData =  simplexml_load_file( $XMLService );

        $data = json_decode( json_encode( $XMLData->record ), 1 );

        ##Close the XML file and free the parser##
        foreach ( $data as $key => $value ) {
            if ( is_array( $data[$key] ) ) {
                if ( count( $data[$key] ) == 0 ) {
                    $data[$key] = '';
                } else {
                    $data[$key] = implode( ',', $data[$key] );
                }
            }
        }

        $Company                = @$data['organisation'];
        $Line1                  = @$data['line1'];
        $Line2                  = @$data['line2'];
        $Line3                  = @$data['line3'];
        $Town                   = @$data['town'];
        $County                 = @$data['county'];
        $Postcode               = @$data['postcode'];
        $Country                = @$data['country'];
        $udprn                  = @$data['udprn'];
        $deliverypointsuffix    = @$data['deliverypointsuffix'];
        $pz_mailsort            = @$data['pz_mailsort'];

        // Function call for update search details
        // $objAjax->objGeneral->addUpdatePLASDetails( $visitor_id, $AddressID, $arrResult );
        $dataArray = array( 'Company' =>$Company,
        'Line1'                  =>$Line1,
        'Line2'                  =>$Line2,
        'Line3'                  =>$Line3,
        'Town'                   =>$Town,
        'County'                 =>$County,
        'Udprn'                  =>$udprn,
        'deliverypointsuffix'    =>$deliverypointsuffix,
        'pz_mailsort'            =>$pz_mailsort,
        'Country'                =>$Country );

        // Write the contents back to the file
        $strFileContent = '\n----------\n Date: ' . date( 'Y-m-d H:i:s' ) . "\n Postcode: $getpostcode \n AddressID : $AddressID \n visitor_id: $visitor_id \n Content : " . json_encode( $dataArray ) . '  \n';

        //Function call for write log
        // MAIN::writeLog( 'getaddresslistPostcodesplit', $strFileContent );
    
        $logWrite   =$this->logRepo->writeLog( '-getaddresslistPostcodesplit', $strFileContent );

        return response()->json( $dataArray );

    }

    public function updateScreenSize( Request $request ) {

        $resolution     = $request->dimention;
        $intVisitorId   = $request->visitor_id;
        $result         = $this->visitorRepo->updateScreenSize( $intVisitorId, $resolution );
        echo $result;
    }

    public function usersFeedback( Request $request ) {
        $name             = $request->name;
        $message          = $request->message;
        $sentryLastID     = $request->sentryLastID;

        if ( $name && $message ) {
            $curl_url = 'http://sentry.spicy-tees.in/api/0/projects/vandalay/laratest/user-feedback/';

            // USER FEEDBACK SENTRY API PROCESSING
            $header     = array(
                'Content-Type:application/json',
                'Authorization: Bearer d49611e77c24480298453efb34160615234051d51f8e41f9881e89f2db611830'
            );

            $postdata   = '{
                            "comments": "'.$message.'",
                            "email": "developers@vandalayglobal.com",
                            "event_id": "'.$sentryLastID.'",
                            "name": "'.$name.'"


                        }';
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, $curl_url );
            curl_setopt( $ch, CURLOPT_POSTFIELDS, $postdata );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
            curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
            $response = curl_exec( $ch );
            curl_close ( $ch );
            return $response;
        } else {
            return json_encode( ['eventID' => ''] );
        }
    }

    public function VisitorSlidesStores( Request $request ) {
        if ( isset( $request->name, $request->visitor_id, $request->split_id ) && $request->name && $request->visitor_id && $request->split_id ) {
            $intVisitorSlides   =  new VisitorsSlide();
            $intVisitorSlides->name = $request->name;
            $intVisitorSlides->visitor_id = $request->visitor_id;
            $intVisitorSlides->user_id = ( $request->user_id ) ? $request->user_id : null;
            $intVisitorSlides->split_id = $request->split_id;
            $intVisitorSlides->save();
            $output = $intVisitorSlides->id;
        } else {
            $output =   array(
                'response'  => 'params missing'
            );
        }

        return json_encode( $output );
    }

    public function carregnoValidation( Request $request ) {

        $carRegNo               = $request->carRegNo;
        $visitor_id             = $request->visitor_id;
        $user_id                = $request->user_id;
        $source                 = $request->source;
        $Colour                 = null;
        $YearOfManufacture      = null;
        $DateFirstRegistered    = null;
        $Make                   = null;
        $MakeModel              = null;
        $Co2Emissions           = null;
        $FuelType               = null;
        $NominalEngineCapacity  = null;
        $TR_SMMT_Range          = null;
        $EngineNumber           = null;
        $EngineCode             = null;
        $RegistrationNumber     = null;
        $TR_SMMT_Series         = null;
        $CherishedTransferHistory  = null;
        $Model                  = null;


        $user_split             = Visitor::select('split_id')
                                    ->where('id','=',$visitor_id)
                                    ->first();
        $car_val_check          = UserVehicleDetails::select('id')
                                        // ->where('car_reg_no', '=', $carRegNo)
                                        // ->where('lead_id', '!=', NULL)

                                        ->where('car_reg_no', '=', $carRegNo)
                                        // ->where('buyer_api_flag', '=', '1') 
                                        ->where('lead_id', '!=', NULL)
                                        ->first(); 
        $car_val_check          = null;                                        
        
        if(!isset($car_val_check)){
            $car_lookup             = $this->carregnumLookup($carRegNo);
            if($car_lookup['validity'] == 0){
                $auth_apikey            = config('constants.VEHICLE_DATA_KEY');
                $simplyserver           = 'https://uk1.ukvehicledata.co.uk/api/datapackage/VehicleData?v=2&api_nullitems=1&auth_apikey=' . $auth_apikey . '&user_tag&key_VRM='.$carRegNo;
               

                ##Open the XML Document##
                $data = array();

                $arrContextOptions=array(
                                    "ssl"=>array(
                                        "verify_peer"=>false,
                                        "verify_peer_name"=>false,
                                    ),
                                );
                $data = file_get_contents(htmlspecialchars_decode($simplyserver),false,stream_context_create($arrContextOptions));
                
                $json_data = json_decode($data, true);
                $toEmail   = "accounts@yourlondonbridge.com";
                $EmailSub   = "UK Vehicle data lookup limit reminder";
                $EmailMsg   = "Your API lookup limit is going to exceed soon";
                try {
                    if(isset($json_data['BillingAccount']['AccountBalance'])){
                        $ukAccBal  = $json_data['BillingAccount']['AccountBalance'];
                        if($ukAccBal >= 50 && $ukAccBal <= 51){
                             //EmailClass::fnSendGeneralMailAWS($EmailSub, $EmailMsg, $toEmail);
                             $emailRepo->fnSendGeneralMailAWS($EmailSub, $EmailMsg, $toEmail);
                             $strFileContent = '\n----------\n Date: ' . date( 'Y-m-d H:i:s' ) . "\n Acc Balance : " . json_encode( $json_data['BillingAccount'] ) . '  \n To email : '. $toEmail; 
                             //$logWrite   = LogClass::writeLog( 'UKVehicleLookupCreditNotification', $strFileContent );
                             $logWrite =$this->logRepo->writeLog('UKVehicleLookupCreditNotification', $strFileContent );
                        }else if($ukAccBal >= 20 && $ukAccBal <= 21){
                            //EmailClass::fnSendGeneralMailAWS($EmailSub, $EmailMsg, $toEmail);
                            $emailRepo->fnSendGeneralMailAWS($EmailSub, $EmailMsg, $toEmail);
                            $strFileContent = '\n----------\n Date: ' . date( 'Y-m-d H:i:s' ) . "\n Acc Balance : " . json_encode( $json_data['BillingAccount'] ) . '  \n To email : '. $toEmail; 
                            //$logWrite   = LogClass::writeLog( 'UKVehicleLookupCreditNotification', $strFileContent );
                            $logWrite =$this->logRepo->writeLog('UKVehicleLookupCreditNotification', $strFileContent );
                        }
                    }
                } catch (Exception $e) {
                    //LogClass::writeLog('-error-log', $e->getMessage());
                    $logWrite   =$this->logRepo->writeLog('-error-log', $e->getMessage());
                    return true;
                }
                
                $response_data = json_encode($json_data['Response']);
                
                // $EngineNumber=$Model=$RegistrationNumber=$TR_SMMT_Range=$TR_SMMT_Series=$CherishedTransferHistory=NULL;

                if($json_data['Response']['StatusCode'] == 'Success'){
                    foreach ( $json_data['Response']['DataItems'] as $key => $value ) {
                        if ( $key == "VehicleRegistration" ) {
                            foreach ( $value as $key2 => $value2 ){
                                if ($key2 == "YearOfManufacture" && ($value2!=0 || $value2!=null || $value2!='')) {
                                    //$YearOfManufacture = $value2;
                                    $YearOfManufacture = 1;
                                } elseif ($key2 == "DateFirstRegisteredUk") {
                                    $DateFirstRegistered    = Carbon::parse($value2);
                                    $YearOfManufacture      = $DateFirstRegistered->format('Y');
                                } elseif ($key2 == "YearMonthFirstRegistered") {
                                    $pos = strrpos($value2 , "-");
                                    if ($pos !== false) {
                                        $YearOfManufacture = substr($value2, 0, $pos);
                                    } else {
                                        $YearOfManufacture = $value2;
                                    }
                                } 
                                // elseif ($key2 == "Make"){
                                //     $Make = $value2;
                                // }  
                                elseif ($key2 == "EngineNumber"){
                                    $EngineNumber = $value2;
                                } 
                                elseif ($key2 == "Model"){
                                    $Model = $value2;
                                }
                                elseif ($key2 == "Vrm"){
                                    $RegistrationNumber = $value2;
                                }
                                                              
                            }
                        } elseif ( $key == "SmmtDetails" ) {
                            foreach ( $value as $key2 => $value2 ){
                                if ($key2 == "FuelType"){ 
                                   $FuelType = $value2;
                                } 
                                // elseif ($key2 == "Range"){
                                //     $TR_SMMT_Range = $value2;
                                // }
                                elseif ($key2 == "Series"){
                                    $TR_SMMT_Series = $value2;
                                }                               
                            }
                        } elseif ( $key == "ClassificationDetails" ) {
                            foreach ( $value as $key2 => $value2 ){
                                if ($key2 == "Smmt"){ 
                                   $TR_SMMT_Range = $value2['Range'];   
                                   $Make = $value2['Make'];   
                                } 
                            }
                        }
                    }

                    $CherishedTransferHistory=json_encode($json_data['Response']['DataItems']['VehicleHistory']);


                    if(strpos($Make, "MERCEDES") !== false){
                        $validity = '1';
                        if($source == 'CRN'){
                            $user_vehicle_data    = array(
                                        'user_id'               =>  $user_id,
                                        'visitor_id'            =>  $visitor_id,
                                        'split_id'              =>  $user_split->split_id,
                                        'source'                =>  $source,
                                        'car_reg_no'            =>  $carRegNo,
                                        'tr_smmt_range'         =>  $TR_SMMT_Range,
                                        'make'                  =>  $Make,
                                        'engine_number'         =>  $EngineNumber,
                                        'england_or_wales'      =>  NULL,
                                        'model'                 =>  $Model,
                                        'fuel_type'             =>  $FuelType,
                                        'registration_number'   =>  $RegistrationNumber,
                                        'year_of_manufacture'   =>  $YearOfManufacture,
                                        'tr_smmt_series'        =>  $TR_SMMT_Series,
                                        'cherished_transfer_history'=>$CherishedTransferHistory,
                                        'ma_vehicle_data'       =>  $response_data,
                                        'status'                =>  $validity,
                                        ); 
                            $userVehicleId    = UserVehicleDetails::insertGetId($user_vehicle_data);
                        } 

                    }
                    else{
                        $validity = '2';
                    }
                } else { 
                    $validity = '0';
                }

                $VehicleData                        =  new VehicleDataLookup();
                $VehicleData->user_id               =  $user_id;
                $VehicleData->visitor_id            =  $visitor_id;
                $VehicleData->split_id              =  $user_split->split_id;
                $VehicleData->source                =  $source;
                $VehicleData->car_reg_no            =  $carRegNo;
                $VehicleData->tr_smmt_range         =  $TR_SMMT_Range;
                $VehicleData->make                  =  $Make;
                $VehicleData->engine_number         =  $EngineNumber;
                $VehicleData->england_or_wales      =  NULL;
                $VehicleData->model                 =  $Model;
                $VehicleData->fuel_type             =  $FuelType;
                $VehicleData->registration_number   =  $RegistrationNumber;
                $VehicleData->year_of_manufacture   =  $YearOfManufacture;
                $VehicleData->tr_smmt_series        =  $TR_SMMT_Series;
                $VehicleData->cherished_transfer_history = $CherishedTransferHistory;
                $VehicleData->ma_vehicle_data       =  $response_data;
                $VehicleData->status                =  $validity;
                $VehicleData->save();
                // Write the contents back to the file
                $strFileContent = '\n----------\n Date: ' . date( 'Y-m-d H:i:s' ) . "\n Content : " . json_encode( $json_data ) . '  \n'; 
                //Function call for write log
                //$logWrite   = LogClass::writeLog( '-getUserDataListCarRegNumAPI', $strFileContent );
                $logWrite =$this->logRepo->writeLog( '-getUserDataListCarRegNumAPI', $strFileContent );
            } else if($car_lookup['validity'] == 1) {
                $validity = '1';
                $vehicleData = $car_lookup['vehicleData'];

                // echo '<pre>';          
                // print_r($vehicleData);
                // exit();

                $TR_SMMT_Range          =  $vehicleData['tr_smmt_range'];
                $Make                   =  $vehicleData['make'];
                $EngineNumber           =  $vehicleData['engine_number'];
                $EnglandOrWales         =  $vehicleData['england_or_wales'];
                $Model                  =  $vehicleData['model']; 
                $FuelType               =  $vehicleData['fuel_type'];
                $RegistrationNumber     =  $vehicleData['registration_number'];
                $YearOfManufacture      =  $vehicleData['year_of_manufacture'];
                $TR_SMMT_Series         =  $vehicleData['tr_smmt_series'];
                $CherishedTransferHistory= $vehicleData['cherished_transfer_history'];
                $ma_vehicle_data        =  $vehicleData['ma_vehicle_data'];
                $response_data=$ma_vehicle_data;


                if($source == 'CRN') {
                    $user_vehicle_data    = array('user_id'      =>  $user_id,
                                 'visitor_id'            =>  $visitor_id,
                                 'split_id'              =>  $user_split->split_id,
                                 'source'                =>  $source,
                                 'car_reg_no'            =>  $carRegNo,
                                 'TR_SMMT_Range'         =>  $TR_SMMT_Range,
                                 'make'                  =>  $Make,
                                 'engine_number'         =>  $EngineNumber,
                                 'england_or_wales'      =>  $EnglandOrWales,
                                 'model'                 =>  $Model,
                                 'fuel_type'             =>  $FuelType,
                                 'registration_number'   =>  $RegistrationNumber,
                                 'year_of_manufacture'   =>  $YearOfManufacture,
                                 'tr_smmt_series'        =>  $TR_SMMT_Series,
                                 'cherished_transfer_history'=> $CherishedTransferHistory,
                                 'ma_vehicle_data'=>$ma_vehicle_data,
                                 'status'                =>  $validity
                                 
                                );
                    $userVehicleId    = UserVehicleDetails::insertGetId($user_vehicle_data);
                } else if($source == 'LP' || $source=='FLP') {
                    $VehicleData                        =  new VehicleDataLookup();
                    $VehicleData->user_id               =  $user_id;
                    $VehicleData->visitor_id            =  $visitor_id;
                    $VehicleData->split_id              =  $user_split->split_id;
                    $VehicleData->source                =  $source;
                    $VehicleData->car_reg_no            =  $carRegNo;
                    $VehicleData->tr_smmt_range         =  $TR_SMMT_Range;
                    $VehicleData->make                  =  $Make;
                    $VehicleData->engine_number         =  $EngineNumber;
                    $VehicleData->england_or_wales      =  NULL;
                    $VehicleData->model                 =  $Model;
                    $VehicleData->fuel_type             =  $FuelType;
                    $VehicleData->registration_number   =  $RegistrationNumber;
                    $VehicleData->year_of_manufacture   =  $YearOfManufacture;
                    $VehicleData->tr_smmt_series        =  $TR_SMMT_Series;
                    $VehicleData->cherished_transfer_history = $CherishedTransferHistory;
                    $VehicleData->ma_vehicle_data       =  $ma_vehicle_data;
                    $VehicleData->status                =  $validity;
                    $VehicleData->save();
                }

                // Write the contents back to the file
                $strFileContent = '\n----------\n Date: ' . date( 'Y-m-d H:i:s' ) . "\n Content : " . json_encode( $vehicleData ) . '  \n'; 
                //Function call for write log
                //$logWrite   = LogClass::writeLog( '-getUserDataListCarRegNumAPI', $strFileContent );
                 $logWrite =$this->logRepo->writeLog( '-getUserDataListCarRegNumAPI', $strFileContent );
            } else if($car_lookup['validity'] == 2) {
                $validity = '2';
            }
            
        } else {
            $validity = '3';
        }
        
        if($validity == '1') {
            $vehicleData = array(
                                 'TR_SMMT_Range'         =>  $TR_SMMT_Range,
                                 'make'                  =>  $Make,
                                 'engine_number'         =>  $EngineNumber,
                                 'england_or_wales'      =>  NULL,
                                 'model'                 =>  $Model,
                                 'fuel_type'             =>  $FuelType,
                                 'registration_number'   =>  $RegistrationNumber,
                                 'year_of_manufacture'   =>  $YearOfManufacture,
                                 'tr_smmt_series'        =>  $TR_SMMT_Series,
                                 'cherished_transfer_history'=> $CherishedTransferHistory,
                                 'ma_vehicle_data'=>$response_data 
                );
        } else {
            $vehicleData = array();
        }

        $vehicleData = array();     
        return response()->json([
            'validity' => $validity,
            'vehicleData' => $vehicleData,
        ]);
    }

    public function findCarKeepers( Request $request )
    {
        
        $carRegNo = $request->carRegNo;
        $car_num_lookup_keeper         = VehicleDataLookup::select('id','status','ma_vehicle_data')
                                        ->where('car_reg_no', '=',$carRegNo)
                                        ->where('ma_vehicle_data', '!=',NULL)
                                        ->orderBy('id', 'DESC')
                                        ->first();
        if(!isset($car_num_lookup_keeper))
        {
            $car_num_lookup_keeper         = UserVehicleDetails::select('id','status','ma_vehicle_data')
            ->where('car_reg_no', '=',$carRegNo)
            ->orderBy('id', 'DESC')
            ->where('ma_vehicle_data', '!=',NULL)
            ->first();  
        }

        // if(isset($car_num_lookup_keeper)) {
        if(isset($car_num_lookup_keeper)) { 

            $vehicle_array=json_decode($car_num_lookup_keeper->ma_vehicle_data,true);
            $keeper_count=$vehicle_array['DataItems']['VehicleHistory']['NumberOfPreviousKeepers'];

            if(isset($vehicle_array['DataItems']['VehicleHistory']['KeeperChangesList']))
            {

                if($keeper_count>1) 
                {
                    $last_keeper_dates ='';    
                    foreach($vehicle_array['DataItems']['VehicleHistory']['KeeperChangesList'] as $keepers)
                    {
                        $keeper_date=date('Y-m-d',strtotime($keepers['DateOfLastKeeperChange']));

                        $last_keeper_dates.='<div class="col-lg-12"><button type="button" class="btn popers" data-dismiss="modal" rel='.$keeper_date.'>'.$keeper_date.'</button></div>';
                    }
                }
                elseif($keeper_count==1)
                { 
                    $keeper_count=1;    
                    $last_keeper_dates=date('Y-m-d',strtotime($vehicle_array['DataItems']['VehicleHistory']['KeeperChangesList']['0']['DateOfLastKeeperChange']));
                }
            }
            else 
            { 
                $keeper_count=0;    
                $last_keeper_dates= null;
            }  

            return response()->json([
                'keeper_count' => $keeper_count,
                'keeper_dates' => $last_keeper_dates,
            ]); 

        }
        else 
        { 
            return response()->json([
                'keeper_count' => 0,
                'keeper_dates' => null,
            ]); 
        }
        
    }

    public function carregnumLookup( $carRegNo ) {

        $car_num_lookup         = UserVehicleDetails::select('tr_smmt_range','make','engine_number','england_or_wales','model','fuel_type','registration_number','year_of_manufacture','tr_smmt_series','cherished_transfer_history','ma_vehicle_data','status')
                                        ->where('car_reg_no', '=', $carRegNo)
                                        ->orderBy('id', 'DESC')
                                        ->first();
        if(!isset($car_num_lookup)){
            $car_num_lookup         = VehicleDataLookup::select('tr_smmt_range','make','engine_number','england_or_wales','model','fuel_type','registration_number','year_of_manufacture','tr_smmt_series','cherished_transfer_history','ma_vehicle_data','status')
                                        ->where('car_reg_no', '=', $carRegNo)
                                        ->orderBy('id', 'DESC')
                                        ->first();
        }
        if(isset($car_num_lookup)){
            if($car_num_lookup->status == 1){ 
                $vehicle_lookup = array(
                'tr_smmt_range'=> $car_num_lookup->tr_smmt_range,
                'make'                 => $car_num_lookup->make,
                'engine_number'=> $car_num_lookup->engine_number,
                'england_or_wales'=>$car_num_lookup->england_or_wales,
                'model'=> $car_num_lookup->model,
                'fuel_type'             => $car_num_lookup->fuel_type,
                'registration_number'=> $car_num_lookup->registration_number,
                'year_of_manufacture'    => $car_num_lookup->year_of_manufacture,
                'tr_smmt_series'=> $car_num_lookup->tr_smmt_series,
                'cherished_transfer_history'=> $car_num_lookup->cherished_transfer_history,
                'ma_vehicle_data'=>$car_num_lookup->ma_vehicle_data
                );

                $lookup_res = array(
                    'validity'    => $car_num_lookup->status,
                    'vehicleData' => $vehicle_lookup,
                );
            } else if($car_num_lookup->status == 2 || $car_num_lookup->status == 0){
                $lookup_res = array(
                    'validity'    => $car_num_lookup->status,
                    'vehicleData' => null,
                );
            } 
        }else {
            $lookup_res = array(
                    'validity'    => '0',
                    'vehicleData' => null,
                );
        }
        return $lookup_res;
    }

    public function getKeeperDate(Request $request) {
        
        $CarAcqDate             = $request->acqdate;
        $car_acq_dates_array    = explode(",",$request->acq_dates);
        usort($car_acq_dates_array, array($this, "date_sort"));
        $acq_sele_date_key      = array_search($CarAcqDate,$car_acq_dates_array); 
        $get_keeper_end_date    = $this->get_next($car_acq_dates_array,$acq_sele_date_key);
        
        return $get_keeper_end_date==""?null:$get_keeper_end_date;
    }

    public function date_sort($a, $b) {   
        return strtotime($a) - strtotime($b);
    }

    public function get_next($array, $key) { 
        $currentKey = key($array);
        while ($currentKey !== null && $currentKey != $key) {
            next($array);
            $currentKey = key($array);
        }
        return next($array);
    }
    
}
