<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController
{
    public function login(Request $request)
    {
        $data = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $user = User::where('email', $data['email'])->first();
        if(!$user)
        {
            return response(['message' => 'user not found'])->setStatusCode(404);
        }
        if($user->password !== $data['password'])
        {
            return response(['message' => 'wrong password'])->setStatusCode(422);
        }
        return response(["data" => $user]);
    }
}
