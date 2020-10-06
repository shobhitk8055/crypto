<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transfer extends Model
{
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }
}
