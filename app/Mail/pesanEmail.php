<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;



class pesanEmail extends Mailable
{
    use Queueable, SerializesModels;
    public $items,$code,$nama,$total;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($items,$code,$nama,$total)
    {
        //
        $this->nama = $nama;
        $this->items = $items;
        $this->code = $code;
        $this->total = $total;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       return $this->subject('Pemesanan Tiket')
                   ->markdown('museum1.email.pesantiket')
                   ->with(
                    [
                        'code' => $this->code,
                        'item' => $this->items,
                        'name' => $this->nama,
                        'total' => $this->total,
                        'website' => 'http://localhost:8000/visitor',
                    ]);
    }
}
