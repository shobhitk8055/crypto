<?php

namespace App\Http\Controllers;

use App\Package;
use App\Transfer;
use App\User;

class TopupController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        return view('admin.topup');
    }

    public function update($user,$amount,$dataAmount){

        if(!($user->referral_username == null)) {
            $seniorUser = $this->getUserFromUsername($user->referral_username);
            $seniorPST = $seniorUser->profile->pst;
            $seniorIncome = $seniorUser->profile->income;
            $seniorPST = $seniorPST + $dataAmount * $amount;
            $seniorIncome = $seniorIncome + $dataAmount * $amount;
            $seniorUser->profile->update([
                "pst" => $seniorPST,
                "income" => $seniorIncome
            ]);
            Transfer::create([
                "user_id" => $seniorUser->getAuthIdentifier(),
                "username" => $user->username,
                "amount" => $dataAmount * $amount,
                "type" => "profit",
            ]);
            $coin = $amount * $dataAmount;
            User::find($seniorUser->id)->notifications->update([
                'not1' => "Your account has been credited by ".$coin." PST"
            ]);
            if ($amount === 0.1){
                $seniorDirectPST = $seniorUser->profile->directIncome;
                $seniorDirectPST = $seniorDirectPST + $dataAmount * $amount;
                $seniorUser->profile->update([
                    "directIncome" => $seniorDirectPST,
                ]);
                $seniorUser->save();
            }else{
                $seniorLevelPST = $seniorUser->profile->levelIncome;
                $seniorLevelPST = $seniorLevelPST + $dataAmount * $amount;
                $seniorUser->profile->update(["levelIncome" => $seniorLevelPST]);
                $seniorUser->save();
            }
            return [true, $seniorUser];
        }else{
            return [false];
        }
    }

    public function topup()
    {
        $data = request()->validate([
            'amount'=>'required|not_in:0',
            'username'=>'required',
        ]);

        if(!(User::all()->contains('username',$data['username']))){
            return redirect()->back()->with(['error'=>"Wrong Username"]);
        }

        $user = $this->getUserFromUsername($data['username']);
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
            'username'=>"admin"
        ]);

        Package::create([
            'user_id'=>$user_id,
            'name'=>"10000 PST",
            'activationDate'=> date("Y/m/d"),
            'endDate'=>date('Y-m-d', strtotime(' +210 day'))
        ]);

        $user1 = $this->update($user,0.1,$data['amount']);
        if ($user1[0]){
            $user2 = $this->update($user1[1],0.05, $data['amount']);
            if ($user2[0]){
                $user3 = $this->update($user2[1],0.03, $data['amount']);
                if ($user3[0]){
                    $user4 = $this->update($user3[1],0.02, $data['amount']);
                    if ($user4[0]){
                        $user5 = $this->update($user4[1],0.01, $data['amount']);
                        if ($user5[0]){
                            $user6 = $this->update($user5[1],0.005, $data['amount']);
                            if ($user6[0]){
                                $user7 = $this->update($user6[1],0.005, $data['amount']);
                                if ($user7[0]){
                                    $user8 = $this->update($user7[1],0.005, $data['amount']);
                                    if ($user8[0]){
                                        $user9 = $this->update($user8[1],0.005, $data['amount']);
                                        if ($user9[0]){
                                            $user10 = $this->update($user9[1],0.005, $data['amount']);
                                        }
                                    }
                                }
                            }
                        }
                    }
                }
            }
        }
        return redirect()->route('admin.topup');
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
