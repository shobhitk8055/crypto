<?php

namespace App\Http\Controllers;

use App\Accounts;
use Illuminate\Http\Request;

class AccountsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $accounts = auth()->user()->accounts->all();
        return view('add_account',[
            'accounts'=>$accounts
        ]);
    }
    public function store(){
//        dd(request()->all());
        $data = request()->validate([
            'user_id'=>'required',
            'bank_name'=>'required',
            'account_holder_name'=>'required',
            'account_number'=>'required',
            'ifsc'=>'required',
            'bank_account_type'=>'required',
            'bank_branch'=>'required',
            'primary'=>'required'
        ]);
        Accounts::create($data);
        return redirect()->route('add_accounts');
    }
}
