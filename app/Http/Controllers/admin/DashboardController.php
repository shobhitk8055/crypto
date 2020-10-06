<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $usersCount = DB::table('users')->count();
        $usersToday = DB::table('users')->where('created_at',now()->day)->count();
        $approvedWithdrawals = DB::table('withdrawls')->where('approved',"1")->sum('amount');
        $approvedWithdrawalsToday = DB::table('withdrawls')->where('approved',"1")->where('created_at',now()->day)->sum('amount');
        $pendingWithdrawals = DB::table('withdrawls')->where('approved',"0")->sum('amount');
        $pendingWithdrawalsToday = DB::table('withdrawls')->where('approved',"0")->where('created_at',now()->day)->sum('amount');
        $fundTransfer = DB::table('transfers')->sum('amount');

        return view('admin.dashboard',[
            'usersCount'=>$usersCount,
            'usersToday'=>$usersToday,
            'approvedWithdrawals'=>$approvedWithdrawals,
            'approvedWithdrawalsToday'=>$approvedWithdrawalsToday,
            'pendingWithdrawals'=>$pendingWithdrawals,
            'pendingWithdrawalsToday'=>$pendingWithdrawalsToday,
            'fundTransfer'=>$fundTransfer
        ]);
    }
}
