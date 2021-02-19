<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Doctor;
use App\Models\Patient;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('roles')->paginate(15, ['id', 'name', 'email', 'contact_number']);
        return view('user.main', ['users' => $users]);
    }

    public function add()
    {
        $roles = Role::all('id', 'name');
        return view('user.add', ['roles' => $roles]);
    }

    public function search(Request $request)
    {
        if ($request->filled('q')) {
            $searchParams = trim($request->get('q'));

            $users = User::where('name', 'like', "%{$searchParams}%")
                ->orWhere('email', 'like', "%{$searchParams}%")
                ->paginate(15);

            return view('user.main', ['users' => $users]);
        } else {
            return view('user.main', ['users' => User::paginate(15)]);
        }
    }

    public function edit(Request $request)
    {
        $user = User::find($request->get("userId"));
        $userRoles = $user->roles->pluck('name');
        $user->userRole = $userRoles;

        return view('user.edit', ['user' => $user, 'message' => $request->get('message')]);
    }
}
