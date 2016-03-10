<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/9
 * Time: 23:49
 */

namespace AGarage\Http\Controllers\Auth;


use AGarage\Http\Controllers\Controller;
use AGarage\SocialiteUser;
use Socialite;
use Response;

class SocialiteController extends Controller
{
    public function redirectTo($driver) {
        return Socialite::driver($driver)->redirect();
    }

    public function handleCallback($driver) {
        $socialite = Socialite::driver($driver)->user();
        $socialiteUser = SocialiteUser::where('id', '=', $socialite->id)->where('driver', '=', $driver)->first();
        if ($socialiteUser == null) {
            $socialiteUser = new SocialiteUser();
            $socialiteUser->id = $socialite->id;
            $socialiteUser->driver = $driver;
            $socialiteUser->name = $socialite->name;
            $socialiteUser->email = $socialite->email;
            $socialiteUser->nickname = $socialite->nickname;
            $socialiteUser->avatar = $socialite->avatar;
            $socialiteUser->setRawUser($socialite->user);
            $user = $socialiteUser->createUser();
            $socialiteUser->user()->associate($user);
            $socialiteUser->save();
        } else {
            $user = $socialiteUser->user;
        }
        \Auth::login($user);
        return Response::redirectTo('/');
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