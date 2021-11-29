<?php
   
namespace App\Http\Controllers\Mid;
  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;    
use App\Helpers\Opaywebs\Opayweb;

class OpaywebController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }
    
    public function createTransactions()
    {
        

        $postdata = array(
            "reference"=> "test_10091123132233",
            "amount"=> "1000",
            "currency"=> "NGN",
            "country"=> "NG",
            "payType"=> "bankcard",
            "firstName;"=> "f_firstName",
            "lastName"=> "l_lastName",
            "customerEmail"=> "123@qq.com",
            "cardNumber"=> "4111111111111111",
            "cardDateMonth"=> "11",
            "cardDateYear"=> "25",
            "cardCVC"=> "590",
            "return3dsUrl"=> "http://127.0.0.1:8000/opayweb/callbackUrl",
            "bankAccountNumber"=> "22445566787",
            "bankCode"=> "057",
            "reason"=> "transaction reason message",
            "callbackUrl"=> "http://127.0.0.1:8000/opayweb/callbackUrl",
            "expireAt"=> "100",
            "billingZip"=> "xxx",
            "billingCity"=> "xxxx",
            "billingAddress"=> "xxxx",
            "billingState"=> "xxxx",
            "billingCountry"=> "xxxx"
        );
        echo "<pre>POSTDATA";
        print_r($postdata);
        echo "Responce";
        $responce = Opayweb::createTransactions($postdata);
        print_r($responce);die;  
    }
    public function callbackUrl(){
        echo "hello wel come call back";die;
    }
    
}