<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TeamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    var $users = [];
    public function index(){
        $teamMembers = DB::table('users')
                        ->where('referral_username',auth()->user()->username)
                        ->paginate(10);


        $count = 1;
        return view('team',[
            'teamMembers'=>$teamMembers,
            'count'=>$count
        ]);
    }
    public function directs(){
        $activeMembers = DB::table('users')
                            ->join('profiles','users.id','=','user_id')
                            ->where('referral_username',auth()->user()->username)
                            ->where('activated','=',"1")
                            ->paginate(10);
        $count = 1;
        return view('directs',[
            'activeMembers'=>$activeMembers,
            'count'=>$count
        ]);
    }
    public function getUsers($authUser){
        $count = 0;
        $allUsers = User::all();
        foreach ($allUsers as $user){
            if ($user->referral_username === $authUser->username){
                $count++;
                array_push($this->users, $user);
                if ($count===0){
                return $this->users;
                }
                $this->getUsers($user);
            }
        }
        return $this->users;
    }
    public function levelTeam(){
        $count=1;
        return view('levelTeam',[
            'users'=>$this->getUsers(User::find(auth()->user()->id)),
            'count'=>$count
        ]);
    }
}
