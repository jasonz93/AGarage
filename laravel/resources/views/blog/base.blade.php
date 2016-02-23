@extends('layouts.with_navbar')

@section('content')
    <div class="row">
        <div class="col-md-2">
            {{--@section('left_col')--}}
                <span>{{ trans('blog.topic_list') }}</span>
                <div class="list-group">
                    <a href="{{ route('blog.article.list') }}" class="list-group-item">{{ trans('blog.all_topic') }}</a>
                    @foreach($blog_topics as $topic)
                        <a href="{{ route('blog.article.list', ['id' => $topic->id]) }}" class="list-group-item">{{ $topic->name }}</a>
                    @endforeach
                </div>
            {{--@endsection--}}
        </div>
        <div class="col-md-8">
            @yield('middle_col')
        </div>
        <div class="col-md-2">
            @yield('right_col')
        </div>
    </div>
@endsection

