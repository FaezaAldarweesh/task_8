<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\SendMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class MailSend implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    protected $TaskPending;
    public function __construct($TaskPending)
    {
        $this->TaskPending = $TaskPending;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $user_emails = User::pluck('email');

        foreach($user_emails as $user_email){
            Mail::to($user_email)->send(new SendMail($this->TaskPending));
        }
    }
}
