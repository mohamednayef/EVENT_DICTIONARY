<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Event;
use App\Http\Requests\EventRequest;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $events = Event::all();
        $events = Event::withCount('reviews')->get();
        return response()->json($events);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventRequest $request)
    {
        $imagePath = null;
        if($request->hasFile('image_path')) {
            $image = $request->file('image_path');
            $imagePath = $image->store('event', 'public');
        }

        $event = Event::create([
            'category_id' => $request->category_id,
            'category' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'capacity' => $request->capacity,
            'available_tickets' => $request->capacity,
            'price' => $request->price,
            'image_path' => "http://localhost:8000/storage/".$imagePath,
        ]);

        return response()->json([
            'message' => 'success',
            'event' => $event,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $event = Event::withCount('reviews')->findOrFail($id);
        return response()->json($event);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(EventRequest $request, string $id)
    {
        $event = Event::findOrFail($id);

        $imagePath = explode("storage/", $event->image_path)[1];
        if($request->hasFile('image_path')) {
            // Delete the image first.
            if ($event->image_path && Storage::disk('public')->exists($imagePath) && $imagePath != "event/default.jpg") {
                Storage::disk('public')->delete($imagePath);
            }
            $image = $request->file('image_path');
            $imagePath = $image->store('event', 'public');
        }

        $event->update([
            'category_id' => $request->category_id,
            'category' => $request->category,
            'name' => $request->name,
            'description' => $request->description,
            'date' => $request->date,
            'location' => $request->location,
            'capacity' => $request->capacity,
            'price' => $request->price,
            'image_path' => "http://localhost:8000/storage/".$imagePath,
        ]);

        return response()->json([
            'message' => 'success',
            'event' => $event,
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
            'message' => 'success',
        ]);
    }
}
