<?php

namespace App\Http\Controllers;

use App\Deposit;
use App\Essential;
use Illuminate\Http\Request;
use \GuzzleHttp\Client;

class DepositController extends Controller
{
    public function show(){
        $pstRate = Essential::find(1)->rate;
        $client = new Client();
        $allDeposits = auth()->user()->deposits->all();
        $count = 1;
//        $request = $client->get('http://api.coinlayer.com/api/live?access_key=f09f38ff1dc0580658ce903577f1b7b3&symbols=usdt&target=inr');
//        $usdtRate = json_decode($request->getBody())->rates->USDT;
        return view('depositFunds',[
            'pstRate'=>$pstRate,
            'usdtRate'=>"75.35",
            'allDeposits'=>$allDeposits,
            'count'=>$count
        ]);
    }
    public function store(){
        $data =request()->all();
        if ($data['currency']=='pst'){
            $data['payableAmount']= $data['pstRate']*$data['volume'];
        } elseif ($data['currency']=='usdt'){
            $data['payableAmount']= $data['usdtRate']*$data['volume'];
        }
        auth()->user()->deposits()->create($data);
        return redirect()->route('deposit');
    }
}
