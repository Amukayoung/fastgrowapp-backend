<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return User::All();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userDetails = $request->validate([
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'user_name' => 'nullable|string',
            'country_code' => 'nullable|string',
            'telephone_number' => 'nullable|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user_info = User::Create([
            'first_name'=>$userDetails['first_name'],
            'last_name' => $userDetails['last_name'],
            'user_name' => $userDetails['user_name'],
            'country_code' => $userDetails['country_code'],
            'telephone_number' => $userDetails['telephone_number'],
            'email' => $userDetails['email'],
            'password' => bcrypt($userDetails['password'])
        ]);

        $access_token = $user->createToken('my_access_token')->plainTextToken;
        $reponse = [
            'user' => $user,
            'token' => $access_token
        ];

        return response($reponse, 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
