<?php

namespace App\Http\Middleware;

use Closure;

class CheckUser
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
        // 控制代理用户能新增站点
        if (!\Gate::allows('add-website')) {
            return redirect('/home');
        }

        return $next($request);
    }
}
