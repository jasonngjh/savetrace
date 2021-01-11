<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\Auth\StatefulGuard;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Auth\Events\Registered;
use App\Actions\Fortify\ResetUserPassword;
use Illuminate\Support\Facades\Redirect;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UserController extends Controller
{
    public function index()
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln("");

        $users = User::paginate(15, ['id', 'name', 'email', 'contact_number']);
        foreach ($users as $user) {
            $roleOfUser = $user->roles->pluck('name')->toArray();
            $user->push('roles', $roleOfUser);
        }

        return view('user.main', ['users' => $users]);
    }

    public function setPassword(Request $request)
    {
        app(ResetUserPassword::class)->reset($request->user(), $request->all());

        $request->user()->forceFill([
            'first_time_login' => false,
        ])->save();

        return redirect('login')->with('status', 'Password has been set! Log In Now!');;
    }

    public function add()
    {
        $roles = Role::all('id', 'name');
        return view('user.add-new-user', ['roles' => $roles]);
    }

    public function addPost(Request $request, CreatesNewUsers $creator)
    {
        $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        $output->writeln($request);

        $temp_password = random_bytes(32);
        $request->request->add(['password' => $temp_password, 'password_confirmation' => $temp_password]);

        $output->writeln($request);

        event(new Registered($user = $creator->create($request->all())));
        $user->assignRole($request['role']);

        return view('user.main', ['users' => User::paginate(15), 'message' => $user->name . ' has been created']);
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
        $user->push('userRole', $userRoles);

        $roles = Role::whereNotIn('name', [$userRoles])->get();
        return view('user.edit', ['user' => $user, 'roles' => $roles, 'message' => $request->get('message')]);
    }

    public function editPost(Request $request, UpdatesUserProfileInformation $updater)
    {
        // $output = new \Symfony\Component\Console\Output\ConsoleOutput();
        // $output->writeln($request);

        $user = User::find($request->get("userId"));
        $updater->update($user, $request->all());
        $user->assignRole($request['role']);

        $user = User::find($request->get("userId"));

        return redirect()->route('users.edit', ['userId' => $user->id, 'message' => $user->name . ' has been successfully saved']);
    }
}
