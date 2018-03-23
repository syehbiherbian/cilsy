<?php

namespace App\Mail\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Contrib;

class ActivationEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $contrib;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Contributor $contrib)
    {
        $this->contributor = $contrib;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.auth.activation');
    }
}
