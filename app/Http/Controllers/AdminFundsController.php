<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminFundsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        return view('admin/addFunds');
    }

    public function pstUpdate(){
        $data = request()->all();
        $user = $this->getUserFromUsername($data['username']);
        $userPST = $user->profile->pst;
        $userPST = $userPST + $data['amount'];
        $userAvailablePst = $user->profile->availablePST + $data['amount'];
        $user->profile->update(['pst'=>$userPST,'availablePST'=>$userAvailablePst]);
        return redirect()->route('admin.funds');
    }

    public function usdtUpdate(){
        $data = request()->all();
        $user = $this->getUserFromUsername($data['username']);
        $userUSDT = $user->profile->usdt;
        $userUSDT = $userUSDT + $data['amount'];
        $userAvailableUsdt = $user->profile->availableUSDT + $data['amount'];
        $user->profile->update(['usdt'=>$userUSDT,'availableUSDT'=>$userAvailableUsdt]);
        return redirect()->route('admin.funds');
    }

    public function getUserFromUsername($username){
        $users = User::all();
        foreach ($users as $user){
            if ($user->username==$username){
                return $user;
            }
        }
    }
}
