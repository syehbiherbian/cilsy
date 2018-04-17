<?php

namespace App\Mail;
use App\Models\Service;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SuksesMail extends Mailable
{
    use Queueable, SerializesModels;

    public $services;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(services $services)
    {
        $this->services = $service;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Selamat! Paket langganan cilsy anda sudah aktif')
                    ->view('mail.sukses_bayar');
    }
}
