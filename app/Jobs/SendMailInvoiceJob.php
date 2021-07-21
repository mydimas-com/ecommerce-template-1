<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use App\Mail\InvoiceMail;
use Illuminate\Support\Facades\Mail;

class SendMailInvoiceJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $mail_to;
    protected $data;

    public function __construct($mail_to, $data)
    {
        $this->mail_to = $mail_to;
        $this->data = $data;
    }

    public function handle()
    {
        Mail::to($this->mail_to)->send(new InvoiceMail($this->data));
    }
}
