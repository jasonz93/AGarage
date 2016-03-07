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
use Utils;

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
        $exec_start = explode(' ', microtime());

        $ip = $request->header('x-forward-for');
        if ($ip === null) {
            $ip = $_SERVER['REMOTE_ADDR'];
        }
        $userAgent = $request->header('user-agent');
        $resource = $request->path();
        if ($resource !== '/') {
            $resource = '/'.$resource;
        }

        $response = $next($request);

        $exec_stop = explode(' ', microtime());
        $exec_time = (($exec_stop[0] - $exec_start[0]) + ($exec_stop[1] - $exec_start[1])) * 1000;

        AccessLog::create([
            'client_ip' => $ip,
            'user_agent' => $userAgent,
            'resource' => $resource,
            'exec_time' => $exec_time
        ]);

        return $response;
    }
}