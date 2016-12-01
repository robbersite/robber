<?php

namespace App\Http\Middleware;

use Closure;

class CheckUserAction
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
        // 资源访问控制：不允许当前用户对其他站点的操作
        $user_id = \DB::table('websites')->where('id', $request->website_id)->value('user_id');
        if(\Auth::guard()->user()->id != $user_id){
            return redirect('/home');
        }
            
        return $next($request);
    }
}
