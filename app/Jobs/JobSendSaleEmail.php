<?php

namespace App\Jobs;

use App\Mail\SendSaleEmail;
use App\Models\Customers;
use App\Models\Sale;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class JobSendSaleEmail implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(private $saleId)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //Recupera os dados da venda e do cliente
        $sale = Sale::find($this->saleId);
        $customer = Customers::find($sale->customer_id);

        Mail::to($customer->email)->later(now()->addMinute(), new SendSaleEmail($sale));
    }
}
