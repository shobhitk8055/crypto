<?php

namespace App\Http\Controllers;
use App\Fund;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FundsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show(){

//        $id = auth()->user()->getAuthIdentifier();
//        $funds = DB::table('funds')->whereIn('user_id',$id)->SortByDesc('created_at')->paginate(10);
           $funds =  auth()->user()->funds()->paginate(10);
        return view('add-funds'
            ,[
            'funds'=>$funds
        ]
        );
    }
    public function store(){
        $data = request()->validate([
            'amount'=>'required|not_in:0',
            'tid'=>'required',
            'validated'=>'required'
        ]);
        $currentMoney= auth()->user()->profile->inr;
        $newMoney = $currentMoney + $data['amount'];
        $data['new_money']=$newMoney;
        auth()->user()->funds()->create($data);
        return redirect()->route('dashboard');
    }
}
