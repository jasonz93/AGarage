@extends('layouts.with_navbar')

@section('title')
    留言板
@endsection

@section('content')
    <h3>留言内容</h3>
    @foreach($messages as $message)
        <div id="msg-{{ $message->id }}" class="panel panel-default">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-md-9">
                        {{ $message->user->nickname }} @ {{ $message->created_at }}
                    </div>
                    <div class="col-md-3 text-right">
                        @if(Auth::check())
                            <a class="btn btn-success btn-reply" data-toggle="{{ $message->id }}">回复</a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="panel-body">
                {{ $message->content }}
                @include('guestbook.message_replies', ['messages' => $message->replies])
            </div>
            <div id="reply-{{ $message->id }}"></div>
        </div>
    @endforeach
    {!! $messages->links() !!}

    @if(Auth::check())
    <div class="panel panel-default">
        <div class="panel-heading">留言</div>
        <div class="panel-body">
            <form method="post">
                {!! csrf_field() !!}
                <textarea class="form-control" name="content"></textarea>
                <button class="btn btn-primary" type="submit">提交</button>
            </form>
        </div>
    </div>
    @else
        <h3>留言请先登录</h3>
    @endif
@endsection

@section('javascripts')
    <script>
        $('.btn-reply').click(function (btn) {
            var msgId = $(btn.toElement).attr('data-toggle');
            var parent = $('#reply-' + msgId);
            parent.html('');
            var footer = $('<div class="panel-footer">').appendTo(parent);
            var content = $('<textarea class="form-control" name="content">').appendTo(footer);
            $('<a class="btn btn-primary">').text('提交').click(function () {
                $.ajax({
                    url: '{{ route('guestbook') }}/'+msgId+'/reply',
                    type: 'POST',
                    data: {
                        content: content.val()
                    },
                    success: function (data) {
                        console.log(data);
                        location.reload();
                    }
                });
            }).appendTo(footer);
            $('<a class="btn btn-default">').text('取消').click(function () {
                parent.html('');
            }).appendTo(footer);
            content.focus();
        });
    </script>
@endsection