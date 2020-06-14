<?php

namespace App\Jobs;


use App\Mail\AdmInvoice;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendAdmInvoice implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    private $orderDetails;
    private $billingAddress;
    public function __construct($orderDetails,$billingAddress)
    {
        //
        $this->orderDetails = $orderDetails;
        $this->billingAddress = $billingAddress;

    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to('sales@alvinsmakeup.com')->send(new AdmInvoice($this->orderDetails,$this->billingAddress));
    }
}
