<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderPlacedNotification extends Notification implements ShouldQueue
{
    use Queueable;

    protected $order;

    public function __construct($order)
    {
        $this->order = $order;
    }

    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Order Placed Successfully')
                    ->line('Your order #' . $this->order->id . ' has been placed.')
                    ->line('Total Amount: $' . $this->order->total_amount)
                    ->action('View Order', url('/orders/' . $this->order->id))
                    ->line('Thank you for shopping with us!');
    }
}