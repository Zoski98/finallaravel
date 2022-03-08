<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class SoloUser
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if(Auth::check()){
            if(auth()->user()->type == '2')
            {
                        return $next($request);

            }
            else
            {
                return response()->json([
                    'message'=>'Acces Denied.! As you are not an User',
                ], 403);
            }


        }
        else
        { 
            return response()->json([
            'status'=>401,
            'message'=>'Please Login First',
            ]);
        }
    }
}
