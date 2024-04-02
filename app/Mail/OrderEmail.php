<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;

class OrderEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */ 
    public $id;
    public $order;
    public $orderItems;
    public $email;
    public $password;
    public $is_new;
    public $user;
    public $is_customer;
    public function __construct($data)
    {
        $this->id = $data['id'];
        $this->email = $data['email'];
        $this->password = $data['password'];
        $this->is_new = $data['is_new'];
        $this->is_customer = $data['is_customer'];
    }

    /**
     * Get the message envelope.
     *
     * @return \Illuminate\Mail\Mailables\Envelope
     */
    public function build()
    {
        $obj = Order::find($this->id);
        $user_id = ($obj)? $obj->user_id:'';
        $user = User::find($user_id);
        $items = OrderDetail::getOrders($this->id);
        if ($obj) {
            $subject = ($this->is_customer)? 'Your Abv Tools order has been received!':'New Order #'. $obj->order_number;
            $this->user = $user;
            $this->order = $obj;
            $this->orderItems = $items;
            return $this->subject($subject)
            ->to($user->email)
            ->cc(['abvtradesol@gmail.com'])
            ->markdown('emails.orderEmail');
        }
    }
}
