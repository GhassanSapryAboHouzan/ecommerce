<div>
    <a href="#" class="nav-link dropdown-toggle withoutAfter" id="notificationDropdown"
       data-toggle="dropdown"
       aria-haspopup="true" aria-expanded="false">

        <span class="badge badge-danger badge-counter">{!! $unreadNotificationsCount !!}</span>
        <i class="fas fa-user-alt mr-1 text-gray"></i>
    </a>
    <div class="dropdown-menu mt-3 notification-dropdown" aria-labelledby="notificationDropdown">

        @forelse($unreadNotifications as $unreadNotification)

            @if($unreadNotification->type=='App\Notifications\Frontend\Customer\OrderThanksNotification')
                <a href="javascript:void(0)" wire:click="markAsRead('{!! $unreadNotification->id !!}')"
                   class="dropdown-item border-0">
                    <div class="small text-gray-500">{{ $unreadNotification->data['created_date'] }}</div>
                    <span class="font-weight-bold">
                   Order  {{ $unreadNotification->data['order_ref'] }}  Completed Successfully
                </span>
                </a>
            @endif

            @if($unreadNotification->type=='App\Notifications\Backend\Order\OrderChangeStatusNotification')
                <a href="javascript:void(0)" wire:click="markAsRead('{!! $unreadNotification->id !!}')"
                   class="dropdown-item border-0">
                    <div class="small text-gray-500">{{ $unreadNotification->data['created_date'] }}</div>
                    <span class="font-weight-bold">
                Order {{ $unreadNotification->data['order_ref'] }}  status is
                {!! $unreadNotification->data['last_transaction'] !!}
                </span>
                </a>
            @endif

        @empty
            <a href="javascript:void(0)">
                No Notifications Found
            </a>
        @endforelse

    </div>
</div>

