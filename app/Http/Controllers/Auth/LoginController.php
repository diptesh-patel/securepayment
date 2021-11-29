<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAgent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Stevebauman\Location\Facades\Location;
use GuzzleHttp\Psr7\Request as Psr7Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Log;
use PragmaRX\Google2FAQRCode\Google2FA;   

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public $roles;
    public $allowed_role =['1','3'];
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->roles = Config::get('constants.role');
        // print_r($this->allowed_role);die;
    }
   
    public function login(Request $request)
    {   
        $input = $request->all();
   
        $this->validate($request, ['email' => 'required|email','password' => 'required']);
        $isValid = false;
        $isValidRole = false;
        $getUser = User::where('email',$input['email'])->first();
        //check user is merchant or admin only 
        if(in_array($getUser->role_id,$this->allowed_role)){
            $isValidRole = true;
        }
        if($getUser && $isValidRole){
            $isValid = Hash::check($input['password'], $getUser->password);
        }
        if($isValid){
            //check if user have google 2FA is enable
            if(!empty($getUser->googleauth)){
                if(!empty($input['2fa_authentication_code'])){
                    //check authentication code for login
                    if($this->verify2FA($getUser->googleauth,$input)){
                        // store session user
                        if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
                            return $this->loginSuccessRedirect();
                        }
                    }else{
                        return response()->json([
                            'message'=>'Invalid Authentication code',
                            "status"=>false,
                        ],400);
                    }
                }else{
                    return response()->json([
                        'message'=>'Google Two Factor Authentication required',
                        "status"=>false,
                        'google_auth_required'=>true
                    ],400);
                }
                
            }else{
                // store session user
                if(auth()->attempt(array('email' => $input['email'], 'password' => $input['password']))){
                    return $this->loginSuccessRedirect();
                }
            }
            
        }else{
            Log::channel('secure_epayments_logging')->alert("Login failed", ['email' => $input['email'], "Login failed"]);
            return response()->json([
                'message'=>'Email-Address And Password Are Wrong.',
                "status"=>false,
                'google_auth_required'=>false
            ],400);
           
        }
          
    }
    private function loginSuccessRedirect(){
        // store browser history and location
        $ip_address = request()->ip();
        // $ip_address = '69.162.81.155';//US testing IP
        Log::channel('secure_epayments_logging')->info("Login success", ['user_id' => auth()->user()->id, "run"]);
        $currentUserInfo = Location::get($ip_address);
        // echo "<pre>";print_r($currentUserInfo);die;
        if($currentUserInfo){
            $userAgent = UserAgent::create([
                'browser_name' => request()->userAgent(),
                'ip_address' => $ip_address,
                'user_id' => auth()->user()->id,
                'country' => $currentUserInfo->countryName,
                'country_code' => $currentUserInfo->countryCode,
                'region_code' => $currentUserInfo->regionCode,
                'region_name' => $currentUserInfo->regionName,
                'city' => $currentUserInfo->cityName,
                'zipcode'=> $currentUserInfo->zipCode,
                'latitude'=> $currentUserInfo->latitude,
                'longitude'=> $currentUserInfo->longitude,
            ]);
        }
        if (auth()->user()->role_id == $this->roles['admin']) {
            return response()->json([
                'message'=>'Admin login success',
                'redirect_url'=>route('admin.dashboard'),
                "status"=>true
            ],200);
        }else if (auth()->user()->role_id == $this->roles['user']) {
            return response()->json([
                'message'=>'Merchant login success',
                'redirect_url'=>route('merchant.dashboard'),
                "status"=>true
            ],200);
        }else{
            return redirect()->route('home');
        }
    }
    private function verify2FA($google2fa_secret,$input){
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($google2fa_secret, $input['2fa_authentication_code']);
        if($valid){
            return true;
        }else{
            return false;
        }
    }
}
