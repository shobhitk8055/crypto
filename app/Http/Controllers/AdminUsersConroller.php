<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminUsersConroller extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $users = User::all();
        return view('admin.users_admin',[
            'users'=>$users
        ]);
    }
    public function search(Request $request){
        $search = $request->get('search');
        $users = DB::table('users')->where('username','like','%'.$search.'%')->paginate(5);
        return view('admin.users_admin',[
            'users'=>$users
        ]);
    }

    public function update($id){
        $users = User::all();
        return view('admin.users_admin',[
            "users"=>$users
        ]);
    }
}
