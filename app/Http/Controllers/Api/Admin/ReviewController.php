<?php

namespace App\Http\Controllers\Api\Admin;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ReviewRequest;
use App\Models\Review;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        Review::create([
            // 'user_id' => Auth::id(),
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'message' => 'The review wes recoreded',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, string $id)
    {
        $review = Review::findOrfail($id);
        $review->update([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'message' => 'The review updated successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
