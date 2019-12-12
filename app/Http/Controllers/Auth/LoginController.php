<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use Symfony\Component\HttpFoundation\JsonResponse;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Get a JWT via given credentials.
     * @param Request $request
     * @return JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $credentials = $request->only(['email', 'password']);

        if (!$token = auth()->attempt($credentials)) {
            return $this->sendFailedLoginResponse();
        }

        return $this->respondWithToken($token);
    }

    /**
     * Log the user out (ie. invalidate the token).
     * @return JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return $this->respond('Bye!');
    }

    /**
     * Refresh a token.
     * @return JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    /**
     * Return the authenticated User.
     * @return JsonResponse
     */
    public function user()
    {
        return $this->respond(auth()->user());
    }

    /**
     * Respond with JSON instead of redirecting failed authentication attempts in AuthenticatesUsers.
     * @return JsonResponse
     */
    protected function sendFailedLoginResponse()
    {
        return Controller::respondWithError(Lang::get('auth.failed'), 401);
    }

    /**
     * Get the token array structure.
     * @param string $token
     * @return JsonResponse
     */
    protected function respondWithToken($token)
    {
        $auth = auth();
        $user = $auth->user();

        return $this->respond([
            'token' => $token,
            'type' => 'bearer',
            'expires_in' => $auth->factory()->getTTL() * 60,
        ]);
    }
}
