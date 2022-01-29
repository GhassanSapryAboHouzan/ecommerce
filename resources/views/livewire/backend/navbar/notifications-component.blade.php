<div class="d-flex">
    <!--begin::notifications Panel-->
    <div class="topbar-item">
        <div class="btn btn-icon btn-clean btn-lg mr-1 notifications_count" id="kt_quick_panel_toggle">
            <span class="notification_alert_dot">{!! $unreadNotificationsCount !!}</span>
            <span class="svg-icon svg-icon-xl svg-icon-primary">
                <i class="flaticon-bell text-info icon-2x"></i>
            </span>
        </div>
    </div>

    <div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
        <!--begin::Header-->
        <div
            class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
            <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
                role="tablist">
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_notifications">
                        {!! trans('dashboard.notifications') !!}
                    </a>
                </li>
            </ul>
            <div class="offcanvas-close mt-n1 pr-5">
                <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary"
                   id="kt_quick_panel_close">
                    <i class="ki ki-close icon-xs text-muted"></i>
                </a>
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Content-->
        <div class="offcanvas-content px-10">
            <div class="tab-content">
                <!--begin::Tabpane-->
                <div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="kt_quick_panel_notifications"
                     role="tabpanel">
                    <!--begin::Section-->
                    <div class="mb-5">

                    @forelse($unreadNotifications as $unreadNotification)
                        <!--begin: Item-->
                            <div class="d-flex align-items-center  rounded p-5 mb-5 bg-light-info">
                                    <span class="svg-icon svg-icon-warning mr-5">
                                        <span class="svg-icon svg-icon-lg">
                                                <i class="flaticon-bell text-danger icon-lg"></i>
                                        </span>
                                   </span>

                                <a wire:click="markAsRead('{!! $unreadNotification->id !!}')"
                                   href="{!! $unreadNotification->data['order_url'] !!}">

                                    <div class="d-flex flex-column flex-grow-1 mr-2">
                                        <span
                                            class="font-weight-normal text-dark-75 text-bold font-size-h5-sm mb-1 show_notification_btn">
                                            New order with amount [ {!! $unreadNotification->data['amount'] !!} ] from
                                            {!! $unreadNotification->data['customer_name'] !!}
                                        </span>
                                        <span class=" text-warning font-size-sm font-weight-bold">
                                        {!! $unreadNotification->data['created_date'] !!}
                                    </span>
                                    </div>
                                </a>


                            </div>
                            <!--end: Item-->
                        @empty
                            <div class="d-flex align-items-center  rounded p-5 mb-5 bg-light-success">
                                No Notification Exists
                            </div>
                        @endforelse

                    </div>
                    <!--end::Section-->
                </div>
                <!--end::Tabpane-->
            </div>
        </div>
        <!--end::Content-->
    </div>
    <!--end::notifications Panel-->
</div>
