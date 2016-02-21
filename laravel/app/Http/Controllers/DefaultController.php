<?php

namespace AGarage\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Routing\Controller;

class DefaultController extends Controller
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function showHomepage() {
        return view('homepage');
    }
}
