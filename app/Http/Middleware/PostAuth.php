<?php

namespace App\Http\Middleware;

use Closure;

class PostAuth
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
        //セッションの値を確認する
		if($request->session()->get('post_auth') == false){
            
			return redirect("backLoginInit");
		}
		
		return $next($request);
    }
}
