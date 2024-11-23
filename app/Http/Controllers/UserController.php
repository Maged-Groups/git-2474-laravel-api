<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all users' data
        // return User::get();
        // return User::all();

        // Get specific fields
        // return User::all(['id', 'name', 'roles']);
        // return User::get(['id', 'name', 'roles']);

        // Get all user with count of posts for each user

        // return User::with('posts')->get();
        // return User::withCount('posts')->get();
        return User::with('posts')->withCount('posts')->get();
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        // return $request->mobile;
        $data = $request->validated(); // return an array

        return User::create($data);

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // Get single user with her/his posts and comments
        // return User::
        //     with('posts')
        //     ->with('comments')
        //     ->where('id', '=', $id)
        //     ->first();

        return User::
            with(['posts.comments.user', 'posts.postStatus'])
            ->where('id', '=', $id)
            ->first();
    }



    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        // return $request;
        $data = $request->validated();

        if ($user->update($data))
            return 'User Updated Successfully';

        return 'Something went wrong, please reload the page and try again';

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        return $user;
    }


    /**
     * Show all employees in specific role.
     */
    public function role($role)
    {
        return User::where('roles', $role)->get();

    }


}
