<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/8
 * Time: 0:35
 */

namespace AGarage\Http\Controllers\Admin;


use Illuminate\Routing\Controller;

class AdminController extends Controller
{
    public function showIndex() {
        return view('admin.index');
    }
}