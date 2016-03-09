<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/9
 * Time: 23:50
 */

namespace AGarage\Http\Controllers;


class IndexController extends Controller
{
    public function showHomepage() {
        return view('homepage');
    }
}