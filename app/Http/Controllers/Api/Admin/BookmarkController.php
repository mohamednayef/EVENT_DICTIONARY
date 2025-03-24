<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Bookmark;
use App\Http\Requests\BookmarkRequest;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $bookmarks = Bookmark::all();
        return response()->json($bookmarks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BookmarkRequest $request)
    {
        Bookmark::create([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
        ]);

        return response()->json([
            'message' => 'The book mark Stored Successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $bookmark = Bookmark::findOrFail($id);
        return response()->json($bookmark);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BookmarkRequest $request, string $id)
    {
        $bookmark = Bookmark::findOrFail($id);
        $bookmark->update([
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
        ]);

        return response()->json([
            'message' => 'The Bookmark Updated Succesfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $bookmark = Bookmark::findOrFail($id);
        $bookmark->delete();

        return response()->json([
            'message' => 'The Bookmark Deleted Succesfully!',
        ]);
    }

    public function mybookmarks()
    {
        $myBookmarks = Bookmark::where('user_id', Auth::id())->get();

        return response()->json($myBookmarks);
    }
}
