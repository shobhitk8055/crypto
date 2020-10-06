<?php

namespace App\Http\Controllers;

use App\DailyPST;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Package;
use App\User;

class AdminDailyPSTController extends Controller
{
    public function index(){
        $dates = DailyPST::where('date','<=',Carbon::today()->toDateString())->get();
        $dateOptions = DailyPST::where('date','<=',Carbon::today()->toDateString())
            ->where("status","pending")->get();
        return view('admin.daily',[
            'dates'=>$dates,
            "dateOptions"=>$dateOptions
        ]);
    }
    public function update(Request $request){
        $this->updateAll();
        $date = DailyPST::where("date",$request->date)->first();
        $date->update([
            "status"=>$request->status
        ]);
        return redirect(route("admin.dailypst"));
    }
    public function updateAll(){
        $packages = Package::all()->where('activationDate','<',date("Y/m/d"))
                                  ->where('endDate','>',date("Y/m/d"))
                                  ->where('name',"10000 PST");

        if (!($packages->isEmpty())){
            foreach ($packages as $package) {
                $user = User::find($package->user_id);
                $userPST = $user->profile->pst;
                $userPST = $userPST + 90;
                $userIncome = $user->profile->income;
                $userIncome = $userIncome + 100;
                $user->profile->update([
                    "pst" => $userPST,
                    "income" => $userIncome
                ]);
            }
        }
    }
}
