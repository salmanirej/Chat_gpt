<?php

namespace App\Http\Controllers;
use Illuminate\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\room as Room ;
use App\Models\messages as Messages ;
use App\Models\room_user as Room_user ;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $userId =  auth()->id();
        $ids_rooms = Room_user::where('user_id', $userId)->pluck('room_id');
      
        
        $rooms = Room::whereIn('id',$ids_rooms )->get() ;
        $room_id = 2; // افترضنا أن $room_id هو المعرف الخاص بالغرفة التي تريد عرض الرسائل الخاصة بها
         
        $messages = DB::table('messages')
                     ->select('room_id', 'message', 'created_at', DB::raw('CASE WHEN sender_id = 1 THEN true ELSE false END AS sender_id_equal_to_1'))
                     ->where('room_id', '=', $room_id)
                     ->orderBy('created_at', 'asc')
                     ->get();
        
 //return view('index');           
  return view('home',["rooms" =>  $rooms,"messages" =>  $messages]);
    }
}
