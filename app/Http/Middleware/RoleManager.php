<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if(!Auth::check()){
            return redirect()->intended('login');
        }

        $userRole = Auth::user()->role;

        $roleList = [
            'user' => '0',
            'admin' => '1',
            'operator' => '2',
        ];

        foreach($roles as $role){
            if(isset($roleList[$role]) && $userRole == $roleList[$role]){
                return $next($request);
            }
        }

        switch ($userRole) {
            case 0:
                return redirect()->route('home');
            case 1:
                return redirect()->intended(default: 'dashboard');
            case 2:
                return redirect()->intended(default: 'dashboard');
            default:
                return redirect()->intended(default: 'login');
        }


    }
}
