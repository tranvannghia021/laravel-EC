<?php

namespace App\Jobs;

use App\Mail\OrderShipped;
use App\Mail\Notify;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Http\Services\OrderDetailService;

class SendMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected  $customer;
    protected $order_id;
    protected $data;
    protected $orderDetailsService;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data)
    {
      $this->data= $data;

      //$this->customer = $data['customer'];
      //$this->order_id = $data['order_id'];

    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
    //dd( $this->order_id);
    $sendmail=$this->data;
      if($sendmail['reset_password']==true){
        Mail::to($sendmail['email'])->send(new Notify($sendmail['email'], $sendmail['otp']));
      }
      else 
      Mail::to($sendmail['customer']['email'])->send(new OrderShipped( $sendmail['customer'], $sendmail['order_id']));
    // Mail::to($this->customer['email'])->send(new OrderShipped($this->customer,$this->order_id))
    }
}
