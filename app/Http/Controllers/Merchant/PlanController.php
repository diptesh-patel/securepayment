<?php
   
namespace App\Http\Controllers\Merchant;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
   
class PlanController extends Controller
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
    public function plan_list()
    {
        $data=[];
        $data['title'] = 'Merchant Plans';
        $data['menu_item'] = 'plan_list';
        return view('merchant/plans/list',$data);
    }
   
}