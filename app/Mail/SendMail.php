<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class SendMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    protected $TaskPending;
    public function __construct($TaskPending)
    {
        $this->TaskPending = $TaskPending;
    }

    public function build () {
        return $this->subject('التقرير اليومي عن المهام المعلقة')
                    ->view('emails.TaskPending')
                    ->with(['TaskPending' => $this->TaskPending]);
    }
}
