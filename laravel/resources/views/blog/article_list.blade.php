@extends('blog.base')

@section('middle_col')
    <span>{{ trans('blog.article_list') }}</span>
    <div class="list-group">
        @foreach($articles as $article)
            <a href="{{ route('blog.article', ['id' => $article->id]) }}" class="list-group-item">
                <h4 class="list-group-item-heading">{{ $article->title }}</h4>
                <p class="list-group-item-text">{!! Markdown::line($article->content) !!}</p>
            </a>
        @endforeach
    </div>
@endsection