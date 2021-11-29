<?php
   
namespace App\Http\Controllers\Mid;
  
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;    
use App\Helpers\Payretailers\Payretailer;
class PayretailerController extends Controller
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
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function createNewPayoutBatch(Request $request)
    {
       
        
    }
  
    public function createNewPayout(Request $request)
    {
       
        
    }
    public function getPayoutBatchByID(Request $request,$payoutBatchId)
    {
       
        
    }
    public function getPayoutByID(Request $request,$payoutId)
    {
       
        
    }
    public function getpaymentMethods()
    {
     echo "<pre>";
     print_r(Payretailer::getpaymentMethods());die;  
    }
    public function createTransactions()
    {
        $postdata = array(
            "paymentMethodId"=> "5c3e74c2-5f61-4033-afc5-7152b3c6b245",
            "amount"=> "10",
            "currency"=> "BRL",
            "description"=> "Payment Test",
            "trackingId"=> "",
            "language"=>"EN",
            "notificationUrl"=> "https://payment-form.payretailers.com/notification",
            "returnUrl"=> "https://payment-form.payretailers.com/return",
            "cancelUrl"=> "https://payment-form.payretailers.com/cancel",
            "customer"=> [
                "firstName"=> "John",
                "lastName"=> "Doe",
                "personalId"=> "13686665824",
                "email"=> "test@payretailers.com",
                "country"=> "BR",
                "city"=> "Sao Pablo",
                "zip"=> "123456",
                "address"=> "Merchant Address",
                "phone"=> "1234567",
                "deviceId"=> "DEVICE",
                "ip"=> "81.47.160.151"
                
            ]
        );
        echo "<pre>POSTDATA";
        print_r($postdata);
        echo "Responce";
        print_r(Payretailer::createTransactions($postdata));die;  
    }
    public function getTransactions(){
        echo "<pre>";
        
        echo "Responce===";
        print_r(Payretailer::getTransactions('425d7158-d958-4150-a097-01470d1aa27e'));die;  
    }
    public function getShopBalance()
    {
        
        echo "<pre>";
        
        echo "Responce===";
        print_r(Payretailer::getShopBalance());die;  
    }
    
}