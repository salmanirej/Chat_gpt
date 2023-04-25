<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Events\MessageSent;
class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        $message = $request->input('message');

        // يتم إرسال الحدث وإرجاع الرسالة إلى العميل
        $message = broadcast(new MessageSent($message))->toOthers();

        return ['status' => 'Message Sent!'];
    }
}
