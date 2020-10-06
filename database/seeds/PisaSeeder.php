<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\DailyPST;
use \Illuminate\Support\Facades\Date;
use Carbon\Carbon;
use App\Admin;
use App\Essential;
use Illuminate\Support\Facades\Hash;

class PisaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $yesterday = Carbon::yesterday();
        for($i=0;$i<2000;$i++){
            $yesterday = $yesterday->addDay(1);
            DailyPST::create([
                'date'=>$yesterday->toDateString(),
                'status'=>'pending'
            ]);
        }
        Essential::create([
            'rate'=>0.5
        ]);
        Admin::create([
            'name'=>'Shobhit',
            'email'=>"s@s.com",
            'username'=>'shobi',
            'password'=>Hash::make("12345678")
        ]);
    }
}
