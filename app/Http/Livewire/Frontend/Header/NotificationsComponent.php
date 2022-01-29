<?php

namespace App\Http\Livewire\Frontend\Header;

use Livewire\Component;

class NotificationsComponent extends Component
{
    public $unreadNotificationsCount = '';
    public $unreadNotifications;

    public function getListeners(): array
    {
        $userId = auth()->id();
        return [
            "echo-notification:App.Models.User.{$userId},notification" => 'mount'
        ];
    }

    public function mount()
    {
        $this->unreadNotificationsCount = auth()->user()->unreadNotifications()->count();
        $this->unreadNotifications = auth()->user()->unreadNotifications()->get();
    }


    public function markAsRead($notificationID)
    {
        $notification = auth()->user()->unreadNotifications()->whereId($notificationID)->first();
        $notification->markAsRead();
        return redirect()->to($notification->data['order_url']);
    }

    public function render()
    {
        return view('livewire.frontend.header.notifications-component');
    }
}
