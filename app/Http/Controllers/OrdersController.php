<?php

namespace App\Http\Controllers;

use App\Essential;
use App\orders;
use App\P2porder;
use App\Transfer;
use App\User;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function transfer($id,$type,$amount,$username){
        Transfer::create([
            'user_id'=>$id,
            'type'=>$type,
            'amount'=>$amount,
            'username'=>$username
        ]);
    }

    public function store(){
        $data = request()->validate([
            'price' => 'required',
            'type'=>'required',
            'completed'=>'required',
            'amount' => 'required',
            'total' => 'required',
            'initialAmount'=>'required'
        ]);
        $data['price'] = 0 + $data['price'];
        auth()->user()->profile->update(['availableUSDT'=>auth()->user()->profile->availableUSDT - $data['total']]);
        $buyOrder = auth()->user()->orders()->create($data);
        $orders = orders::all()->where('completed','0')->where('type','=',"Sell")->where('price','<=',$data['price'])->where('user_id','!=',auth()->user()->id);
        if($orders->isEmpty()){
            return redirect()->route('trading');
        }
        $orders = orders::all()->where('completed','0')->where('type','=',"Sell")->where('price','<',$data['price'])->sortByDesc('price')->where('user_id','!=',auth()->user()->id);
        if(!($orders->isEmpty())){
            foreach ($orders as $order) {
                $this->setLiveRate($order->price);
                $seller = User::find($order->user_id);
                if ($order->amount == $data['amount']) {
                    $this->depositPSTIntoUser(auth()->user(), $order->amount, $order->total);
                    auth()->user()->transfers()->create([
                        'type'=>"received",
                        'amount'=>$order->amount,
                        'username'=>$order->user->username
                    ]);
                    $this->depositUSDTIntoUser($seller, $order->amount, $order->total);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"sent",
                        'amount'=>$order->amount,
                        'username'=>auth()->user()->username
                    ]);
                    $order->update(['amount' => "0", 'completed' => "1"]);
                    $data['total']=$data['total']-$order->total;
                    if ($data['total']==0){
                    $buyOrder->update(['amount' => "0", 'completed' => "1"]);
                    return redirect()->route('trading');
                    }
                    $buyOrder->update(['amount' => $data['total']*$data['price'], 'total'=>$data['total']]);

                } elseif ($order->amount > $data['amount']) {
                    $sellUsdt = $order->total/$order->amount*$data['amount'];

                    $this->depositPSTIntoUser(auth()->user(), $data['amount'], $sellUsdt);
                    auth()->user()->transfers()->create([
                        'type'=>"received",
                        'amount'=>$data['amount'],
                        'username'=>$order->user->username
                    ]);
                    $this->depositUSDTIntoUser($seller, $data['amount'], $sellUsdt);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"sent",
                        'amount'=>$data['amount'],
                        'username'=>auth()->user()->username
                    ]);
                    $buyOrder->update(['amount' => "0", 'completed' => "1"]);
                    $data['amount'] = $order->amount - $data['amount'];
                    $order->update(['amount' => $data['amount'],'total'=>$order['total']-$sellUsdt]);
                    return redirect()->route('trading');
                } elseif ($order->amount < $data['amount']) {
                    $this->depositPSTIntoUser(auth()->user(), $order->amount, $order->total);
                    auth()->user()->transfers()->create([
                        'type'=>"received",
                        'amount'=>$order->amount,
                        'username'=>$order->user->username
                    ]);
                    $this->depositUSDTIntoUser($seller, $order->amount, $order->total);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"sent",
                        'amount'=>$order->amount,
                        'username'=>auth()->user()->username
                    ]);
                    $rate= $data['total']/$data['amount'];
                    $data['amount'] = $data['amount'] - $order->amount;
                    $data['total'] = $rate*$data['amount'];
                    $buyOrder->update(['amount' => $data['amount'],'total'=>$data['total']]);
                    $order->update(['amount' => "0", 'total'=>'0','completed' => "1"]);
                }
            }
        }
        $orders = orders::all()->where('completed','0')->where('type','=',"Sell")->where('price','=',$data['price'])->where('user_id','!=',auth()->user()->id);
        if(!($orders->isEmpty())) {
            foreach ($orders as $order) {
                $this->setLiveRate($order->price);
                $seller = User::find($order->user_id);
                if ($order->amount == $data['amount']) {
                    $this->depositPSTIntoUser(auth()->user(), $order->amount, $order->total);
                    auth()->user()->transfers()->create([
                        'type'=>"received",
                        'amount'=>$order->amount,
                        'username'=>$order->user->username
                    ]);
                    $this->depositUSDTIntoUser($seller, $order->amount, $order->total);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"sent",
                        'amount'=>$order->amount,
                        'username'=>auth()->user()->username
                    ]);
                    $buyOrder->update(['amount' => "0", 'completed' => "1"]);
                    $order->update(['amount' => "0", 'completed' => "1"]);
                    return redirect()->route('trading');
                } elseif ($order->amount > $data['amount']) {
                    $this->depositPSTIntoUser(auth()->user(), $data['amount'], $data['total']);
                    auth()->user()->transfers()->create([
                        'type'=>"received",
                        'amount'=>$data['amount'],
                        'username'=>$order->user->username
                    ]);
                    $this->depositUSDTIntoUser($seller, $data['amount'], $data['total']);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"sent",
                        'amount'=>$data['amount'],
                        'username'=>auth()->user()->username
                    ]);
                    $buyOrder->update(['amount' => "0", 'completed' => "1"]);
                    $data['amount'] = $order->amount - $data['amount'];
                    $order->update(['amount' => $data['amount']]);
                    return redirect()->route('trading');
                } elseif ($order->amount < $data['amount']) {
                    $this->depositPSTIntoUser(auth()->user(), $order->amount, $order->total);
                    auth()->user()->transfers()->create([
                        'type'=>"received",
                        'amount'=>$order->amount,
                        'username'=>$order->user->username
                    ]);
                    $this->depositUSDTIntoUser($seller, $order->amount, $order->total);

                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"sent",
                        'amount'=>$order->amount,
                        'username'=>auth()->user->username
                    ]);
                    $data['amount'] = $data['amount'] - $order->amount;
                    $buyOrder->update(['amount' => $data['amount']]);
                    $order->update(['amount' => "0", 'completed' => "1"]);
                }
            }
        }
        return redirect()->route('trading');
    }

    public function sell() {
        $data = request()->validate([
            'price' => 'required',
            'type'=>'required',
            'completed'=>'required',
            'amount' => 'required',
            'total' => 'required',
            'initialAmount'=>'required'
        ]);
        $data['price'] = 0 + $data['price'];
        auth()->user()->profile->update(['availablePST'=>auth()->user()->profile->availablePST - $data['amount']]);
        $sellOrder = auth()->user()->orders()->create($data);
        $orders = orders::all()->where('completed','0')->where('type','=',"Buy")->where('price','>=',$data['price'])->where('user_id','!=',auth()->user()->id);
        if($orders->isEmpty()){
            return redirect()->route('trading');
        }
        $orders = orders::all()->where('completed','0')->where('type','=',"Buy")->where('price','>',$data['price'])->sortBy('price')->where('user_id','!=',auth()->user()->id);
        if(!($orders->isEmpty())){
            foreach ($orders as $order) {
                $this->setLiveRate($order->price);
                $buyer = User::find($order->user_id);
                if ($order->amount == $data['amount']) {
                    $this->depositPSTIntoUser($buyer, $order->amount, $order->total);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"received",
                        'amount'=>$order->amount,
                        'username'=>auth()->user()->username
                    ]);
                    $this->depositUSDTIntoUser(auth()->user(), $order->amount, $order->total);
                    auth()->user()->transfers()->create([
                        'type'=>"sent",
                        'amount'=>$order->amount,
                        'username'=>$order->user->username
                    ]);
                    $sellOrder->update(['amount' => "0", 'completed' => "1"]);
                    $order->update(['amount' => "0", 'completed' => "1"]);
                    return redirect()->route('trading');
                } elseif ($order->amount > $data['amount']) {
                    $sellUsdt = $order->total/$order->amount*$data['amount'];
                    $this->depositPSTIntoUser($buyer, $data['amount'], $sellUsdt);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"received",
                        'amount'=>$data['amount'],
                        'username'=>auth()->user()->username
                    ]);
                    $this->depositUSDTIntoUser(auth()->user(), $data['amount'], $sellUsdt);
                    auth()->user()->transfers()->create([
                        'type'=>"sent",
                        'amount'=>$data['amount'],
                        'username'=>$order->user->username
                    ]);
                    $sellOrder->update(['amount' => "0", 'completed' => "1"]);
                    $data['amount'] = $order->amount - $data['amount'];
                    $order->update(['amount' => $data['amount'],'total'=>$order['total']-$sellUsdt]);
                    return redirect()->route('trading');
                } elseif ($order->amount < $data['amount']) {
                    $this->depositPSTIntoUser($buyer, $order->amount, $order->total);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"received",
                        'amount'=>$order->amount,
                        'username'=>auth()->user()->username
                    ]);
                    $this->depositUSDTIntoUser(auth()->user(), $order->amount, $order->total);
                    auth()->user()->transfers()->create([
                        'type'=>"sent",
                        'amount'=>$order->amount,
                        'username'=>$order->user->username
                    ]);
                    $rate = $data['total']/$data['amount'];
                    $data['amount'] = $data['amount'] - $order->amount;
                    $data['total'] = $rate*$data['amount'];
                    $sellOrder->update(['amount' => $data['amount'],'total'=>$data['total']]);
                    $order->update(['amount' => "0", 'total'=>'0','completed' => "1"]);
                }
            }
        }
        $orders = orders::all()->where('completed','0')->where('type','=',"Buy")->where('price','=',$data['price'])->where('user_id','!=',auth()->user()->id);
        if(!($orders->isEmpty())) {
            foreach ($orders as $order) {
                $this->setLiveRate($order->price);
                $buyer = User::find($order->user_id);
                if ($order->amount == $data['amount']) {
                    $this->depositPSTIntoUser($buyer, $order->amount, $order->total);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"received",
                        'amount'=>$order->amount,
                        'username'=>auth()->user()->username
                    ]);
                    $this->depositUSDTIntoUser(auth()->user(), $order->amount, $order->total);
                    auth()->user()->transfers()->create([
                        'type'=>"sent",
                        'amount'=>$order->amount,
                        'username'=>$order->user->username
                    ]);
                    $sellOrder->update(['amount' => "0", 'completed' => "1"]);
                    $order->update(['amount' => "0", 'completed' => "1"]);
                    return redirect()->route('trading');
                } elseif ($order->amount > $data['amount']) {
                    $this->depositPSTIntoUser($buyer, $data['amount'], $data['total']);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"received",
                        'amount'=>$data['amount'],
                        'username'=>auth()->user()->username
                    ]);
                    $this->depositUSDTIntoUser(auth()->user(), $data['amount'], $data['total']);
                    auth()->user()->transfers()->create([
                        'type'=>"sent",
                        'amount'=>$data['amount'],
                        'username'=>$order->user->username
                    ]);
                    $sellOrder->update(['amount' => "0", 'completed' => "1"]);
                    $data['amount'] = $order->amount - $data['amount'];
                    $order->update(['amount' => $data['amount']]);
                    return redirect()->route('trading');
                } elseif ($order->amount < $data['amount']) {
                    $this->depositPSTIntoUser($buyer, $order->amount, $order->total);
                    Transfer::create([
                        'user_id'=>$order->user_id,
                        'type'=>"received",
                        'amount'=>$order->amount,
                        'username'=>auth()->user()->username
                    ]);
                    $this->depositUSDTIntoUser(auth()->user(), $order->amount, $order->total);
                    auth()->user()->transfers()->create([
                        'type'=>"sent",
                        'amount'=>$order->amount,
                        'username'=>$order->user->username
                    ]);
                    $data['amount'] = $data['amount'] - $order->amount;
                    $sellOrder->update(['amount' => $data['amount']]);
                    $order->update(['amount' => "0", 'completed' => "1"]);
                }
            }
        }
        return redirect()->route('trading');
    }

    public function depositPSTIntoUser($user, $pst, $usdt){
        $userPST = $user->profile->pst;
        $userPST = $userPST + $pst;
        $userAvailablePST = $user->profile->availablePST + $pst;
        $userUSDT = $user->profile->usdt;
        $userUSDT = $userUSDT - $usdt;
        $user->profile->update([
            'pst'=>$userPST,
            'usdt'=>$userUSDT,
            'availablePST'=>$userAvailablePST
        ]);
        $this->cutUsdt(auth()->user(),$usdt*0.0005);
    }

    public function depositUSDTIntoUser($user,$pst,$usdt){
        $userPST = $user->profile->pst;
        $userPST = $userPST - $pst;
        $userUSDT = $user->profile->usdt;
        $userUSDT = $userUSDT + $usdt;
        $userAvailableUSDT = $user->profile->availableUSDT + $usdt;
        $user->profile->update([
            'pst'=>$userPST,
            'usdt'=>$userUSDT,
            'availableUSDT'=>$userAvailableUSDT
        ]);
        $this->cutPst(auth()->user(),$pst*0.0005);
    }

    public function update(){
        $data = request()->all();
        $order= auth()->user()->orders->find($data['order_id']);
        if ($order->type=="Buy"){
            $amount = auth()->user()->profile->availableUSDT + ($order->price * $order->amount);
            auth()->user()->profile->update(['availableUSDT'=> $amount]);
        }
        if ($order->type=="Sell"){
            $amount = auth()->user()->profile->availablePST +  $order->amount;
            auth()->user()->profile->update(['availablePST'=> $amount]);
        }
        $order->update([
            'completed' => '1',
        ]);
        return redirect()->route('trading');
    }

    public function setLiveRate($rate){
        Essential::find(1)->update(['rate'=>$rate]);
    }

    public function ordersCompleter($id){
        $order = P2porder::find($id);
        if ($order->type=== "Buy" ){
            if ($order->currency==="pst"){
                $amount = auth()->user()->profile->availablePST + $order->amount;
                auth()->user()->profile->update(['availablePST'=>$amount]);
            }
            else{
                $amount = auth()->user()->profile->availableUSDT + $order->amount;
                auth()->user()->profile->update(['availableUSDT'=>$amount]);
            }
        }

        $order->update(['completed'=>'1']);
        return redirect()->route('p2p');

    }

    public function cutPst($user,$amount){
        $pst = $user->profile->pst;
        $availablePST = $user->profile->availablePST;
        User::find($user->id)->profile->update(['pst' => $pst-$amount,'availablePST'=>$availablePST-$amount ]);
    }

    public function cutUsdt($user,$amount){
        $usdt = $user->profile->usdt;
        $availableUSDT = $user->profile->availableUSDT;
        User::find($user->id)->profile->update(['usdt' => $usdt-$amount,'availableUSDT'=>$availableUSDT-$amount ]);
    }
}





































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































































