<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-7
 * Time: 下午9:34
 */

namespace AGarage\Http\Middleware;


use AGarage\AccessLog;
use Closure;
use Log;

class StatisticMiddleware
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
        $ip = $request->header('x-forward-for');
        if ($ip === null) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $userAgent = $request->header('user-agent');
        $resource = '/'.$request->path();

        AccessLog::create([
            'client_ip' => $ip,
            'user_agent' => $userAgent,
            'resource' => $resource
        ]);

        return $next($request);
    }
}