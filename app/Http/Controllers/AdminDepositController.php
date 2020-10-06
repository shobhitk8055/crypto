<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Transfer;
use App\User;
use Illuminate\Http\Request;

class AdminDepositController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function show(){
        $count = 1;
        $deposits = Deposit::all()->where('validated','0');
        return view('admin/pendingDepositRequests',[
            'count'=>$count,
            'deposits'=>$deposits
        ]);
    }
    public function approvedShow(){
        $count = 1;
        $deposits = Deposit::all()->where('validated','1');
        return view('admin/approvedDepositRequest',[
            'count'=>$count,
            'deposits'=>$deposits
        ]);
    }
    public function update(){
        $data = request()->all();
        $deposit = Deposit::find($data['depositID']);
        $user = User::find($data['userID']);

        if ($deposit->currency == "pst"){
            $userPst = $user->profile->pst;
            $userPst = $userPst + $deposit['volume'];
            $userAvailablePst = $user->profile->availablePST + $deposit['volume'];
            $user->profile->update(['pst'=>$userPst,'availablePST'=>$userAvailablePst]);
        }else if($deposit->currency == "usdt"){
            $userUsdt = $user->profile->usdt;
            $userUsdt = $userUsdt + $deposit['volume'];
            $userAvailableUsdt = $user->profile->availableUSDT + $deposit['volume'];
            $user->profile->update(['usdt'=>$userUsdt,'availableUSDT'=>$userAvailableUsdt]);
        }
        Transfer::create([
            'user_id'=>$user->id,
            'type'=>"received",
            'amount'=>$deposit['volume'],
            'username'=>"admin"
        ]);
        $deposit->update(['validated'=>"1"]);

        return redirect()->route('admin.pendingDeposit');

    }
}
