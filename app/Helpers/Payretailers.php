<?php
 namespace App\Helpers\Payretailers;

use Symfony\Component\Console\Helper\Helper;
use Symfony\Component\Console\Helper\HelperSet;
use Illuminate\Support\Facades\Http;
use Guzzle\Http\Exception\RequestException as ErrorException;

class Payretailer extends HelperSet{
    // private static $data = [];
    private static $apiBaseURL = 'https://api.gateway.payretailers.com/v2';
    
    /****
    * Create a new token
    */
    
    public static function getAuthorizationBasicToken($shop_id='12346131',$secret_key='f25ee167c7f531a519715071220ab595f212f3328ac3fe0f81f074b8a9797bce'){
        return base64_encode($shop_id.":".$secret_key);
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
    * Create a new Payout batch
    */
    public static function createNewPayoutBatch($payouts=array()){
        $authorizationBasicToken = Payretailer::getAuthorizationBasicToken();
        if(empty($payouts)){
            return [
                "status"=>400,
                "message"=>"Missing Parameters",
                "errors"=>array(
                    "errors"=>array([
                        "errorCode"=>'PAYOUTBATCH_INVALID_PAYOUTS_COUNT',
                        "errorMessage"=>'PAYOUTBATCH_INVALID_PAYOUTS_COUNT',
                        "reference"=>'',
                        "externalReference"=>''
                    ])
                )
            ];
        }
        $postData = array("payouts"=>$payouts);
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$authorizationBasicToken
        ])->post(static::$apiBaseURL.'/payoutBatch', $postData);
        return Payretailer::getResponce($response);
    
    }
    /****
    * Create a new Payout 
    */
    public static function createNewPayout($payout=array()){
        $authorizationBasicToken = Payretailer::getAuthorizationBasicToken();
        if(empty($payouts)){
            return [
                "status"=>400,
                "message"=>"Missing Parameters",
                "errors"=>array(
                    "errors"=>array([
                        "errorCode"=>'PAYOUTBATCH_INVALID_PAYOUTS_COUNT',
                        "errorMessage"=>'PAYOUTBATCH_INVALID_PAYOUTS_COUNT',
                        "reference"=>'',
                        "externalReference"=>''
                    ])
                )
            ];
        }
        $postData = $payout;
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$authorizationBasicToken
        ])->post(static::$apiBaseURL.'/payout', $postData);
        return Payretailer::getResponce($response);
    
    }
    /****
    * Retrieve Payout batch information by ID
    */
    public static function getPayoutBatchByID($payoutBatchId){
        $authorizationBasicToken = Payretailer::getAuthorizationBasicToken();
        if(empty($payoutBatchId)){
            return [
                "status"=>400,
                "message"=>"Missing Parameters",
                "errors"=>array(
                    "errors"=>array([
                        "errorCode"=>'PAYOUTBATCH_INVALID_PAYOUTS_ID',
                        "errorMessage"=>'PAYOUTBATCH_INVALID_PAYOUTS_ID',
                        "reference"=>'',
                        "externalReference"=>''
                    ])
                )
            ];
        }
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$authorizationBasicToken
        ])->get(static::$apiBaseURL.'/payoutBatch/'.$payoutBatchId);
        return Payretailer::getResponce($response);
    
    }
    /****
    * Retrieve Payout information by ID
    */
    public static function getPayoutByID($externalReference){
        $authorizationBasicToken = Payretailer::getAuthorizationBasicToken();
        if(empty($externalReference)){
            return [
                "status"=>400,
                "message"=>"Missing Parameters",
                "errors"=>array(
                    "errors"=>array([
                        "errorCode"=>'PAYOUTBATCH_INVALID_EXTERNAL_REFERENCE',
                        "errorMessage"=>'PAYOUTBATCH_INVALID_EXTERNAL_REFERENCE',
                        "reference"=>'',
                        "externalReference"=>''
                    ])
                )
            ];
        }
        
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$authorizationBasicToken
        ])->get(static::$apiBaseURL.'/payout/'.$externalReference);
        return Payretailer::getResponce($response);
    
    }
    /****
    * Retrieve paymentMethods
    */
    public static function getpaymentMethods(){
        $authorizationBasicToken = Payretailer::getAuthorizationBasicToken();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$authorizationBasicToken
        ])->get(static::$apiBaseURL.'/paymentMethods');
        return Payretailer::getResponce($response);
    
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
        $authorizationBasicToken = Payretailer::getAuthorizationBasicToken();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$authorizationBasicToken
        ])->post(static::$apiBaseURL.'/transactions', $postData);
        return Payretailer::getResponce($response);
    
    }
    /****
    * Retrieve Merchant Balance
    */
    public static function getShopBalance(){
        $authorizationBasicToken = Payretailer::getAuthorizationBasicToken();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$authorizationBasicToken
        ])->get(static::$apiBaseURL.'/shop-balance');
        return Payretailer::getResponce($response);
    
    }
    /***
     * getTransactions by UID
     * Get information about a transaction status or transaction details
     */
    public static function getTransactions($uid){
        if(empty($uid)){
            return [
                "status"=>400,
                "message"=>"Missing Parameters",
                "errors"=>array(
                    "errors"=>array([
                        "errorCode"=>'MISSING_UID',
                        "errorMessage"=>'MISSING_UID',
                        "reference"=>'',
                        "externalReference"=>''
                    ])
                )
            ];
        }
        $authorizationBasicToken = Payretailer::getAuthorizationBasicToken();
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => 'Basic '.$authorizationBasicToken
        ])->get(static::$apiBaseURL.'/transactions/'.$uid);
        return Payretailer::getResponce($response);
    
    }
}



