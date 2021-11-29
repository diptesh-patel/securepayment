<?php
  
namespace App\Http\Middleware;
  
use Closure;
   
class IsMerchant
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        
        if(auth()->user()->role_id == 3){
            return $next($request);
        }
   
        return redirect('error/404')->with('error',"You don't have admin access.");
    }
}