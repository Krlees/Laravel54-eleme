<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Route;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

//        $str = str_replace("/", ".", Route::getCurrentRoute()->uri());
//        if (!Auth::user()->may($str)) {
//            if ($request->ajax() && ($request->getMethod() != 'GET')) {
//                return response()->json([
//                    'code' => 403,
//                    'msg' => '您没有权限执行此操作'
//                ]);
//            } else {
//                return response('Unauthorized.', 403);
//            }
//
//        }

        return $next($request);
    }
}
