<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Notify extends Mailable
{
    use Queueable, SerializesModels;
    protected $OTP;
    protected $email;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email,$otp)
    {
        $this->email = $email;
        $this->OTP = $otp;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('client.mail.sendOTP',[
            'otp'=>$this->OTP,
        ]);
    }
}
