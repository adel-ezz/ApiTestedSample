<?php

namespace App\Http\Controllers\Api;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    use BaseApiController;

    ///=====================Login============================//
    public function login(Request $request)
    {

        $rules = [
            'email' => 'required|email',
            'password' => 'required',
        ];
        $data = $this->validate(request(), $rules, [], [
            'email' => __('email'),
            'password' => __('password')
        ]);

        $email = $request->get('email');
        $usingEmail = Auth::attempt(['email' => $email, 'password' => $request->password], $request->remember);

        if ($usingEmail) {
            $user = User::where('email', $email)->first();

            $token = $user->createToken('Chat')->accessToken;
            $data = ['user' => $user, 'token' => $token];
            return $this->apiResponse($data, '', '200');
        }
        return $this->apiResponse('', __('Something wrong'), '401');


    }
}
