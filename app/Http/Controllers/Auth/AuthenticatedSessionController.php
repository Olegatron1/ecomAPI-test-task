<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthenticatedSessionController extends Controller
{
	/**
	 * Handle an incoming authentication request.
	 * @throws ValidationException
	 */
	public function store(LoginRequest $request)
	{
		$request->authenticate();

		$user = Auth::user();

		$token = $user->createToken('api_token')->plainTextToken;

		return response()->json([
			'message' => 'User logged in successfully',
			'token' => $token,
			'user' => $user
		], 200);
	}

	/**
	 * Destroy an authenticated session (Logout).
	 */
	public function destroy(Request $request): JsonResponse
	{
		if (Auth::check()) {

			$user = $request->user();

			if ($user->currentAccessToken()) {

				$user->currentAccessToken()->delete();

				return response()->json([
					'message' => 'User logged out successfully'
				], 200);
			}

			return response()->json([
				'message' => 'No active token found'
			], 404);
		}

		return response()->json([
			'message' => 'User not authenticated'
		], 401);
	}
}
