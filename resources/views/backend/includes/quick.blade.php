<!--begin::Quick Panel-->
<div id="kt_quick_panel" class="offcanvas offcanvas-right pt-5 pb-10">
    <!--begin::Header-->
    <div class="offcanvas-header offcanvas-header-navs d-flex align-items-center justify-content-between mb-5">
        <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-primary flex-grow-1 px-10"
            role="tablist">
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#kt_quick_panel_notifications">
                    {!! trans('notifications.notifications') !!}
                </a>
            </li>
        </ul>
        <div class="offcanvas-close mt-n1 pr-5">
            <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_panel_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
        </div>
    </div>
    <!--end::Header-->

    <!--begin::Content-->
    <div class="offcanvas-content px-10">
        <div class="tab-content">
            <!--begin::Tabpane-->
            <div class="tab-pane fade show pt-3 pr-5 mr-n5 active" id="kt_quick_panel_notifications" role="tabpanel">

                <!--begin::Section-->
                <div class="mb-5">
                    <h5 class="font-weight-bold mb-5">Notifications</h5>

                    <!--begin: Item-->
                    <div class="d-flex align-items-center bg-light-warning rounded p-5 mb-5">
			            <span class="svg-icon svg-icon-warning mr-5">
			                <span class="svg-icon svg-icon-lg">
                            </span>
                        </span>

                        <div class="d-flex flex-column flex-grow-1 mr-2">
                            <a href="#" class="font-weight-normal text-dark-75 text-hover-primary font-size-lg mb-1">Another purpose persuade</a>
                            <span class="text-muted font-size-sm">Due in 2 Days</span>
                        </div>

                        <span class="font-weight-bolder text-warning py-1 font-size-lg">+28%</span>
                    </div>
                    <!--end: Item-->


                </div>

                <!--end::Section-->
            </div>
            <!--end::Tabpane-->

        </div>
    </div>
    <!--end::Content-->
</div>
<!--end::Quick Panel-->
