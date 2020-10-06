<?php

namespace App\Console\Commands;

use App\Package;
use App\User;
use Illuminate\Console\Command;

class PstUpdate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Pst:Update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Daily updates the pst in wallet';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $packages = Package::all()->where('activationDate','<',date("Y/m/d"))
            ->where('endDate','>',date("Y/m/d"))->where('name',"10000 PST");
        if (!($packages->isEmpty())){
            foreach ($packages as $package) {
                $user = User::find($package->user_id);
                $userPST = $user->profile->pst;
                $userPST = $userPST + 50;
                $user->profile->update(["pst" => $userPST]);
            }
        } //365 DIN
    }
}
