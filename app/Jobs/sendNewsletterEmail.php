<?php

namespace App\Jobs;

use App\Mail\Newletters;
use App\Subscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class sendNewsletterEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */

    private $subscriber;
    private $products;
    private $topic;
    private $body;
    public function __construct(Subscriber $subscriber,$products,$topic,$body)
    {
        $this->subscriber = $subscriber;
        $this->products = $products;
        $this->topic = $topic;
        $this->body = $body;

        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        Mail::to($this->subscriber->email)->send(new Newletters($this->subscriber,$this->products,$this->topic,$this->body));
    }
}
