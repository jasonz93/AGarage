<?php
/**
 * Created by PhpStorm.
 * User: nicholas
 * Date: 16-2-21
 * Time: 下午10:26
 */

namespace AGarage\Http\Controllers\Blog;


use AGarage\BlogArticle;
use AGarage\BlogTopic;
use Illuminate\Routing\Controller;

class BlogController extends Controller
{
    public function __construct()
    {
        $this->middleware('blog.topic', [
            'except' => []
        ]);
    }

    public function showIndex() {
        return view('blog.index');
    }

    public function showArticleList(BlogTopic $topic) {
        if ($topic) {
            $articles = BlogArticle::all();
        } else {
            $articles = $topic->articles()->get();
        }
        return view('blog.article_list', [
            'articles' => $articles
        ]);
    }

    public function showArticle($article) {

    }
}