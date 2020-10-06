<?php

namespace App\Http\Controllers;

use App\Transfer;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WithdrawController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $accounts = auth()->user()->accounts->all();
        $withdrawls= auth()->user()->withdrawls->all();
        return view('withdraw',[
            'withdrawls'=>$withdrawls,
            'accounts'=>$accounts
        ]);
    }

    public function store(){
        $data = request()->all();
        if ($data['currency']==="pst"){
            $currentMoney = auth()->user()->profile->pst;
            if($data['amount']>$currentMoney){
                return redirect()->back()->with(['error'=>"Insufficient balance"]);
            }
            $new_money = $currentMoney - $data['amount'];
            auth()->user()->profile->update(["pst"=>$new_money]);
        } else{
            $currentMoney = auth()->user()->profile->usdt;
            if($data['amount']>$currentMoney){
                return redirect()->back()->with(['error'=>"Insufficient balance"]);
            }
            $new_money = $currentMoney - $data['amount'];
            auth()->user()->profile->update(["usdt"=>$new_money]);
        }
        auth()->user()->withdrawls()->create($data);
        return redirect()->route('withdraw');
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
