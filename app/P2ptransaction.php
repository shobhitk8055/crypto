<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class P2ptransaction extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
    public function order(){
        return $this->belongsTo(P2porder::class);
    }
    public function crossTnx(){
        return $this->belongsTo(P2ptransaction::class);
    }
}
