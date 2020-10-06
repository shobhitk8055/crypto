<?php

namespace App\Http\Controllers;

use App\orders;
use App\Package;
use App\User;
use Illuminate\Http\Request;

class OrderBookController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){

        $openOrdersAll = orders::all()->whereIn('completed','0')->SortBy('price');
        return view('orderbook',[
            'orders'=>$openOrdersAll
        ]);
    }

}
