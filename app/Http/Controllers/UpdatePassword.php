<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UpdatePassword extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function update(){
        $use=Auth::user();
        $user = User::find($use->id);
        if((Hash::check(request()->password,Auth::user()->getAuthPassword()))){
            return redirect()->back()->with(['error'=>'Same password']);
        }
        $data= request()->validate([
            'password'=>'required|min:6'
        ]);
        $data['password']=Hash::make($data['password']);
        $user->update($data);
        return redirect()->route('profile');
    }
}
