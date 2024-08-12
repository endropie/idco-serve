<?php

namespace App\Http\ApiControllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login (Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->email)->first();

        if (! $user || ! Hash::check($request->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ])->status(422);
        }

        $deviceName = $request->header('X-DEVICE-APP', 'testing');

        /** @var \Laravel\Sanctum\NewAccessToken $token */
        $token = $user->createToken($deviceName);

        return response()->json([
            "type" => "Bearer",
            "token" => $token->plainTextToken,
            // "expired_in" => $token,
        ]);
    }

    public function show (Request $request)
    {
        $user = $request->user();
        return new Response($user);
    }
}
