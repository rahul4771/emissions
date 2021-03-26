<?php

namespace App\Repositories;

use App\Repositories\Interfaces\PreviousDetailsInterface;
use App\Models\Signature;
use App\Models\SignatureDetails;
use App\Models\User;
use Carbon\Carbon;

class PreviousDetailsRepository implements PreviousDetailsInterface
{
    public function previousDetailsHandle($dataArray)
    {
        $user_id                    = isset($dataArray['user_id']) ? $dataArray['user_id'] : '';
        $previous_name              = isset($dataArray['previous_name'])?$dataArray['previous_name']: '';
        $bank_id                    = '0';
        $signature_data             = isset($dataArray['signature_data'])?$dataArray['signature_data']: "";
        $previous_address           = array();
        $previous_address_id        = array();
        $previous_address_line1     = array();
        $previous_address_line2     = array();
        $previous_address_line3     = array();
        $previous_address_city      = array();
        $previous_address_province  = array();
        $previous_address_1_country = array();
        $previous_address_1_company = array();
        $previous_postcode          = (isset($dataArray['previous_postcode']) && (isset($dataArray['previous_address']) && !empty($dataArray['previous_address_line1']))) ? $dataArray['previous_postcode'] : '';
        foreach ($dataArray['previous_address'] as $key => $value) {
            $previous_address[]             = isset($dataArray['previous_address'][$key]) ? $dataArray['previous_address'][$key] : '';
            $previous_address_id[]          = isset($dataArray['previous_address_pk'][$key]) ? $dataArray['previous_address_pk'][$key] : '';
            $previous_address_line1[]       = isset($dataArray['previous_address_line1'][$key]) ? $dataArray['previous_address_line1'][$key] : '';
            $previous_address_line2[]       = isset($dataArray['previous_address_line2'][$key]) ? $dataArray['previous_address_line2'][$key] : '';
            $previous_address_line3[]       = isset($dataArray['previous_address_line3'][$key]) ? $dataArray['previous_address_line3'][$key] : '';
            $previous_address_city[]        = isset($dataArray['previous_address_city'][$key]) ? $dataArray['previous_address_city'][$key] : '';
            $previous_address_province[]    = isset($dataArray['previous_address_province'][$key]) ? $dataArray['previous_address_province'][$key] : '';
            $previous_address_country[]     = isset($dataArray['previous_address_country'][$key]) ? $dataArray['previous_address_country'][$key] : '';
            $previous_address_company[]     = isset($dataArray['previous_address_company'][$key]) ? $dataArray['previous_address_company'][$key] : '';
        }
        $type                       = 'digital';
        $signatureResult            = Signature::where('user_id', '=', $user_id)
                                        ->first();
        if (!empty($signatureResult)) {
            $signatureResult->previous_name     = $previous_name;
            $signatureResult->signature_image   = $signature_data;
            $signatureResult->status            = 1;
            $signatureResult->type              = $type;
            $signatureResult->update();
            $intSignId                          = $signatureResult->id;
        } else {
            $objSignature                       = new Signature;
            $objSignature->user_id              = $user_id;
            $objSignature->bank_id              = 0;
            $objSignature->previous_name        = $previous_name;
            $objSignature->signature_image      = $signature_data;
            $objSignature->status               = 1;
            $objSignature->type                 = $type;
            $objSignature->save();
            $intSignId                          = $objSignature->id;
        }
        if (isset($intSignId)) {
            // Update user updated at time
            $current_time = Carbon::now();
            User::where('id',$user_id)->update(['updated_at'=>$current_time]);
            // Aranging Data
            foreach ($previous_address as $key => $value) {
                $previous_address_no = $key+1;
                if (!empty($previous_postcode[$key])) {
                    $objEsignExtraDetails                               = new SignatureDetails;
                    $objEsignExtraDetails->user_id                      = $user_id;
                    $objEsignExtraDetails->signature_id                 = $intSignId;
                    $objEsignExtraDetails->previous_postcode            = $previous_postcode[$key];
                    $objEsignExtraDetails->previous_address_id          = $previous_address_id[$key];
                    $objEsignExtraDetails->previous_address             = $previous_address[$key];
                    $objEsignExtraDetails->previous_address_line1       = $previous_address_line1[$key];
                    $objEsignExtraDetails->previous_address_line2       = $previous_address_line2[$key];
                    $objEsignExtraDetails->previous_address_line3       = $previous_address_line3[$key];
                    $objEsignExtraDetails->previous_address_city        = $previous_address_city[$key];
                    $objEsignExtraDetails->previous_address_province    = $previous_address_province[$key];
                    $objEsignExtraDetails->previous_address_country     = $previous_address_country[$key];
                    $objEsignExtraDetails->previous_address_company     = $previous_address_company[$key];
                    $objEsignExtraDetails->previous_address_no          = $previous_address_no;
                    $objEsignExtraDetails->save();
                }
            }
        }
        return $intSignId;
    }
}
