<?php
/**
 * Created by PhpStorm.
 * User: Nicholas
 * Date: 2016/3/11
 * Time: 23:59
 */

namespace AGarage\Http\Controllers;


use AGarage\GuestbookMessage;

class GuestbookController extends Controller
{
    public function getGuestbook() {
        $messages = GuestbookMessage::where('parent_id', '=', 0)->orderBy('created_at', 'desc')->paginate(15);

        return view('guestbook.messages', [
            'messages' => $messages
        ]);
    }

    public function postGuestbook() {
        $message = new GuestbookMessage();
        $message->user()->associate(\Auth::user());
        $message->content = \Request::input('content');
        $message->saveOrFail();
        return \Response::redirectToRoute('guestbook');
    }

    public function postReply(GuestbookMessage $message) {
        $reply = new GuestbookMessage();
        $reply->user()->associate(\Auth::user());
        $reply->parent()->associate($message);
        $reply->content = \Request::input('content');
        $reply->saveOrFail();
        return \Response::json($reply);
    }
}