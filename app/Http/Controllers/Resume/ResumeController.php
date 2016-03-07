<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-24
 * Time: 下午10:49
 */

namespace AGarage\Http\Controllers\Resume;


use Illuminate\Routing\Controller;

class ResumeController extends Controller
{
    public function showIndex() {
        return view('resume.index');
    }
}