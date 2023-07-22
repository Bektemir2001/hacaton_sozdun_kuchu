<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController
{
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users',
            'password' => 'required'
        ]);
        $data['password'] = Hash::make($data['password']);
        $user = User::create($data);
        return response(['data' => $user]);
    }
}
