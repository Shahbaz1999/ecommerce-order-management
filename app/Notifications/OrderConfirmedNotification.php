<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderConfirmedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public function __construct(protected $order)
    {
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Your Order Has Been Confirmed!')
                    ->line('Order ID: #' . $this->order->id)
                    ->line('Total: $' . number_format($this->order->total_amount, 2))
                    ->action('View Order', url('/orders/' . $this->order->id))
                    ->line('Thank you for shopping with us!');
    }
}