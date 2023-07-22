<?php

namespace App\Http\Controllers\API;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;

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
            $errorResponse = [
                'error' => 'Not found',
                'message' => 'Запрошенные данные не найдены.',
            ];
            return response()->json($errorResponse, Response::HTTP_NOT_FOUND);
        }
        if(!Hash::check($data['password'], $user->password))
        {
            $errorResponse = [
                'error' => 'Wrong password',
                'message' => 'Wrong password',
            ];
            return response()->json($errorResponse, Response::HTTP_NOT_ACCEPTABLE);
        }
        return response(["data" => $user]);
    }
}
