<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TrioptimaMail extends Mailable
{
    use Queueable, SerializesModels;

    public $details;
    public $trioptimaMail = 'angelamadjirova@gmail.com';


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

        return $this->subject($this->details['subject'])
            ->view('trioptimaEmail')
            ->from($this->trioptimaMail);
    }
}
