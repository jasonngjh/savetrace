<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        return view('user.main', ['users' => User::simplePaginate(15)]);
    }

    public function search(Request $request)
    {
        if ($request->filled('q')) {
            $searchParams = trim($request->get('q'));

            if (empty($searchParams))
                return view('user.main');

            $users = User::query()
                ->where('name', 'like', "%{$searchParams}%")
                ->orWhere('email', 'like', "%{$searchParams}%")
                ->get();



            return view('user.main', ['users' => $users]);
        } else {
            return view('user.main');
        }
    }
}
