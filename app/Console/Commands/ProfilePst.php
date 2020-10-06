<?php

namespace App\Console\Commands;

use App\Profile;
use Illuminate\Console\Command;

class ProfilePst extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'profile:pst';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'increases pst of 1st profile by 100';

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
        $profile = Profile::find(1);
        $pst = $profile->pst +100;
        $profile->update([
            'pst'=>$pst
        ]);
        $profile->save();
    }
}
