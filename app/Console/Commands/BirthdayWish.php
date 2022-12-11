<?php

namespace App\Console\Commands;

use App\Mail\BirthdayMail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class BirthdayWish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'birthday:wish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'send birthday wishing mail on birthday';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        // config('models-variable.models.user.class')
        $users = User::whereMonth('dob', date('m'))
            ->whereDay('dob', date('d'))->get();
         Log::info($users);
            if($users->count() > 0){
                foreach($users as $user){
                    Mail::to($user->email)->send(new BirthdayMail($user));
                }
            }
    }
}
