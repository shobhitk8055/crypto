<?php

namespace App\Http\Controllers;

use App\Essential;
use Illuminate\Http\Request;

class RateController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index(){
        $rate = Essential::find(1);
        return view('admin.rate',[
            'rate'=>$rate
        ]);
    }
    public function update(){
        $data = request()->all()['rate'];
        $rate = Essential::find(1);
        $rate->update(["rate"=>$data]);
        return redirect()->route('rate');
    }
}
