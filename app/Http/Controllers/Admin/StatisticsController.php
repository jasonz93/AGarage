<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/8
 * Time: 0:34
 */

namespace AGarage\Http\Controllers\Admin;

use Illuminate\Routing\Controller;
use Statistic;

class StatisticsController extends Controller
{
    public function showIndex() {
        return view('admin.statistics', [
            'daily' => Statistic::getDailyStatistics()
        ]);
    }
}