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
use Illuminate\Http\Request;
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
        if ($topic->exists) {
            $articles = $topic->articles()->get()->sortByDesc('created_at');
        } else {
            $articles = BlogArticle::all()->sortByDesc('created_at');
        }
        return view('blog.article_list', [
            'articles' => $articles,
            'topic' => $topic->exists ? $topic : null
        ]);
    }

    public function showArticle(BlogArticle $article) {
        return view('blog.article', [
            'article' => $article
        ]);
    }

    public function showEditArticle(BlogArticle $article) {
        return view('blog.article_edit', [
            'article' => $article
        ]);
    }

    public function saveArticle(Request $request, BlogArticle $article) {
        if ($article->exists) {
            $article->title = $request->input('title');
            $article->content = $request->input('content');
            $article->save();
        } else {
            $article = BlogArticle::create([
                'title' => $request->input('title'),
                'content' => $request->input('content')
            ]);
        }
        return redirect()->route('blog.article', [
            'article' => $article->id
        ]);
    }

    public function ajaxShowArticle(BlogArticle $article) {

    }
}