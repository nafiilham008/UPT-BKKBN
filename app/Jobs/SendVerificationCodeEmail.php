<?php

namespace App\Jobs;

use App\Mail\VerificationCodeEmail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendVerificationCodeEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $newUser;
    protected $verificationCode;
    
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($newUser, $verificationCode)
    {
        $this->newUser = $newUser;
        $this->verificationCode = $verificationCode;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $newUser = $this->newUser;
        $verificationCode = $this->verificationCode;

        Mail::to($newUser->email)->send(new VerificationCodeEmail($verificationCode));
    }
}
