@foreach($messages as $message)
    <div class="panel panel-default">
        <div class="panel-body">
            <div class="col-md-11">
                {{ $message->user->nickname }} @ {{$message->created_at}}<br>
                {{ $message->content }}
                @include('guestbook.message_replies', ['messages' => $message->replies])
            </div>
            <div class="col-md-1 text-right">
                @if(Auth::check())
                    <a class="btn btn-success btn-reply" data-toggle="{{ $message->id }}">回复</a>
                @endif
            </div>
        </div>
        <div id="reply-{{ $message->id }}"></div>
    </div>
@endforeach