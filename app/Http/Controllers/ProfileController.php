<?php

namespace App\Http\Controllers;
use App\Essential;
use App\Package;
use App\User;
use App\orders;
use App\Profile;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Keygen\Keygen;
use App\Withdrawls;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use \GuzzleHttp\Client;


class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    var $count = 0;
    var $levelIncomeCount = 0;

    public function directIncome(){
        $teamMembers = User::all()->where('referral_username',auth()->user()->username);
        $count = 0;
        foreach ($teamMembers as $teamMember){
            $count = $count + $teamMember->profile->pst;
        }
        return $count;
    }

    public function levelIncome($user){
        $teamMembers = User::all()->where('referral_username',$user->username);
        $teamCount = count($teamMembers);
        if ($teamCount===0){
            return $this->levelIncomeCount;
        }
        foreach ($teamMembers as $teamMember){
            $this->levelIncomeCount = $this->levelIncomeCount + $teamMember->profile->pst;
            $this->levelIncome($teamMember);
        }
    }

    public function clubMembersIncome($user,$clubIncome){
        $teamMembers = $user->team->all();
        $teamCount = count($teamMembers);
        if ($teamCount == 0){
            return $clubIncome;
        }
        foreach ($teamMembers as $teamMember){
            $teamUser = $this->getUserFromUsername($teamMember->member_username);
            $clubIncome = $clubIncome + $teamUser->profile->pst;
            $this->clubMembersCount($teamUser);
        }
        return $clubIncome;
    }

    public function singleLegTeam(){
//        dd(now()->getTimestamp());
        $usersCount = DB::table('users')->whereDate('created_at','<=',now()->getTimestamp())->count();
        return $usersCount;
    }

    public function activeDirects(){
        $teamMembers = User::all()->where('referral_username',auth()->user()->username);
        $count = 0;
        foreach ($teamMembers as $teamMember){
            if ($teamMember->profile->activated === '1'){
                $count++;
            }
        }
        return $count;
    }
    public function activeDirect(){
        $count = 0;
        $authUser = Auth::user();
        $users = User::all();
        foreach ($users as $user){
            if ($user->referral_username === $authUser->username ){
                if ($user->profile->activated === 1){
                    $count++;
                }
            }
        }
        return $count;
    }

    public function clubMembersCount($user){
        $teamMembers = $user->team->all();
        $teamCount = count($teamMembers);
        if ($teamCount == 0){
            return $this->count;
        }
        foreach ($teamMembers as $teamMember){
            $this->count++;
            $teamUser = $this->getUserFromUsername($teamMember->member_username);
            $this->clubMembersCount($teamUser);
        }
        return $this->count;
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

    var $pack = "";
    var $users = [];

    public function dashboard()
    {
        $user = Auth::user();
        $profile= $user->profile;
        $rate = Essential::find(1)->rate;
        $packages = Package::all()->where('user_id',$user->id);
        $withdrawals = auth()->user()->withdrawls->where('approved','0')->sum('amount');
        $transfers = auth()->user()->transfers->sum('amount');
        foreach ($packages as $package){
            $this->pack= $package;
        }
        $todayActives = DB::table('profiles')->where('activated','1')->whereDate('created_at',Carbon::today())->count();
//        $todayActives = Profile::all()->where('activated'==='1')->where('created_at',Carbon::today())->count();
        $userCount = User::all()->count();
        $activeUsers = Profile::all()->where('activated','1')->count();
        $clubCount = $this->clubMembersCount($user);
        $clubIncome = $this->clubMembersIncome($user,$profile->income);
//        $clubIncome = 0;
//        $request = $client->get('http://api.coinlayer.com/api/live?access_key=f09f38ff1dc0580658ce903577f1b7b3&symbols=usdt&target=inr');
//        $usdtRate = json_decode($request->getBody())->rates->USDT;
        return view('dashboard',[
            'user'=>$user,
//            'clubCount'=>$clubCount,
            'userCount'=>$userCount,
            'activeUsers'=>$activeUsers,
            'clubIncome'=>$clubIncome,
            'levelIncome'=>$this->levelIncome($user),
            'directIncome'=>$this->directIncome(),
            'personallyEnrolled' => User::all()->where('referral_username',$user->username)->count(),
            'activeDirects'=>$this->activeDirect(),
            'todayActives'=>$todayActives,
            'singleLegTeam'=>$this->singleLegTeam(),
            'profile'=>$profile,
            'package'=>$this->pack,
            'rate'=>$rate,
            'usdtRate'=>"75.6",
            'withdrawals'=>$withdrawals,
            'transfers'=>$transfers,
            'levelTeamCount'=>count($this->getUsers(Auth::user())),
        ]);
    }
    public function show()
    {
        $user = Auth::user();
        $profile= $user->profile;
        $clubCount = $this->clubMembersCount($user);
        $user=Auth::user();
        return view('profile',[
            'user'=> $user,
            'profile'=>$profile,
            'clubCount'=>$clubCount
        ]);
    }
    public function update()
    {

        $use=Auth::user();
        $user = User::find($use->id);

        $dataUser= request()->validate([
            'name'=> 'required',
            'email'=>'email',
            'username'=>'required',
            ]);

            $data= request()->validate([
            'number1'=>'max:255',
            'number2'=>'max:255',
            'address'=>'max:255',
            'city'=>'max:255',
            'country'=>'max:255',
            'postcode'=>'max:255',
            'description'=>'required',
            ]);
        $user->update($dataUser);
        $user->profile->update($data);
        return redirect()->route('profile');
    }

    public function create(){
        $data = request()->all();
        Profile::create($data);
        return redirect()->route('dashboard');
    }
    public function getUserFromUsername($username){
        $users = User::all();
        foreach ($users as $user){
            if ($user->username==$username){
                return $user;
            }
        }
    }
    public function profile($user_id){
        $user = User::find($user_id);
        foreach ($user->accounts as $accounts){
            $bank = $accounts;
        }
        return view('userProfile',[
           'user'=>$user,
            'bank'=>$bank
        ]);
    }
}
