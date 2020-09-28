<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Services\SmsService;
use Artesaos\SEOTools\Facades\SEOMeta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class UserController extends Controller
{
    public function index()
    {
        $title = "Wanaopakia Nyimbo Swahili Music Notes";
        $description = "Wafahamu wadau mbalimbali wanaopakia nyimbo";
        SEOMeta::setTitle($title);
        SEOMeta::setDescription($description);

        $users = User::where('active_songs', '>', 0)
            ->orderBy('first_name')
            ->get();

        return view(
            'users.index',
            compact('users', 'title', 'description')
        );
    }

    public function songs(string $url, User $user)
    {
        SEOMeta::setTitle("Nyimbo zilizopakiwa na " . $user->name);
        SEOMeta::setDescription("Mkusanyiko wa nyimbo zilizopakiwa na " . $user->name);

        return view(
            'users.songs',
            compact('user')
        );
    }

    public function verificationForm()
    {
        $user = auth()->user();

        if($user->phone_verified){
            redirect('/');
        } else {
            return view(
                'auth.verify-phone',
                compact('user')
            );
        }

    }

    public function verifyNumber(Request $request)
    {
        $user = auth()->user();
        if($user->phone_verified){
            redirect('/');
        } else {
            if($request->verification_code == $user->verification_code) {
                $user->phone_verified = true;
                $user->save();
                Session::flash('msg', 'Umefanikiwa kujisajili kuhakiki namba yako. Tumeshaku-login. Karibu Swahili Music Notes');
                return redirect('/');
            }

            Session::flash('error', 'Tafadhali hakikisha umeweka namba sahihi tuliyokutumia');
            return redirect(route('verify-number-form'));
        }
    }

    public function getPhoneNumber()
    {
        $user = auth()->user();
        return view(
            'auth.get-phone',
            compact('user')
        );
    }

    public function savePhoneNumber(Request $request)
    {
        $customMessages = [
            'phone.unique' => 'Namba hii ishatumika. Tafadhali login au sajili kutumia namba nyingine',
            'phone.required' => 'Namba ya simu ni lazima ujaze.',
            'phone.phone' => 'Namba ya simu uliyoweka ina kasoro. Tafadhali soma maelezo chini ya box la kuandikia namba.',
        ];

        $this->validate(
            $request,
            [
                'phone' => 'required|phone:AUTO|unique:users,phone,' . auth()->id(),
            ],
            $customMessages
        );

        $code = rand(0001, 9999);

        User::where('id', auth()->user()->id)
            ->update(
                [
                    'phone' => $request->phone,
                    'has_whatsapp' => $request->has_whatsapp,
                    'phone_verified' => false,
                    'verification_code' => $code
                ]
            );

        $smsService = new SmsService();
//        $smsService->sendActivationCode($user, $code);

        Session::flash('msg', 'Umefanikiwa kuweka namba yako. Tafadhali thibitisha namba yako ya simu kwa kuweka namba tuliyokutumia kwenye message.');

        return redirect(route('verify-number-form'));
    }
}
