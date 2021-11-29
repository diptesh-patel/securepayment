<?php
   
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;  
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
   
class PendingCashOutController extends Controller
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
    public function pendingCashOutList()
    {
        $data=[];
        $data['title'] = 'Pending Cash Out';
        $data['menu_item'] = 'pending_cash_out';
        return view('admin/pending_cash/list',$data);
    }
    
}