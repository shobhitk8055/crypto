<?php


namespace App\Console\Commands;

use App\Package;
use App\User;
use Illuminate\Console\Command;

//$packages = Package::all()->where('activationDate','<',date("Y/m/d"))
//    ->where('endDate','>',date("Y/m/d"))->where('name',"10000 PST");
//if (!($packages->isEmpty())){
//    foreach ($packages as $package) {
//        $user = User::find($package->user_id);
//        $userPST = $user->profile->pst;
//        $userPST = $userPST + 90;
//        $user->profile->update(["pst" => $userPST]);
//    }
//}
?>
