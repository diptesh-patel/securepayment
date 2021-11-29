<?php
   
namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
   
class TokenController extends Controller
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
    public function tokenTransectionsList()
    {
        $data=[];
        $data['title'] = 'Token Transections';
        $data['menu_item'] = 'token_transections';
        return view('merchant/tokens/list',$data);
    }
    public function token_to_money()
    {
        $data=[];
        $data['title'] = 'Token To Money Transections';
        $data['menu_item'] = 'token_to_money';
        return view('merchant/tokens/token_to_money',$data);
    }
}