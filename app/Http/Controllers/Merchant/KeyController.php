<?php
   
namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\User;

class KeyController extends Controller
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
    public function access_key()
    {

       
        $data=[];
        $data['title'] = 'Access Key';
        $data['menu_item'] = 'access_key';
        $data['userKeyData'] = User::where('id',auth()->user()->id)->first();
        return view('merchant/keys/list',$data);
    }
    public function create_key(){
        $user = User::where('id',auth()->user()->id)->first();
        $user->secret_key = User::getsecrateKey();
        $user->secret_password = User::getsecretPassword();
        if($user->save()){
            return response()->json([
                'message'=>'Merchant key created',
                'redirect_url'=>route('merchant.access_key'),
                "status"=>true
            ],200);
        }
    }
   public function remove_key(){
        $user = User::where('id',auth()->user()->id)->first();
        $user->secret_key = '';
        $user->secret_password = '';
        if($user->save()){
            return response()->json([
                'message'=>'Merchant key deleted',
                'redirect_url'=>route('merchant.access_key'),
                "status"=>true
            ],200);
        }
   }
}