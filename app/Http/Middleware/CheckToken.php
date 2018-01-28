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
        $token = $request->cookie('bearerToken');
        if(!$token){
            if($request->ajax()){
                return response()->json(['code'=>200,'msg'=>'You had logout']);
            }else{
                return redirect()->route('login');
            }
        }
        return $next($request);
    }
}
