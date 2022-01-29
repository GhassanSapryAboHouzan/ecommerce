<?php

namespace App\Notifications\Backend\Order;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class OrderChangeStatusNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $order;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     */
//    public function toMail($notifiable)
//    {
//        return (new MailMessage)
//            ->line('The introduction to the notification.')
//            ->action('Notification Action', url('/'))
//            ->line('Thank you for using our application!');
//    }

    /**
     * DataBase Notification
     */
    public function toDatabase($notifiable)
    {
        return [
            'order_id' => $this->order->id,
            'order_ref' => $this->order->ref_id,
            'last_transaction' => $this->order->status($this->order->transactions()->latest()->first()->transaction),
            'order_url' => route('customer.orders'),
            'created_date' => $this->order->transactions()->latest()->first()->created_at->format('M d, Y'),
        ];
    }

    /**
     * Broadcast Notification
     */

    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'order_id' => $this->order->id,
                'order_ref' => $this->order->ref_id,
                'last_transaction' => $this->order->status($this->order->transactions()->latest()->first()->transaction),
                'order_url' => route('customer.orders'),
                'created_date' => $this->order->transactions()->latest()->first()->created_at->format('M d, Y'),
            ]
        ]);
    }
}
