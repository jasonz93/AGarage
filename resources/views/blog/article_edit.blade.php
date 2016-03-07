@extends('layouts.with_navbar')

@section('title')
    {{ trans('blog.edit_article') }}
@endsection

@section('content')
    <form action="{{ route('blog.article.save', ['article' => isset($article) ? $article->id : null]) }}" method="post">
        {!! csrf_field() !!}
        <div class="input-group">
            <span class="input-group-addon">类别</span>
            <select multiple id="tags" name="topics[]" style="display: none" data-role="tagsinput">
                @foreach($article->topics as $topic)
                    <option value="{{ $topic->name }}" selected>{{ $topic->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="input-group">
            <span class="input-group-addon">标题</span>
            <input type="text" class="form-control" name="title" id="title" value="{{ $article->title }}">
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
    {!! HTML::style('css/bootstrap-tagsinput.css') !!}
    {!! HTML::style('css/bootstrap-tagsinput-typeahead.css') !!}
@endsection

@section('javascripts')
    {!! HTML::script('markdown/editormd.js') !!}
    {!! HTML::script('js/bootstrap-tagsinput.min.js') !!}
    {!! HTML::script('js/typeahead.bundle.js') !!}
    <script>
        var editor;
        var article = {!! json_encode($article) !!};
        var topics = {!! json_encode($topics) !!};

        var topicMatcher = function (topics) {
            return function findMatches(q, cb) {
                var matches, substrRegex;
                matches = [];
                substrRegex = new RegExp(q, 'i');
                $.each(topics, function (i, topic) {
                    if (substrRegex.test(topic.name)) {
                        matches.push(topic);
                    }
                });
                cb(matches);
            };
        };

        $('#tags').tagsinput({
            typeaheadjs: {
                source: topicMatcher(topics),
                name: 'topics',
                displayKey: 'name',
                valueKey: 'name'
            }
        });

        $(function () {
            editor = editormd({
                id: 'editor',
                path: '{{ asset('markdown/lib') }}/',
                height: 800,
                syncScrolling: 'single',
                saveMarkdownToTextarea: true,
                emoji: true,
                onload: function () {
                    editor.setMarkdown(article.content);
                }
            });
        });

        $('#submit').click(function () {
            $('#content').val(editor.getMarkdown());
            $('#topics').html('');
            var selectedTopics = $('#tags').tagsinput('items');
            for (var i in selectedTopics) {
                $('<option>').attr('value', selectedTopics[i]).attr('selected', true).appendTo($('#topics'));
            }
//            alert(editor.getMarkdown());
            $('form').submit();
        });
    </script>
@endsection