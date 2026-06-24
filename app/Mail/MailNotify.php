<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailNotify extends Mailable
{
    use Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function build()
    {
        return $this->from('hohoang2128@gmail.com', 'ShoppingStore')
            ->subject('Xác nhận đơn hàng - ShoppingStore')
            ->view('frontend.email.email')
            ->with('data', $this->data);
    }
}