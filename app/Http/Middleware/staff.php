<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class staff
{

    public function handle(Request $request, Closure $next): Response
    {
        //if user not logged in
        if (!Auth::check()){
            return redirect()->route('login');
        }

        $userRole = Auth::user()->role;

        //Staff
        if($userRole == 1){
            return $next($request);
        } 
        
        //Guru
        elseif ($userRole == 2){
            return redirect()->route('guru.dashboard');
        }
        
        //Siswa
        elseif ($userRole == 3){
            return redirect()->route('dashboard');
        }
            
    }
}
