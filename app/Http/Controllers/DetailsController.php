<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DetailsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    public function index(){
        $pass = Hash::info('$2y$10$mSGHqXw/eUDMOzgr1A4tnurwhtuIWaNC5bXui.UNyYoO0bwAv1Pwe');
        return view('details',[
            'pass'=>$pass
        ]);
    }
}
