<?php

namespace App\Mail;
use App\Models\Member;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class InvoiceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $send;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($send)
    {
        $this->send = $send;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pembelian Tutoril Cilsy Telah Berhasil')
                    ->view('mail.pesan_paket');
    }
}
