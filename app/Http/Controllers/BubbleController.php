<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BubbleController extends Controller
{
    public function index(){
        include (dirname(__FILE__)."/pstUpdate.php");
    }
}
