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
        $bookmark = Bookmark::where('user_id', Auth::id())->where('event_id', $request->event_id)->get();

        if($bookmark->isNotEmpty()) {
            return response()->json([
                'message' => 'The bookmark is already Stored!',
            ]);
        }
        
        Bookmark::create([
            'user_id' => Auth::id(),
            'event_id' => $request->event_id,
        ]);
        
        return response()->json([
            'message' => 'success',
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
        $bookmark = Bookmark::where('event_id', $id)->where('user_id', Auth::id());
        dd($bookmark->user_id);
        // dd(Auth::user()->role == 'admin');
        // dd(Auth::id() == $bookmark->user_id);
        // dd(Auth::id());
        dd($bookmark->user_id);
        if(Auth::user()->role == 'admin' || Auth::id() == $bookmark->user_id) {
            $bookmark->forceDelete();
    
            return response()->json([
                'message' => 'The Bookmark Deleted Succesfully!',
            ]);
        } else {
            return response()->json([
                'message' => 'U r not allowed to delete this bookmark, due to u r not admin or this bookmark not yours, Thanks!',
            ]);
        }
    }

    public function mybookmarks()
    {
        $myBookmarks = Bookmark::where('user_id', Auth::id())->get();

        return response()->json($myBookmarks);
    }
}
