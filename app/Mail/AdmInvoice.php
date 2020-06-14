<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class AdmInvoice extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $orderDetails;
    public $billingAddress;

    public function __construct($orderDetails,$billingAddress)
    {
        //
        $this->orderDetails = $orderDetails;
        $this->billingAddress = $billingAddress;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Order Alert | From '. $this->billingAddress->phone_number)
            ->from('services@alvinsmakeup.com')->view('emails.admin_order_invoice');
    }
}
