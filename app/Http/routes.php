<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', [ 'uses' => 'IndexController@showHomepage', 'as' => 'homepage']);

    Route::group(['namespace' => 'Auth'], function () {
        Route::get('/login', [
            'uses' => 'AuthController@getLogin',
            'as' => 'auth.login'
        ]);
        Route::post('/login', [
            'uses' => 'AuthController@postLogin',
            'as' => 'auth.login.action'
        ]);
        Route::get('/logout', [
            'uses' => 'AuthController@getLogout',
            'as' => 'auth.logout'
        ]);
        Route::get('/register', [
            'uses' => 'AuthController@getRegister',
            'as' => 'auth.register'
        ]);
        Route::post('/register', [
            'uses' => 'AuthController@postRegister',
            'as' => 'auth.register.action'
        ]);

        Route::get('/socialite/{driver}', [
            'uses' => 'SocialiteController@redirectTo',
            'as' => 'socialite'
        ]);
        Route::get('/socialite/{driver}/callback', [
            'uses' => 'SocialiteController@handleCallback',
            'as' => 'socialite.callback'
        ]);
    });

    Route::group(['namespace' => 'Blog'], function () {
        Route::group(['middleware' => ['role:admin']], function () {
            Route::get('/blog/article/new', [
                'uses' => 'BlogController@showEditArticle',
                'as' => 'blog.article.new'
            ]);
            Route::get('/blog/article/{article}/edit', [
                'uses' => 'BlogController@showEditArticle',
                'as' => 'blog.article.edit'
            ]);
            Route::post('/blog/article/{article?}', [
                'uses' => 'BlogController@saveArticle',
                'as' => 'blog.article.save'
            ]);
        });
        Route::get('/blog', [
            'uses' => 'BlogController@showIndex',
            'as' => 'blog'
        ]);
        Route::get('/blog/topic/{topic?}', [
            'uses' => 'BlogController@showArticleList',
            'as' => 'blog.article.list'
        ]);
        Route::get('/blog/article/{article}', [
            'uses' => 'BlogController@showArticle',
            'as' => 'blog.article'
        ]);
    });

    Route::group(['namespace' => 'Resume'], function () {
        Route::get('/resume', [
            'uses' => 'ResumeController@showIndex',
            'as' => 'resume'
        ]);
    });

    Route::group([
        'namespace' => 'Admin',
        'middleware' => ['admin']
    ], function () {
        Route::get('/admin', [
            'uses' => 'AdminController@showIndex',
            'as' => 'admin'
        ]);
        Route::get('/admin/statistics', [
            'uses' => 'StatisticsController@showIndex',
            'as' => 'admin.statistics'
        ]);
    });
});
