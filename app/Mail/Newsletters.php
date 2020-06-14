<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Newletters extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $subscriber;
    public $products;
    public $topic;
    public $body;

    public function __construct($subscriber,$products,$topic,$body)
    {
        //
        $this->subscriber = $subscriber;
        $this->products = $products;
        $this->topic = $topic;
        $this->body = $body;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Check Out These Exciting Products From Alvinsmakeup')->view('emails.newsletter');
    }
}
