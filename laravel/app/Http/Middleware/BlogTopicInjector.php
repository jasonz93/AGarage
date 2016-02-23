<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-22
 * Time: 下午10:25
 */

namespace AGarage\Http\Middleware;

use AGarage\BlogTopic;
use Closure;
use View;

class BlogTopicInjector
{
    public function handle($request, Closure $next) {
        $topics = BlogTopic::all();
        View::share('blog_topics', $topics);

        return $next($request);
    }
}