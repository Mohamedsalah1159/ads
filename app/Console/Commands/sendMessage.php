<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Models\Ad;
use App\Models\Advertiser;
use App\Mail\NotifyEmail;

class sendMessage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'notify:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send email notify for advertiser one day before';

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
     * @return int
     */
    public function handle()
    {
        $advertiser = Ad::with(['advertiser' => function($q){
            $q->select('advertiser_id', 'email');
        }])->get();
        $emails = Advertiser::pluck('email')->toArray();
        foreach($emails as $email){
            Mail::To($email)->send(new NotifyEmail());
        }
    }
}
