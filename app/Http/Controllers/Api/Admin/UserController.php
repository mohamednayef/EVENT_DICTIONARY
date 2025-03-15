<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\SoftDeletes;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        User::create([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => $request->password,
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'User created successfully!',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return response()->json($user);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UserRequest $request, string $id)
    {
        // dd($request->all());
        $user = User::findOrFail($id);

        $user->update([
            'fname' => $request->fname,
            'lname' => $request->lname,
            'username' => $request->username,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'phone' => $request->phone,
            'image_path' => $request->image_path,
            'gneder' => $request->gneder,
            'role' => $request->role,
        ]);

        return response()->json([
            'message' => 'User Updated Successfully!',
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message'=>'User deleted successfully!'
        ]);
    }

    public function restore(string $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return response()->json([
            'message' => 'User restored successfully!',
        ]);
    }

    // public function forceDelete(string $id) 
    // {
    //     $user = User::withTrashed()->findOrFail($id);
    //     $user->forceDelete();

    //     return response()->json([
    //         'message' => 'User permanetly deleted!',
    //     ]);
    // }
}
