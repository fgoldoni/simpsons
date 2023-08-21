<?php

namespace Modules\Auth\Http\Controllers\Api;

use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Responsable\JsonResponse;
use Illuminate\Auth\AuthManager;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Validation\ValidationException;
use JustSteveKing\StatusCode\Http;

class AuthController extends Controller
{
    public function __construct(private readonly AuthManager $authManager)
    {
    }


    public function login(LoginRequest $request): JsonResponse
    {
        try {
            $token = $request->authenticate($this->authManager);

            if (! $token) {
                RateLimiter::hit($request->throttleKey());

                throw ValidationException::withMessages([
                    'email' => __('auth.failed'),
                ]);
            }

            RateLimiter::clear($request->throttleKey());

            return new JsonResponse(
                data: [
                    'authorisation' => $this->respondWithToken($token),
                    'message' => __('success'),
                ],
            );
        } catch (\Exception $e) {
            return new JsonResponse(
                data: [
                    'message' => $e->getMessage(),
                ],
                status: Http::INTERNAL_SERVER_ERROR,
            );
        }
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        try {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
            ]);

            $token = $request->token($this->authManager, $user);

            return new JsonResponse(
                data: [
                    'user' => $user,
                    'authorisation' => $this->respondWithToken($token)
                ]
            );

        } catch (\Exception $e) {
            return new JsonResponse(
                data: [
                    'message' => $e->getMessage(),
                ],
                status: Http::INTERNAL_SERVER_ERROR,
            );
        }
    }

    public function me(): JsonResponse
    {
        try {
            return new JsonResponse(
                data: [
                    'user' => $this->authManager->guard('api')->user(),
                ],
            );

        } catch (\Exception $e) {
            return new JsonResponse(
                data: [
                    'message' => $e->getMessage(),
                ],
                status: Http::INTERNAL_SERVER_ERROR,
            );
        }
    }

    private function respondWithToken($token): array
    {
        return [
            'token' => $token,
            'type' => 'Bearer',
            'expires_in' => $this->authManager->factory()->getTTL() * 60
        ];
    }

    public function refresh(): array
    {
        return $this->respondWithToken($this->authManager->refresh());
    }
}
