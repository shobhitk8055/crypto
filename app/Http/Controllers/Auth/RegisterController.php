<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Team;
use App\Wallet;
use Keygen\Keygen;
use App\User;
use App\Notifications;
use App\Profile;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends Controller
{
    var $password = '';
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
     * @return string
     * @var string
     */
//    protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {

        $id = auth()->user()->id;

        Profile::create([
            "user_id"=>$id,
            "description"=>"Welcome to Cryptovests!",
            "pst"=>"0",
            "income"=>"0",
            'usdt'=>'0',
            "number1"=>"+91999999999",
            "activated"=>"0",
            "availablePST"=>"0",
            "availableUSDT"=>"0"
        ]);

        Wallet::create([
            'user_id'=>$id,
            'fundsWallet'=>'0',
            'address'=>"0x".Keygen::alphanum(40)->generate(),
        ]);

        Notifications::create([
            "user_id"=>$id,
            "not1"=>"You are not a active member yet! Activate your account",
            "not2"=>$this->password
        ]);

       return RouteServiceProvider::SHOME;

    }
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'username' => ['string', 'max:255', 'unique:users'],
//            'referral_username' => ['string', 'max:255','exists:users,username'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        $this->password = $data['password'];
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'username' => "CV".Keygen::numeric(8)->generate(),
            'referral_username' => strtoupper($data['referral_username']),
            'password' => Hash::make($data['password']),
        ]);
    }
}
