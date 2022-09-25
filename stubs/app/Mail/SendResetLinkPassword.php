<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendResetLinkPassword extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public string $url,
        public string $user_name,
    ) {
    }

    public function build()
    {
        return $this->markdown('emails.send-reset-link')
            ->subject("[NP Marketing Tool] Reset Password");
    }
}
