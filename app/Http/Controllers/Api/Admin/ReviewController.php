<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Review;
use App\Http\Requests\ReviewRequest;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reviews = Review::all();
        return response()->json($reviews);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ReviewRequest $request)
    {
        Review::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'event_id' => $request->event_id,
            ],
            [
                'rating' => $request->rating,
                'updated_at' => now(),
            ],
        );  
        return response()->json([
            'message' => 'success',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $review = Review::findOrFail($id);
        return response()->json($review);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ReviewRequest $request, string $id)
    {
        $review = Review::findOrFail($id);
        $review->update([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
            'rating' => $request->rating,
        ]);

        return response()->json([
            'message' => 'The Review Updated Successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $review = Review::findOrFail($id);
        if($review->user_id == Auth::id() || Auth::user()->role == 'admin') {
            $review->forceDelete();
            
            return response()->json([
                'message' => 'The Review Deleted Successfully!',
            ]);
        } else {
            return response()->json([
                'message' => 'U r not allowed to delete this review, due to u r not admin or this review not yours, Thanks!',
            ]);
        }

    }
}
