<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-3-8
 * Time: 下午1:29
 */

namespace AGarage\Services;

use AGarage\AccessLog;
use DB;

class StatisticService
{
    /**
     * @return \stdClass
     * @property int $pv
     * @property int $ip
     */
    public function getDailyStatistics() {
        $todayStart = date('Y-m-d 0:0:0');
        $todayEnd = date('Y-m-d 23:59:59');
        $result = new \stdClass();
        $result->pv = AccessLog::whereBetween('created_at', [$todayStart, $todayEnd])->count();
        $daily_ip = AccessLog::whereBetween('created_at', [$todayStart, $todayEnd])->groupBy('client_ip')->get();
        $result->ip = count($daily_ip);
        $result->maxExecTime = AccessLog::whereBetween('created_at', [$todayStart, $todayEnd])->max('exec_time');
        $result->avgExecTime = AccessLog::whereBetween('created_at', [$todayStart, $todayEnd])->avg('exec_time');
        $result->resources = new \stdClass();
        $result->resources->pv = AccessLog::whereBetween('created_at', [$todayStart, $todayEnd])->select('resource', DB::raw('COUNT(id) as visits'))->groupBy('resource')->get();
        $result->resources->ip = AccessLog::whereBetween('created_at', [$todayStart, $todayEnd])->select('resource', DB::raw('COUNT(DISTINCT client_ip) as ips'))->groupBy('client_ip', 'resource')->get();
        return $result;
    }
}