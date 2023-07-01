<?php

namespace App\Http\Controllers;

use App\Models\Composer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HelpersController extends Controller
{
    public function addComposerHelpers(Composer $composer)
    {
        return $this->addHelpers($composer->helpers()->get(), $composer->id, 'composer');
    }

    public function addUserHelpers(User $user)
    {
        return $this->addHelpers($user->helpers()->get(), $user->id, 'user');
    }

    public function addHelpers($existingHelpers, $helpableId, $helpableType)
    {
        $users = User::select(DB::raw("CONCAT(first_name, ' ', last_name) AS display_name"),'id')
            ->whereNotNull('first_name')
            ->orderBy('first_name')
            ->get();

        return view(
            'helpers.index',
            compact('existingHelpers', 'users', 'helpableType', 'helpableId')
        );
    }

    public function saveHelpers(Request $request)
    {
        $customMessages = [
            'helpers.required' => 'Tafadhali chagua walau mtu mmoja',
            'helpable_type.required' => 'Tafadhali jaribu tena',
            'helpable_id.required' => 'Tafadhali jaribu tena',
        ];

        $this->validate(
            $request,
            [
                'helpers' => 'required',
                'helpable_type' => 'required',
                'helpable_id' => 'required',
            ],
            $customMessages
        );

        $helpers = [];
        foreach($request->input('helpers') as $helperId) {
            $helpers[] = [
                'helper_id' => $helperId,
                'helpable_type' => $request->input('helpable_type'),
                'helpable_id' => $request->input('helpable_id'),
            ];
        }

        DB::table('helpers')
            ->insert($helpers);

        User::whereIn('id', $request->input('helpers'));

    }
}
