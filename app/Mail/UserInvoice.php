<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UserInvoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public $orderDetails;
    public function __construct($orderDetails)
    {
        //
        $this->orderDetails = $orderDetails;


    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Alvinsmakeup | Check Your Order Invoice')
            ->from('services@alvinsmakeup.com')->view('emails.user_order_invoice');
    }
}
