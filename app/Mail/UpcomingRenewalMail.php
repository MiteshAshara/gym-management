<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UpcomingRenewalMail extends Mailable
{
    use Queueable, SerializesModels;

    public $count;

    public function __construct($count)
    {
        $this->count = $count;
    }

    public function build()
    {
        return $this->subject('Upcoming Membership Renewals')
                    ->view('emails.renewals')
                    ->with(['count' => $this->count]);
    }
}
