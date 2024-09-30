<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Services\SmsService;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Propaganistas\LaravelPhone\PhoneNumber;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/verify-number';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'sometimes|nullable|email|max:255|unique:users|confirmed',
            'password' => 'required|string|min:6|confirmed',
            'phone' => 'required','string', 'max:255', 'unique:users',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @return \App\Model\User
     */
    protected function create()
    {
        $request = request();
        $sendMessage = true;

        $customMessages = [
            'first_name.required' => 'Jina la kwanza linahitajika',
            'last_name.required' => 'Jina la pili linahitajika',
            'email.unique' => 'Email hii ishatumika. Tafadhali login',
            'email.confirmed'  => 'Email haifanani na hiyo uliyoandika tena',
            'phone.unique' => 'Namba hii ishatumika. Tafadhali login au sajili kutumia namba nyingine',
            'phone.required' => 'Namba ya simu ni lazima ujaze.',
            'phone.phone' => 'Namba ya simu uliyoweka ina kasoro. Tafadhali soma maelezo hapo chini.',
            'password.required' => 'Password inahitajika',
            'password.confirmed'  => 'Password haifanani na hiyo uliyoandika tena',
        ];

        $this->validate(
            $request,
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'sometimes|nullable|email|max:255|unique:users|confirmed',
                'phone' => 'required|string|max:255|unique:users|phone:AUTO',
                'phone_country' => 'required',
                'password' => 'required|string|min:6|confirmed',
            ],
            $customMessages
        );

        Session::flash('msg', 'Umefanikiwa kujisajili. Tafadhali thibitisha namba yako ya simu kwa kuweka namba tuliyokutumia kwenye message.');

        $code = rand(0001, 9999);
        $phone = (new PhoneNumber
        (
            $request->phone,
            [
                $request->phone_country
            ]
        ))->formatE164();

        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $phone,
            'has_whatsapp' => $request->has_whatsapp,
            'phone_verified' => $sendMessage ? false : true,
            'verification_code' => $code,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'auto_verified' => $sendMessage ? false : true,
        ]);

        if($request->has_whatsapp) {
            $smsService = new SmsService();
            $smsService->sendActivationCode($user, $code);
        } else {
            Session::flash('msg', 'Umefanikiwa kujisajili. Endelea kutumia Swahili Music Notes');
            $this->redirectTo = "/";
        }

        return $user;
    }
}
