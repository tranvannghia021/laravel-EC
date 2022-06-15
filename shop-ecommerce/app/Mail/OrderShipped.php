<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Http\Services\OrderDetailService;

class OrderShipped extends Mailable
{
    use Queueable, SerializesModels;
    protected  $customer;
    protected $order;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($customer,$order_id)
    {
        $this->customer = $customer;
      $this->order = \App\Http\Services\OrderDetailService::getItem($order_id);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
       // dd($this->order);
        return $this->view('client.mail.mail_order',[
            'orders'=>$this->order,
            'customer'=>$this->customer
        ]);
    }
}
