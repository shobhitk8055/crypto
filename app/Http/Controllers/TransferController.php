<?php

namespace App\Http\Controllers;

use App\Package;
use App\User;
use App\Transfer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransferController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function show(){
        $transfers =  auth()->user()->transfers()->paginate(10);
        return view('transferfunds',[
            'transfers'=>$transfers
        ]);
    }
    public function store()
    {
        $data = request()->validate([
            'amount'=>'required|not_in:0',
            'username'=>'required',
            'type'=>'required'
        ]);
        $currentMoney = auth()->user()->profile->pst;

        if (strcmp($data['username'], auth()->user()->username) == 0) {
            return redirect()->back()->with(['error'=>"You can't transfer funds to yourself"]);
        }
        if($data['amount']>$currentMoney){
            return redirect()->back()->with(['error'=>"Insufficient balance"]);
        }
        if(!(User::all()->contains('username',$data['username']))){
            return redirect()->back()->with(['error'=>"Wrong Username"]);
        }

        $newMoney = $currentMoney -$data['amount'];

        auth()->user()->profile->update([
            'pst'=>$newMoney
        ]);

        $user = $this->getUserFromUsername(request()->all()['username']);
        $userPST = $user->profile->pst;
        $userPST = $userPST + $data['amount'];
        $userAvailablePst = $user->profile->availablePST + $data['amount'];
        $user_id = $user->getAuthIdentifier();
        User::find($user_id)->profile->update([
            'pst'=>$userPST,
            'availablePST'=>$userAvailablePst
        ]);

        Transfer::create([
            'user_id'=>$user_id,
            'type'=>"received",
            'amount'=>$data['amount'],
            'username'=>auth()->user()->username
        ]);

        auth()->user()->transfers()->create($data);
        $tt =  auth()->user()->transfers()->paginate(10);
        return view('transferfunds',[
            'transfers'=>$tt
        ]);
    }
    public function topup()
    {
        $data = request()->validate([
            'amount'=>'required|not_in:0',
            'username'=>'required',
            'type'=>'required'
        ]);
        $currentMoney = auth()->user()->profile->pst;

        if (strcmp($data['username'], auth()->user()->username) == 0) {
            return redirect()->back()->with(['error'=>"You can't transfer funds to yourself"]);
        }
        if($data['amount']>$currentMoney){
            return redirect()->back()->with(['error'=>"Insufficient balance"]);
        }
        if(!(User::all()->contains('username',$data['username']))){
            return redirect()->back()->with(['error'=>"Wrong Username"]);
        }

        $newMoney = $currentMoney -$data['amount'];

        auth()->user()->profile->update([
            'pst'=>$newMoney
        ]);

        $user = $this->getUserFromUsername(request()->all()['username']);
        $userPST = $user->profile->pst;
        $userPST = $userPST + $data['amount'];
        $user_id = $user->getAuthIdentifier();

        User::find($user_id)->profile->update([
            'activated'=>"1"
        ]);

        User::find($user_id)->notifications->update([
            'not1'=>"Congrats! You are now an active member now! Your account has been credited by 10000 PST"
        ]);


        Transfer::create([
            'user_id'=>$user_id,
            'type'=>"received",
            'amount'=>$data['amount'],
            'username'=>auth()->user()->username
        ]);

        Package::create([
            'user_id'=>$user_id,
            'name'=>"10000 PST",
            'activationDate'=> date("Y/m/d"),
            'endDate'=>date('Y-m-d', strtotime(' +210 day'))
        ]);

        if(!($user->referral_username == null || $user->referral_username == "shobhitkansal")) {
            $seniorUser = $this->getUserFromUsername($user->referral_username);
        $seniorPST = $seniorUser->profile->pst;
        $seniorIncome = $seniorUser->profile->income;
        $seniorPST = $seniorPST + $data['amount']*0.10;
        $seniorIncome = $seniorIncome + $data['amount']*0.10;
        $seniorUser->profile->update(["pst"=>$seniorPST, "income"=>$seniorIncome]);
        Transfer::create([
            "user_id"=>$seniorUser->getAuthIdentifier(),
            "username"=>$user->username,
            "amount"=>$data['amount']*0.10,
            "type"=>"profit",
        ]);

        User::find($seniorUser->id)->notifications->update([
            'not1'=>"You joined a member! Your account has been credited by 1000 PST"
        ]);
            if (!($seniorUser->referral_username == null || $seniorUser->referral_username == "shobhitkansal")) {
                $superSeniorUser = $this->getUserFromUsername($seniorUser->referral_username);
                $superSeniorPST = $superSeniorUser->profile->pst;
                $superSeniorIncome = $superSeniorUser->profile->income;
                $superSeniorPST = $superSeniorPST + $data['amount'] * 0.05;
                $superSeniorIncome = $superSeniorIncome + $data['amount'] * 0.05;
                $superSeniorUser->profile->update(["pst" => $superSeniorPST, "income" => $superSeniorIncome]);
                Transfer::create([
                    "user_id" => $superSeniorUser->getAuthIdentifier(),
                    "username" => $seniorUser->username,
                    "amount" => $data['amount'] * 0.05,
                    "type" => "profit",
                ]);

                User::find($superSeniorUser->id)->notifications->update([
                    'not1' => "Your account has been credited by 500 PST"
                ]);
            }
        }
        auth()->user()->transfers()->create($data);
        $tt =  auth()->user()->transfers()->paginate(10);
        return view('transferfunds',[
            'transfers'=>$tt
        ]);
    }
    public function index(){
        return view('topup');
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
