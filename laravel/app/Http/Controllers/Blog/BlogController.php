<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午10:26
 */

namespace AGarage\Http\Controllers\Blog;


use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function showIndex() {
        return view('blog.index');
    }
}