<?php

namespace App\Http\Controllers;

use App\Essential;
use App\orders;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TradingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        $rate = Essential::find(1)->rate;
        $user = Auth::user();

        $openBuyOrdersAll = orders::all()->whereIn('completed','0')
                                         ->where('type','=',"Buy")
                                         ->SortByDesc('price');

        $openSellOrdersAll = orders::all()->whereIn('completed','0')
                                          ->where('type','=',"Sell")
                                          ->SortBy('price')->take(9);

        $completedOrdersAll = orders::all()->whereIn('completed','1')->SortByDesc('created_at')->take(9);
        $openOrders = auth()->user()->orders->whereIn('completed','0')->SortByDesc('created_at')->take(10);
        $completedOrders = auth()->user()->orders->whereIn('completed','1')->SortByDesc('created_at')->take(10);

        return view('trading',[
            'openBuyOrdersAll' => $this->getUniqueOrders($openBuyOrdersAll),
            'openSellOrdersAll' => $this->getUniqueOrders($openSellOrdersAll),
            'orders'=>$completedOrdersAll,
            'openOrders'=>$openOrders,
            'completedOrders'=>$completedOrders,
            'user'=>$user,
            'rate'=>$rate,
            'usdtRate'=>"75.6",

        ]);
    }
    public function getUniqueOrders($orders){
        $buyOrders =array();

        foreach ($orders as $order){
            $o = $orders->where('price', $order->price );
            if (count($o)===1){
                foreach ($o as $oa) {
                    array_push($buyOrders, array("price"=>$oa->price,"amount"=> $oa->amount));
                }
            }
            else{
                $sum = $o->sum('amount');
                $ar = reset($o);
                array_push($buyOrders, array("price"=>reset($ar)->price,"amount"=> $sum));
            }
        }
        return array_slice(array_unique($buyOrders,SORT_REGULAR),0,10);
    }
}
