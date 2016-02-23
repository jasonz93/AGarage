@extends('blog.base')

@section('middle_col')
    <div class="list-group">
        @foreach($articles as $article)
            <a href="#" class="list-group-item">
                <h4 class="list-group-item-heading">{{ $article->title }}</h4>
                <p class="list-group-item-text">{{ $article->content }}</p>
            </a>
        @endforeach
    </div>
@endsection