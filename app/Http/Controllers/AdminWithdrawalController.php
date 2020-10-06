<?php

namespace App\Http\Controllers;

use App\Withdrawls;
use Illuminate\Http\Request;

class AdminWithdrawalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $entries= Withdrawls::all()->where('approved','1');
        return view('admin.approved_withdrawals',[
            'entries'=>$entries
        ]);
    }
    public function show(){
        $entries= Withdrawls::all()->where('approved','0');
        return view('admin.pending_withdrawals',[
            'entries'=>$entries
        ]);
    }
    public function update($id){
        Withdrawls::find($id)->update(['approved'=>"1"]);
        return redirect()->route('approvedWithdrawal');
    }
}
