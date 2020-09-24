<?php

namespace App\Http\Controllers;

use App\Models\User;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;

class AdminUserController extends Controller
{
    public function index()
    {
        if(request()->query('q')) {
            $users = User::where('first_name', 'like', '%' . request()->query('q') . '%')
                ->orWhere('last_name', 'like', '%' . request()->query('q') . '%')
                ->paginate(20);
        } else {
            $users = User::orderBy('first_name')
                ->whereNotNull('first_name')
                ->paginate(20);

        }

        return view(
            'account.users',
            compact('users')
        );
    }

    public function assign($role, User $user) {
        $role = Role::whereName($role)
            ->firstOrFail();

        $user->assignRole($role);

        return back()->with('message', 'Umempa ' . $user->name . ' uwezo wa ' . $role->name);
    }

    public function remove($role, User $user) {
        $role = Role::whereName($role)
            ->firstOrFail();

        $user->removeRole($role);

        return back()->with('message', 'Umeondoa uwezo wa ' . $role->name . ' kwa ' . $user->name);
    }
}
