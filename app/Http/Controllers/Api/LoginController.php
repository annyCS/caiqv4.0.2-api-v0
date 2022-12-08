<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:sanctum');
    }

    public function __invoke(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
            'device_name' => ['required'],
        ]);

        $user = User::whereEmail($request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => [__('auth.failed')]
            ]);
        }

        return new TokenResponse($user);
    }
}
