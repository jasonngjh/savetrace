<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;
use Illuminate\Support\Facades\Route;

class LoginResponse implements
    LoginResponseContract
{

    public function toResponse($request)
    {

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade

        if ($request->user()->hasRole('admin')) {
            $home = 'users';
        } else {
            $home = 'home';
        }

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect()->route($home);
    }
}
