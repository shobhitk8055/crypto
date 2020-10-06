<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InvestmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $profiles = DB::table('profiles')->where('activated','1')->get();
        return view('admin.investment',[
            'profiles'=>$profiles
        ]);
    }
}
