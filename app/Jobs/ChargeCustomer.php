<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ChargeCustomer implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $fullamount;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($fullamount)
    {
        $fullamount = $this->fullamount;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        
    }
}