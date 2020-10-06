<?php

namespace App\Http\Controllers;

use App\orders;
use Illuminate\Http\Request;

class TradeHistoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $completedOrdersAll = orders::all()->whereIn('completed','1')->SortByDesc('created_at');
        return view('tradehistory',[
            'orders'=>$completedOrdersAll
        ]);
    }
}
