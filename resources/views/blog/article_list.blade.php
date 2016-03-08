@extends('blog.base')

@section('title')
    @if($topic == null)
        {{ trans('blog.all_topic') }}
    @else
        {{ $topic->name }}
    @endif
@endsection

@section('middle_col')
    <div class="row">
        <div class="col-md-11">
            <span>{{ trans('blog.article_list') }}</span>
        </div>
        <div class="col-md-1">
            @role('admin')
            <a class="btn btn-success" href="{{ route('blog.article.new') }}">新建</a>
            @endrole
        </div>
    </div>

    <div class="list-group">
        @foreach($articles as $article)
            <a href="{{ route('blog.article', ['id' => $article->id]) }}" class="list-group-item">
                <h4 class="list-group-item-heading">{{ $article->title }}</h4>
                <p class="list-group-item-text">{!! Markdown::line($article->content) !!}</p>
            </a>
        @endforeach
    </div>
@endsection