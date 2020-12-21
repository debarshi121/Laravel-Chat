<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Events\MessageSent;

class MessageController extends Controller
{
    public function fetchMessages(){
        return Message::with('user')->get();
    }

    public function sendMessages(Request $request){

        $message = new Message;
        $message->message = $request->message;

        $messageData = auth()->user()->messages()->save($message);

        broadcast(new MessageSent(auth()->user(), $messageData->load('user')))->toOthers();

        return response([
            'status' => 'Message sent.'
        ]);
    }
}
