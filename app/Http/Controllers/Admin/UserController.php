<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class UserController extends Controller
{
    public function edit(User $user)
    {
        return view(
            'users.admin.edit',
            compact(
                'user'
            )
        );
    }

    public function update(User $user, Request $request)
    {
        $customMessages = [
            'first_name.required' => 'Jina la kwanza linahitajika',
            'last_name.required' => 'Jina la pili linahitajika',
            'email.unique' => 'Email hii ishatumika. Tafadhali login',
            'phone.unique' => 'Namba hii ishatumika. Tafadhali login au sajili kutumia namba nyingine',
            'phone.required' => 'Namba ya simu ni lazima ujaze.',
            'phone.phone' => 'Namba ya simu uliyoweka ina kasoro. Tafadhali soma maelezo hapo chini.',
        ];

        $this->validate(
            $request,
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'sometimes|nullable|email|max:255|unique:users,id,' . $user->id,
                'phone' => 'required|string|max:255|phone:AUTO|unique:users,id,' . $user->id,
            ],
            $customMessages
        );

        $user->update(
            $request->except(['_token'])
        );

        return redirect('/users' )
            ->with('message', 'Taarifa za user zimeboreshwa!');
    }
}
