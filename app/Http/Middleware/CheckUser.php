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
    public function handle($request, Closure $next, $action = null)
    {   
        // 控制代理用户能新增站点
        if (!\Gate::allows('add-website')) {
            return redirect('/home');
        }

        // 资源访问控制：不允许当前用户对其他站点的操作
        if(isset($action)){
            $user_id = \DB::table('websites')->where('id', $request->website_id)->value('user_id');
            if(\Auth::guard()->user()->id != $user_id){
                return redirect('/home');
            }
        }
            
        return $next($request);
    }
}
