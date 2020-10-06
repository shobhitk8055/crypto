<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MyOrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $openOrders = auth()->user()->orders->whereIn('completed','0')->SortByDesc('created_at');
        $completedOrders = auth()->user()->orders->whereIn('completed','1')->SortByDesc('created_at');
        return view('myorders',[
            'openOrders'=>$openOrders,
            'completedOrders'=>$completedOrders,
        ]);
    }
}
