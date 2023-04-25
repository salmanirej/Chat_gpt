<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\room_user as RoomUser;
class Room_userController extends Controller
{
    public function index()
    {
        $room_users = RoomUser::all();

        return view('room_user.index', compact('room_users'));
    }

    public function create()
    {
        return view('room_user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'room_id' => 'required'
        ]);

        $room_user = RoomUser::create($request->all());

        return redirect()->route('room_user.index')
            ->with('success', 'Room User created successfully.');
    }

    public function edit(RoomUser $room_user)
    {
        return view('room_user.edit', compact('room_user'));
    }

    public function update(Request $request, RoomUser $room_user)
    {
        $request->validate([
            'user_id' => 'required',
            'room_id' => 'required'
        ]);

        $room_user->update($request->all());

        return redirect()->route('room_user.index')
            ->with('success', 'Room User updated successfully');
    }

    public function destroy(RoomUser $room_user)
    {
        $room_user->delete();

        return redirect()->route('room_user.index')
            ->with('success', 'Room User deleted successfully');
    }
}
