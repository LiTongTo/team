<?php

namespace App\Http\Middleware;

use Closure;

class CheckToken
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
        $dl=request()->session()->get('yhdl');
        if(!$dl){
            $ck=request()->cookie('htdl');
            if(!$ck){
               return redirect('/dlq'); 
               exit; 
            }
           $ck=json_decode($ck);
          session(['yhdl'=>$ck]);
        }
        return $next($request);
    }
}
