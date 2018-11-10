<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

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
    protected $redirectTo = '/';

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
            'email' => 'required|string|email|max:255|unique:users|confirmed',
            'password' => 'required|string|min:6|confirmed',
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
        
        $customMessages = [
            'first_name.required' => 'Jina la kwanza linahitajika',
            'last_name.required' => 'Jina la pili linahitajika',
            'email.required' => 'Email inahitajika',
            'email.unique' => 'Email hii ishatumika. Tafadhali login',
            'email.confirmed'  => 'Email haifanani na hiyo uliyoandika tena',
            'phone.unique' => 'Namba hii ishatumika. Tafadhali login au sajili kutumia namba nyingine',
            'password.required' => 'Password inahitajika',
            'password.confirmed'  => 'Password haifanani na hiyo uliyoandika tena',
        ];
        
        $this->validate(
            $request,
            [
                'first_name' => 'required|string|max:255',
                'last_name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users|confirmed',
                'phone' => 'required|string|max:255|unique:users',
                'password' => 'required|string|min:6|confirmed',
            ],
            $customMessages
        );
        
        Session::flash('msg', 'Umefanikiwa kujisajili na tumeshaku-login. Karibu Swahili Music Notes');
       
        $user = User::create([
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        
        auth()->login($user);
        return redirect('/akaunti');
    }
}
