<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\EventRequest;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $events = Event::all();
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        // return $request;
        Event::create([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'category' => $request->category,
            'location' => $request->location,
            'capacity' => $request->capacity,
            'available_tickets' => $request->capacity,
        ]);

        return response()->json([
            'message' => 'The event added successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::findOrFail($id);
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        $event = Event::findOrFail($id);
        $event->update([
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'category' => $request->category,
            'location' => $request->location,
            'capacity' => $request->capacity,
        ]);

        return response()->json([
            'message' => 'The event updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $event = Event::findOrFail($id);
        $event->delete();

        return response()->json([
            'message' => 'The event deleted successfully!',
        ]);
    }
}
