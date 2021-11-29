<?php
   
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
   
class HomeController extends Controller
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
        if(auth()->user()){
            if (auth()->user()->role_id == 1) {
                return redirect()->route('admin.dashboard');
            }else {
                return redirect()->route('merchant.dashboard');
            }
        }else{
            return redirect()->route('login');
        }
        
        
    }
  
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
    {
        return view('adminHome');
    }
    public function home()
    {
        
        return view('adminHome');
    }
}