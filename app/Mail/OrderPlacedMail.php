<?php

namespace App\Mail;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderPlacedMail extends Mailable
{
    use Queueable, SerializesModels;

    public $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    public function build()
    {
        return $this->subject('Your Order Confirmation')
            ->view('emails.order_placed')
            ->with([
                'orderNumber' => $this->order->order_number,
                'orderStatus' => ucfirst($this->order->order_status),
                'userName' => $this->order->user->name,
            ]);
    }
}
