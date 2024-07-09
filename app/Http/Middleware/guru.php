<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class guru
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
         //if user not logged in
         if (!Auth::check()){
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        //Staff
        if($userRole == 1){
            return redirect()->route('staff.dashboard');
        } 
        
        //Guru
        elseif ($userRole == 2){
            return $next($request);
        }
        
        //Siswa
        elseif ($userRole == 3){
            return redirect()->route('dashboard');
        }
    }
}
