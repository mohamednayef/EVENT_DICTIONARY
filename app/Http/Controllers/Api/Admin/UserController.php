<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;


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
        $user = User::findOrFail($id);
        
        if($request->role == 'amdin' && Auth::user()->role != 'admin') {
            return response()->json([
                'message' => 'U r not allowed to change your role, the admin only can do this, Thanks!',
            ]);
        }

        if(Auth::user()->role == 'admin' || Auth::id() == $user->id) {
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
        } else {
            return response()->json([
                'message' => 'U r not allowed to update this profile',
            ]);
        }
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

    public function profile()
    {
        return response()->json(User::findOrFail(Auth::id()));
    }

    public function updateMyProfile(UserRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        
        if($request->role == 'amdin' && Auth::user()->role != 'admin') {
            return response()->json([
                'message' => 'U r not allowed to change your role, the admin only can do this, Thanks!',
            ]);
        }

        if(Auth::user()->role == 'admin' || Auth::id() == $user->id) {
            if($user->isDirty()) {
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
                    'user' => $user,
                ]);
            } else {
                return response()->json([
                    'message' => 'User updated Successfully!',
                    'user' => $user,
                ]);
            }
        } else {
            return response()->json([
                'message' => 'U r not allowed to update this profile',
                'user' => $user,
            ]);
        }
    }

    public function deleteMyProfile()
    {
        User::findOrFail(Auth::id())->forceDelete();

        return response()->json([
            'message' => "success",
        ]);
    }
}
