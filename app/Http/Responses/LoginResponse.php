<?php

namespace App\Http\Responses;

use Illuminate\Support\Facades\Auth;
use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements
    LoginResponseContract
{

    public function toResponse($request)
    {

        // below is the existing response
        // replace this with your own code
        // the user can be located with Auth facade

        if ($request->user()->first_time_login == true) {
            $home = '/set-password';
        } else {
            if ($request->user()->hasRole('admin')) {
                $home = '/users';
            } else {
                $home = '/dashboard';
            }
        }
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln($home);

        return $request->wantsJson()
            ? response()->json(['two_factor' => false])
            : redirect($home);
    }
}
