@extends('blog.base')

@section('middle_col')
    <div class="row">
        <div class="col-md-11">
            <h1>{{ $article->title }}</h1>
        </div>
        <div class="col-md-1">
            @role('admin')
            <a class="btn btn-info" href="{{ route('blog.article.edit', ['article' => $article->id]) }}">编辑</a>
            @endrole
        </div>
    </div>

    {!! Markdown::parse($article->content) !!}
@endsection