<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/8
 * Time: 0:34
 */

namespace AGarage\Http\Controllers\Admin;


use AGarage\AccessLog;
use Illuminate\Routing\Controller;
use DB;

class StatisticsController extends Controller
{
    public function showIndex() {
        $todayStart = date('Y-m-d 0:0:0');
        $todayEnd = date('Y-m-d 23:59:59');
        $daily_pv = AccessLog::whereBetween('created_at', [$todayStart, $todayEnd])->count();
        $daily_ip = AccessLog::whereBetween('created_at', [$todayStart, $todayEnd])->groupBy('client_ip')->get();
        $daily_ip = count($daily_ip);
        $daily_resources = AccessLog::whereBetween('created_at', [$todayStart, $todayEnd])->select('resource', DB::raw('COUNT(id) as visits'))->groupBy('resource')->get();
        return view('admin.statistics', [
            'daily_pv' => $daily_pv,
            'daily_ip' => $daily_ip,
            'daily_resources' => $daily_resources
        ]);
    }
}