<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Passwords\PasswordBrokerManager;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\ValidationException;
use Illuminate\Contracts\Auth\PasswordBroker;

class ResetsPasswordsController extends Controller
{

    /**
     * @throws ValidationException
     */
    public function generateResetToken(Request $request): JsonResponse
    {
        // Check email address is valid
        $this->validate($request, ['email' => 'required|email']);

        // Send password reset to the user with this email address
        $response = $this->broker()->sendResetLink(
            $request->only('email')
        );
        return $response == Password::RESET_LINK_SENT
            ? response()->json(true)
            : response()->json(false);
    }

    /**
     * @throws ValidationException
     */
    public function resetPassword(Request $request): JsonResponse
    {
        if($request->isMethod('patch')) {
            $useData = $request->input();

            $rules = [
                'token' => 'required',
                'email' => 'required|string',
                'password' => 'required|min:6',
            ];
            $this->validate($request, $rules);

            // Reset the password
            $response = $this->broker()->reset(
                $this->credentials($request),
                function ($user, $password) {
                    $user->password = app('hash')->make($password);
                    $user->save();
                }
            );

            return $response == Password::PASSWORD_RESET
                ? response()->json(true)
                : response()->json(false);
        }
        return response()->json(['error' => 'wrong method'], 401);
    }

    /**
     * Get the password reset credentials from the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    protected function credentials(Request $request): array
    {
        return $request->only('email', 'password', 'token');
    }

    /**
     * Get the broker to be used during password reset.
     *
     * @return PasswordBroker
     */
    public function broker(): PasswordBroker
    {
        $passwordBrokerManager = new PasswordBrokerManager(app());
        return $passwordBrokerManager->broker();
    }

}
