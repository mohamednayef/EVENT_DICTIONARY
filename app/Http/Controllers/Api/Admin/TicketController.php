<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TicketRequest;
use App\Models\Ticket;

class TicketController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tickets = Ticket::all();
        return response()->json($tickets);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TicketRequest $request)
    {
        Ticket::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Ticket Booked Successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        return response()->json($ticket);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TicketRequest $request, string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->update([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'type' => $request->type,
            'status' => $request->status,
            'price' => $request->price,
        ]);

        return response()->json([
            'message' => 'Ticket Updated Successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return response()->json([
            'message' => 'Ticket Deleted Succesfully!',
        ]);
    }
}
