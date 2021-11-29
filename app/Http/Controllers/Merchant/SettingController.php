<?php
   
namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\UserAgent;
use Illuminate\Support\Facades\Auth;
// use Auth;
use GuzzleHttp\Psr7\Request as Psr7Request;
// use Google2FA as G2FA;

use PragmaRX\Google2FAQRCode\Google2FA;   
class SettingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
  
    
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data=[];
        $data['title'] = 'Merchant Settings';
        $data['menu_item'] = '';
        //check Google 2FA is enable or not
        $userGoogleauth = User::where('id',Auth::user()->id)->first('googleauth')->toArray();
        
        if(empty($userGoogleauth['googleauth'])){
            $data["is_google2fa_enabled"] = true;
            $google2fa = new Google2FA();
            $data["google2fa_secret"] = $google2fa->generateSecretKey();
            $data["qr_image"] = $google2fa->getQRCodeInline(
                Auth::user()->name,
                Auth::user()->email,
                $data["google2fa_secret"]
            );
            $data['verify_action'] = 'enable';
        }else{
            $data['verify_action'] = 'disable';
            $data["google2fa_secret"] = $userGoogleauth['googleauth'];
            $data["is_google2fa_enabled"] = false;
        }
        $data['devices'] = UserAgent::where('user_id',auth()->user()->id)->orderBy('id', 'desc')->take(5)->paginate(1);;
        return view('merchant/settings/index',$data);
    }
    public function verifyGoogle2FAKey(Request $request){
        $input = $request->all();
        
        $google2fa = new Google2FA();
        $valid = $google2fa->verifyKey($input['google2fa_secret'], $input['one_time_password']);
        if($valid){
            //update user google auth code
            $user = User::find(Auth::user()->id);
            $user->googleauth = $input['verify_action'] == 'enable' ? $input['google2fa_secret'] :'';
            $user->save();
            return response()->json([
                'message'=>$input['verify_action'] == 'enable' ? 'Google2FA is enabled':'Google2FA is disable',
                'redirect_url'=>route('merchant.settings'),
                "status"=>true
            ],200);
        }else{
            return response()->json([
                'message'=>'Invalid authentication code',
                'redirect_url'=>route('merchant.settings'),
                "status"=>false
            ],400);
        }
    }
}