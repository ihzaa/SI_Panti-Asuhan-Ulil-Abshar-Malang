<?php

namespace App\Mail\Donatur;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DonaturEmailKonfirmasi extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(['address' => 'pantiasuhanulilabshar@gmail.com', 'name' => 'Pantiasuhanulilabshar'])->subject('Konfirmasi Donasi Diterima')
            ->view('emails.KonfirmasiDonasiDiterima');
        // return $this->from(['address' => 'no-reply@panti-ulilabsharmalang.com', 'name' => 'Panti asuhan ulil abshar'])->subject('Konfirmasi Donasi Diterima')
        // ->view('emails.KonfirmasiDonasiDiterima');
    }
}
