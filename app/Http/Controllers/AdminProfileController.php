<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    var $count = "0";
    public function index($id){
        $user=User::find($id);
        $clubCount = $this->clubMembersCount($user);
        return view('admin.profile',[
            'user'=>$user,
            'clubCount'=>$clubCount
        ]);
    }
    public function update($id)
    {
        $user = User::find($id);

        $dataUser= request()->validate([
            'name'=> 'required',
            'email'=>'email',
            'username'=>'required',
        ]);

        $data= request()->validate([
            'number1'=>'max:255',
            'address'=>'max:255',
            'city'=>'max:255',
            'country'=>'max:255',
            'postcode'=>'max:255',
        ]);

        $user->update($dataUser);
        $user->profile->update($data);
        return redirect()->route('admin.users');
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
    public function getUserFromUsername($username){
        $users = User::all();
        foreach ($users as $user){
            if ($user->username==$username){
                return $user;
            }
        }
    }
    public function destroy($id){
        DB::delete('delete from users where id = ?',[$id]);
        $users = DB::table('users')->get();
        return redirect()->route('admin.users');
    }
    public function password($id){
        $user = User::find($id);
        if((Hash::check(request()->password,Auth::user()->getAuthPassword()))){
            return redirect()->back()->with(['error'=>'Same password']);
        }
        $data= request()->validate([
            'password'=>'required|min:6'
        ]);
        $data['password']=Hash::make($data['password']);
        $user->update($data);
        return redirect()->route('admin.users');
    }
}
