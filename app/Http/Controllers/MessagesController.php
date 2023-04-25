<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\messages as Message ;
use App\Events\NewMessage;
use app\Models\room_user;
class MessagesController extends Controller
{
    public function index()
    {
        $messages = Message::all();
      //  return view('messages.index', compact('messages'));
    }

    public function create()
    {
        return view('messages.create');
    }

    public function store(Request $request)
    {
   
        $message = new Message;
        $message->message = $request->input('message');
        $message->room_id = 1;
        $message->sender_id = auth()->id();
        $message->save();

     //  Message::create($request->all());

       // إرسال الحدث مع بيانات الرسالة
    event(new NewMessage($message), [
        'user_id' => auth()->id(),
        'message_content' => $message->message,
        'created_at' => $message->created_at->format('Y-m-d H:i:s')
    ]);



    return response()->json(['success' => true]);

    }

    public function edit(Message $message)
    {
        return view('messages.edit', compact('message'));
    }

    public function update(Request $request, Message $message)
    {
        $request->validate([
            'message' => 'required',
            'sender_id' => 'required',
            'receiver_id' => 'required',


        ]);

        $message->update($request->all());

        // return redirect()->route('messages.index')
        //     ->with('success', 'Message updated successfully');
    }

    public function destroy(Message $message)
    {
        $message->delete();

        // return redirect()->route('messages.index')
        //     ->with('success', 'Message deleted successfully');
    }
}
