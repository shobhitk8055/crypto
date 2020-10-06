<?php

namespace App\Http\Controllers;

use App\Accounts;
use App\P2porder;
use App\P2ptransaction;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;


class P2PController extends Controller
{

    public function show(){
        $accounts = auth()->user()->accounts->all();
        $buyPstOrders = P2porder::all()->where('type','=','Sell')->where('currency','=','pst')->sortByDesc('created_at')->where('completed','=','0');
        $sellPstOrders = P2porder::all()->where('type','=','Buy')->where('currency','=','pst')->sortByDesc('created_at')->where('completed','=','0');
        $buyUsdtOrders = P2porder::all()->where('type','=','Sell')->where('currency','=','usdt')->sortByDesc('created_at')->where('completed','=','0');
        $sellUsdtOrders = P2porder::all()->where('type','=','Buy')->where('currency','=','usdt')->sortByDesc('created_at')->where('completed','=','0');
        return view('p2p',[
            'buyPstOrders'=>$buyPstOrders,
            'buyUsdtOrders'=>$buyUsdtOrders,
            'sellPstOrders'=>$sellPstOrders,
            'sellUsdtOrders'=>$sellUsdtOrders,
            'accounts'=>$accounts,
        ]);
    }

    public function showCreateForm(){
        $accounts = auth()->user()->accounts->all();
        return view('placeP2P',[
            'accounts'=>$accounts,
        ]);
    }

    public function create(Request $request){
        $data = $request->all();
        $amount = $data['amount'];
        $p2porder = auth()->user()->p2porders()->create($data);
        if ($data['type']==="Sell"){
            $orders = P2porder::all()->where('completed','=','0')
                                     ->where('currency','=',$data['currency'])
                                     ->where('type','=','Buy')
                                     ->where('user_id','!=',auth()->user()->id)
                                     ->where('price','<=',$data['price'])
                                     ->sortBy('price');

            if ($orders->isEmpty()){
                return redirect()->route('p2p');
            }
            foreach ($orders as $order){
                if ($amount > $order->amount){
                    $tnx1 = P2ptransaction::create([
                        'user_id'=>auth()->user()->id,
                        'order_id'=>$order->id,
                        'receiver_user_id'=>$order->user_id,
                        'sendCurrency'=>'inr',
                        'receiveCurrency'=>$data['currency'],
                        'sendAmount'=>$order['payableAmount'],
                        'receiveAmount'=>$order['amount'],
                        'sent'=>'0',
                        'crossTnx_id'=>'',
                        'received'=>'0',
                        'tid'=>'XX',
                    ]);

                    $tnx2 = P2ptransaction::create([
                        'user_id'=>$order->user_id,
                        'order_id'=>$order->id,
                        'receiver_user_id'=>auth()->user()->id,
                        'sendCurrency'=>$data['currency'],
                        'receiveCurrency'=>'inr',
                        'sendAmount'=>$order['amount'],
                        'receiveAmount'=>$order['payableAmount'],
                        'sent'=>'0',
                        'crossTnx_id'=>'',
                        'received'=>'0',
                        'tid'=>'XX',
                    ]);

                    $tnx1->update(['crossTnx_id'=>$tnx2->id]);
                    $tnx2->update(['crossTnx_id'=>$tnx1->id]);
                    $amount=$amount-$order->amount;
                } else {
                    $tnx1 = P2ptransaction::create([
                        'user_id' => auth()->user()->id,
                        'order_id' => $order->id,
                        'receiver_user_id' => $order->user_id,
                        'sendCurrency' => 'inr',
                        'receiveCurrency' => $data['currency'],
                        'sendAmount' => $order['price'] * $amount,
                        'receiveAmount' => $amount,
                        'sent' => '0',
                        'crossTnx_id'=>'',
                        'received' => '0',
                        'tid' => 'XX',
                    ]);
                    $tnx2 = P2ptransaction::create([
                        'user_id' => $order->user_id,
                        'order_id' => $order->id,
                        'receiver_user_id' => auth()->user()->id,
                        'sendCurrency' => $data['currency'],
                        'receiveCurrency' => 'inr',
                        'sendAmount' => $amount,
                        'receiveAmount' => $order['price'] * $amount,
                        'sent' => '0',
                        'crossTnx_id'=>'',
                        'received' => '0',
                        'tid' => 'XX',
                    ]);
                    $tnx1->update(['crossTnx_id'=>$tnx2->id]);
                    $tnx2->update(['crossTnx_id'=>$tnx1->id]);
                    return redirect()->route('p2p.transactions');
                }
            }
        }

        if ($data['type']==="Buy"){
            if ($data['amount']==="pst"){
                $availableAmount = auth()->user()->profile->availablePST - $data['amount'];
            }
            else{
                $availableAmount = auth()->user()->profile->availableUSDT - $data['amount'];
            }
            auth()->user()->profile->update(['availablePST'=>$availableAmount]);

            $orders = P2porder::all()->where('completed','=','0')
                                     ->where('currency','=',$data['currency'])
                                     ->where('type','=','Sell')
                                     ->where('user_id','!=', auth()->user()->id)
                                     ->where('price','>=', $data['price'])
                                     ->sortByDesc('price');

            if ($orders->isEmpty()){
                return redirect()->route('p2p');
            }

            foreach ($orders as $order) {
                if ($amount > $order->amount){
                    $tnx1 = P2ptransaction::create([
                        'user_id'=>auth()->user()->id,
                        'order_id'=>$p2porder->id,
                        'receiver_user_id'=>$order->user_id,
                        'sendCurrency'=>$data['currency'],
                        'receiveCurrency'=>'inr',
                        'sendAmount'=>$order['amount'],
                        'receiveAmount'=>$order['payableAmount'],
                        'sent'=>'0',
                        'crossTnx_id'=>'',
                        'received'=>'0',
                        'tid'=>'XX',
                    ]);
                    $tnx2 = P2ptransaction::create([
                        'user_id'=>$order->user_id,
                        'order_id'=>$order->id,
                        'receiver_user_id'=>auth()->user()->id,
                        'sendCurrency'=>'inr',
                        'receiveCurrency'=>$data['currency'],
                        'sendAmount'=>$order['payableAmount'],
                        'receiveAmount'=>$order['amount'],
                        'sent'=>'0',
                        'crossTnx_id'=>'',
                        'received'=>'0',
                        'tid'=>'XX',
                    ]);
                    $tnx1->update(['crossTnx_id'=>$tnx2->id]);
                    $tnx2->update(['crossTnx_id'=>$tnx1->id]);
                    $amount=$amount-$order->amount;
                } else {
                    $tnx1 = P2ptransaction::create([
                        'user_id' => auth()->user()->id,
                        'order_id' => $p2porder->id,
                        'receiver_user_id' => $order->user_id,
                        'sendCurrency' => $data['currency'],
                        'receiveCurrency' => 'inr',
                        'sendAmount' => $amount,
                        'receiveAmount' => $order['price'] * $amount,
                        'sent' => '0',
                        'crossTnx_id'=>'',
                        'received' => '0',
                        'tid' => 'XX',
                    ]);
                    $tnx2 = P2ptransaction::create([
                        'user_id' => $order->user_id,
                        'order_id' => $order->id,
                        'receiver_user_id' => auth()->user()->id,
                        'sendCurrency' => 'inr',
                        'receiveCurrency' => $data['currency'],
                        'sendAmount' => $order['price'] * $amount,
                        'receiveAmount' => $amount,
                        'sent' => '0',
                        'crossTnx_id'=>'',
                        'received' => '0',
                        'tid' => 'XX',
                    ]);
                    $tnx1->update(['crossTnx_id'=>$tnx2->id]);
                    $tnx2->update(['crossTnx_id'=>$tnx1->id]);
                    return redirect()->route('p2p.transactions');
                }
            }
        }
        return redirect()->route('p2p.transactions');
    }

    public function showOrder($order_id){
        $order = P2porder::find($order_id);
        $user = User::find($order->user_id);
        $bank = Accounts::find($order->bank_id);
        return view('p2porder',[
            'order'=>$order,
            'user'=>$user,
            'bank'=>$bank
        ]);
    }

    public function store(){
        $data = request()->all();
        auth()->user()->p2ptransactions()->create($data);
        P2ptransaction::create([
            'user_id'=>$data['receiver_user_id'],
            'order_id'=>$data['order_id'],
            'receiver_user_id'=>auth()->user()->id,
            'sendAmount'=>$data['receiveAmount'],
            'receiveAmount'=>$data['sendAmount'],
            'sendCurrency'=>$data['receiveCurrency'],
            'receiveCurrency'=>$data['sendCurrency'],
            'sent'=>'0',
            'crossTnxId'=>'',
            'received'=>'1',
            'tid'=>$data['tid'],
        ]);
        return redirect()->route('p2p');
    }
    public function transactions(){
        $transactions = auth()->user()->p2ptransactions->sortBy('crated_at');
        return view('p2ptransactions',[
            'transactions'=>$transactions
        ]);
    }
    public function approved(){
        $transactions = auth()->user()->p2ptransactions->where('sent','=','1')->where('received','=','1');
        return view('p2pApprovedTransactions',[
            'transactions'=>$transactions
        ]);
    }

    public function received(){
        $data =  request()->all();
        $tnx = P2ptransaction::find($data['tnx_id']);
        $order = P2porder::find($tnx->order_id);
        $user = User::find($tnx->user_id);
        $amount = $order->amount - $tnx->sendAmount;
        if ($amount===0){
            $order->update(['completed'=>'1']);
        }
        $order->update(['amount'=>$order->amount-$tnx->sendAmount]);
        $tnx->update(['sent'=>'1','received'=>'1']);
        if ($tnx->sendCurrency === "pst"){
            $user->profile->update(['pst'=>$user->profile->pst-$tnx->sendAmount]);
        } else{
            $user->profile->update(['usdt'=>$user->profile->usdt-$tnx->sendAmount]);
        }
        $tnx2 = P2ptransaction::find(P2ptransaction::find($data['tnx_id'])->crossTnx_id);
        $order2 = P2porder::find($tnx2->order_id);
        $user2 = User::find($tnx2->user_id);
        $amount2 = $order2->amount - $tnx2->receiveAmount;
        if ($amount2===0){
            $order2->update(['completed'=>'1']);
        }
        $order2->update(['amount'=>$order2->amount-$tnx2->receiveAmount]);
        $tnx2->update(['sent'=>'1','received'=>'1']);
        if ($tnx2->receiveCurrency === 'pst'){
            $user2->profile->update([
                'pst'=>$user2->profile->pst+$tnx2->receiveAmount,
                'availablePST'=>$user2->profile->availablePST+$tnx2->receiveAmount
            ]);
        } else{
            $user2->profile->update([
                'usdt'=>$user2->profile->usdt+$tnx2->receiveAmount,
                'availableUSDT'=>$user2->profile->availableUSDT+$tnx2->receiveAmount
            ]);
        }
        return redirect()->route('p2p');
    }

    public function sent(){
        $data =  request()->all();
        $transaction = P2ptransaction::find($data['tnx_id']);
        $transaction->update(['sent'=>'1']);
        return redirect()->route('p2p.transactions');
    }
}
