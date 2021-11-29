<?php
 namespace App\Helpers\Opaywebs;

use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Helper\HelperSet;
use Illuminate\Support\Facades\Http;
use Guzzle\Http\Exception\RequestException as ErrorException;
use Illuminate\Support\Facades\Config;


class Opayweb extends HelperSet{
    // private static $data = [];
    
    private static $merchant_id = '256621112334398';

    public static function setBaseUrl(){
        $testmode = Config::get('constants.opayweb.testmode');
        return ($testmode == 'ON')?'https://sandbox-cashierapi.opayweb.com/api/v3':'https://cashierapi.opayweb.com/api/v3';

    }
    /****
    * Create a new token
    */
    
    public static function getAuthorizationBearerToken($public_key='OPAYPUB16376256194770.2199561771506322'){
        return $public_key;
    }
    
    /****
    * get responce 
    */
    public static function getResponce($response){
        if($response->getStatusCode() == 400){
            return [
                "status"=>$response->getStatusCode(),
                "message"=>$response->getReasonPhrase(),
                "errors"=>json_decode($response->getBody(),true)
            ];
        }else if($response->getStatusCode() >=200 && $response->getStatusCode() < 300){
            //Determine if the status code is >= 200 and < 300...
            return [
                "status"=>$response->getStatusCode(),
                "message"=>$response->getReasonPhrase(),
                "data"=>json_decode($response->getBody()->getContents())
            ];
        }else{
            return [
                "status"=>$response->getStatusCode(),
                "message"=>$response->getReasonPhrase(),
                "errors"=>json_decode((string) $response->getBody())
            ];
        }
        
    }
    
    /****
    * create Transactions
    */
    public static function createTransactions($postData){
        if(empty($postData)){
            return [
                "status"=>400,
                "message"=>"Missing Parameters",
                "errors"=>array(
                    "errors"=>array([
                        "errorCode"=>'MISSING_REQUESTED_PARAMETERS',
                        "errorMessage"=>'MISSING_REQUESTED_PARAMETERS',
                        "reference"=>'',
                        "externalReference"=>''
                    ])
                )
            ];
        }
        
        $authorizationBearerToken = Opayweb::getAuthorizationBearerToken();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'MerchantId' => static::$merchant_id,
            'Authorization' => 'Bearer '.$authorizationBearerToken
        ])->post(Opayweb::setBaseUrl().'/transaction/initialize', $postData);
        return Opayweb::getResponce($response);
    
    }
    
}



