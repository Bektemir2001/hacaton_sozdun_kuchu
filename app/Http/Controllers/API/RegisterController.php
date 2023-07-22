<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);
        $user = User::create($data);
        return response(['data' => $user]);
    }
}
