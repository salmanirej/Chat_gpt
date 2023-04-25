<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\room;
class RoomController extends Controller
{

    public function index()
    {
        $rooms = Room::all();
        return view('rooms.index', compact('rooms'));
    }
    
    public function create()
    {
        return view('rooms.create');
    }
    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:rooms|max:255',
            'description' => 'required',
        ]);
    
        $room = Room::create($validatedData);
    
        return redirect()->route('rooms.index')->with('success', 'تم إضافة الغرفة بنجاح.');
    }
    
    public function edit($id)
    {
        $room = Room::findOrFail($id);
        return view('rooms.edit', compact('room'));
    }
    
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255|unique:rooms,name,'.$id,
            'description' => 'required',
        ]);
    
        $room = Room::findOrFail($id);
        $room->update($validatedData);
    
        return redirect()->route('rooms.index')->with('success', 'تم تحديث بيانات الغرفة بنجاح.');
    }
    
    public function destroy($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
    
        return redirect()->route('rooms.index')->with('success', 'تم حذف الغرفة بنجاح.');
    }
      
    
}
