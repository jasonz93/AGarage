@extends('blog.base')

@section('middle_col')
    <h1>{{ $article->title }}</h1>
    {!! Markdown::parse($article->content) !!}
@endsection