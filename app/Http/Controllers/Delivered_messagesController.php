<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\delivered_messages as DeliveredMessage;
class Delivered_messagesController extends Controller
{
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $delivered_messages = DeliveredMessage::all();
        // return view('delivered_messages.index', compact('delivered_messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('delivered_messages.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'message_id' => 'required',
            'receiver_id' => 'required',
        ]);

        DeliveredMessage::create($request->all());

        // return redirect()->route('delivered_messages.index')
        //     ->with('success', 'Delivered message created successfully.');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\DeliveredMessage  $deliveredMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(DeliveredMessage $deliveredMessage)
    {
        return view('delivered_messages.edit', compact('deliveredMessage'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\DeliveredMessage  $deliveredMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, DeliveredMessage $deliveredMessage)
    {
        $request->validate([
            'message_id' => 'required',
            'receiver_id' => 'required',
        ]);
     
        $deliveredMessage->update($request->all());

        // return redirect()->route('delivered_messages.index')
        //     ->with('success', 'Delivered message updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\DeliveredMessage  $deliveredMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(DeliveredMessage $deliveredMessage)
    {
        $deliveredMessage->delete();

        // return redirect()->route('delivered_messages.index')
        //     ->with('success', 'Delivered message deleted successfully');
    }
}
