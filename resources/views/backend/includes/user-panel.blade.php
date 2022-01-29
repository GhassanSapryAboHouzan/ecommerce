<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">
            {{trans('dashboard.profile')}}
        </h3>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_quick_user_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->

    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <a href="#">
                    @if(auth()->user()->user_image != null)
                        <div class="symbol-label"
                             style="background-image: url('{{ asset('adminBoard/uploaded_images/users/' . auth()->user()->user_image) }}');">
                        </div>
                    @else
                        <div class="symbol-label"
                             style="background-image: url('{{asset('adminBoard/images/user.jpg')}}');">
                        </div>
                    @endif
                </a>

                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="#" class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">
                    {!! auth()->user()->full_name !!}
                </a>
                <div class="text-muted mt-1">
                </div>
                <div class="navi mt-2">
                    <a href="#" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-text text-muted text-hover-primary">
                                  {!! auth()->user()->email !!}
                            </span>
                        </span>
                    </a>

                    <a href="javascript:void(0);" class="btn btn-sm btn-light-primary font-weight-bolder py-2 px-5"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        {{trans('dashboard.logout')}}
                    </a>
                    <form action="{{ route('logout') }}" method="post" id="logout-form" class="d-none">
                        @csrf
                    </form>

                </div>
            </div>
        </div>
        <!--end::Header-->

        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->

        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">

            <!--begin::Item-->
            <a href="{!! route('admin.account.settings') !!}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                            <span class="svg-icon svg-icon-md svg-icon-success"><!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"></rect>
                            <path
                                d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                fill="#000000"></path>
                            <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"></circle>
                            </g>
                            </svg><!--end::Svg Icon--></span></div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            {!! __('dashboard.my_profile') !!}
                        </div>
                        <div class="text-muted">
                            {!! __('dashboard.account_settings_and_more') !!}
                        </div>
                    </div>
                </div>
            </a>
            <!--end:Item-->

            <!--begin::Item-->
            <a href="#" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                                <span class="svg-icon svg-icon-md svg-icon-warning"><!--begin::Svg Icon | path:assets/media/svg/icons/Shopping/Chart-bar1.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"></rect>
                                <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"></rect>
                                <path
                                    d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                    fill="#000000" fill-rule="nonzero"></path>
                                <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"></rect>
                                </g>
                                </svg><!--end::Svg Icon--></span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">
                            {!! __('dashboard.my_messages') !!}
                        </div>
                        <div class="text-muted">
                            {!! __('dashboard.inbox_and_tasks') !!}
                        </div>
                    </div>
                </div>
            </a>
            <!--end:Item-->

        </div>
        <!--end::Nav-->

    </div>
    <!--end::Content-->
</div>
