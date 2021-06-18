<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Stripe;
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;

class ChargeCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    public $customerId;
    public $amount;
    

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(string $customerId, int $amount)
    {
       
       $this->customerId = $customerId;
       $this->amount = $amount;
       
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
        
       $customer = \Stripe\Charge::create([
            'amount' => $this->amount * 100,
            'currency'=> 'gbp',
            'customer' => $this->customerId

        ]);

        ChargeCustomer::dispatch($customer);
    }
}