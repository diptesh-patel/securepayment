<?php
   
namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
   
class DashboardController extends Controller
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
    public function merchantDashboard()
    {
        $data=[];
        $data['title'] = 'Dashboard';
        $data['menu_item'] = 'merchant_dashboard';
        return view('merchant/merchantdashboard',$data);
    }
    
}