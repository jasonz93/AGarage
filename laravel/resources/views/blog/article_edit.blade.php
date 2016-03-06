@extends('layouts.with_navbar')

@section('title')
    {{ trans('blog.edit_article') }}
@endsection

@section('content')
    <form action="{{ route('blog.article.save', ['article' => isset($article) ? $article->id : null]) }}" method="post">
        {!! csrf_field() !!}
        <div class="input-group">
            <input type="text" class="form-control" name="title">
            <span class="input-group-btn">
                <a id="submit" class="btn btn-default">保存</a>
            </span>
        </div>
        <input type="hidden" name="content" id="content">
    </form>
    <div id="editor"></div>
@endsection

@section('css')
    {!! HTML::style('markdown/css/editormd.css') !!}
@endsection

@section('javascripts')
    {!! HTML::script('markdown/editormd.js') !!}
    <script>
        var editor;

        $(function () {
            editor = editormd({
                id: 'editor',
                path: '{{ asset('markdown/lib') }}/',
                height: 800,
                syncScrolling: 'single',
                saveMarkdownToTextarea: true,
                emoji: true,
                onload: function () {
                    @if(isset($article))
                    editor.setMarkdown('{{ $article->content }}');
                    @endif
                }
            });
        });

        $('#submit').click(function () {
            $('#content').val(editor.getMarkdown());
//            alert(editor.getMarkdown());
            $('form').submit();
        });
    </script>
@endsection