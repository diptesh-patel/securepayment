<?php
   
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
   
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
    public function plan_list()
    {
        $data=[];
        $data['title'] = 'Admin Settings';
        $data['menu_item'] = '';
        return view('admin/settings/index',$data);
    }
   
}