<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/9
 * Time: 23:49
 */

namespace AGarage\Http\Controllers\Auth;


use AGarage\Http\Controllers\Controller;
use Socialite;
use Response;

class SocialiteController extends Controller
{
    public function redirectToLinkedin() {
        return Socialite::driver('linkedin')->redirect();
    }

    public function handleLinkedinCallback() {
        $user = Socialite::driver('linkedin')->user();
        return Response::make(print_r($user, true));
    }

    public function redirectToGithub() {
        return Socialite::driver('github')->redirect();
    }

    public function handleGithubCallback() {
        $user = Socialite::driver('github')->user();
        return Response::make(print_r($user, true));
    }

    public function redirectToWeibo() {
        return Socialite::driver('weibo')->redirect();
    }

    public function handleWeiboCallback() {
        $user = Socialite::driver('weibo')->user();
        return Response::make(var_export($user, true));
    }
}