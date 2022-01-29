<div id="kt_header" class="header header-fixed ">
    <!--begin::Container-->
    <div class=" container-fluid  d-flex align-items-stretch justify-content-between">
        <!--begin::Header Menu Wrapper-->
        <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
            <!--begin::Header Menu-->
            <div id="kt_header_menu" class="header-menu header-menu-mobile  header-menu-layout-default ">
                <ul class="menu-nav ">
                    <li class="menu-item  menu-item-open menu-item-here
                     menu-item-submenu menu-item-rel menu-item-open menu-item-here menu-item-active">
                        <a href="{!! route('index') !!}" class="menu-link ">
                            <span class="menu-text">&nbsp;<i class="fas fa-desktop"></i>&nbsp;
                                {{trans('dashboard.website')}}</span>
                            <i class="menu-arrow"></i></a>
                    </li>

                    <li class="menu-item  menu-item-open menu-item-here
                     menu-item-submenu menu-item-rel menu-item-open menu-item-here ">
                        <a href="{!! route('admin.supervisors.index') !!}" class="menu-link ">
                            <span class="menu-text">&nbsp;<i class="fas fa-users"></i>&nbsp;
                                {{trans('supervisors.supervisors')}}
                            </span>
                        </a>
                    </li>

                </ul>
                <!--end::Header Nav-->
            </div>
            <!--end::Header Menu-->
        </div>
        <!--end::Header Menu Wrapper-->

        <!--begin::Topbar-->
        <div class="topbar">


            <livewire:backend.navbar.notifications-component/>

            <!--begin::Languages-->
            <div class="dropdown">
                <!--begin::Toggle-->
                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                        <img class="h-20px w-20px rounded-sm"
                             @if( LaravelLocalization::getCurrentLocale() =='ar')
                             src="{{asset('adminBoard/assets/media/svg/flags/العربية.svg')}}"
                             @else
                             src="{{asset('adminBoard/assets/media/svg/flags/English.svg')}}"
                             @endif


                             alt=""/>
                    </div>
                </div>
                <!--end::Toggle-->

                <!--begin::Dropdown-->
                <div
                    class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                    <!--begin::Nav-->
                    <ul class="navi navi-hover py-4">
                        <!--begin::Item-->

                        <!--end::Item-->


                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li class="navi-item">
                                <a class="navi-link" rel="alternate" hreflang="{{ $localeCode }}"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                     <span class="symbol symbol-20 mr-3">
                                        <img
                                            src="{{asset('adminBoard/assets/media/svg/flags/'. $properties['native']  .'.svg')}}"
                                            alt=""/>
                                    </span>
                                    <span class="navi-text"> {{ $properties['native'] }}</span>
                                </a>
                            </li>
                        @endforeach


                    </ul>
                    <!--end::Nav-->
                </div>
                <!--end::Dropdown-->
            </div>
            <!--end::Languages-->


            <!--begin::User  -->
            <div class="topbar-item">
                <div class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                     id="kt_quick_user_toggle">
                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1"></span>
                    <span class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
                          {!! auth()->user()->full_name !!}
                    </span>
                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                        @if(auth()->user()->user_image != null)
                            <img src="{{ asset('adminBoard/uploaded_images/users/' . auth()->user()->user_image) }}">
                        @else
                            <img src="{{asset('adminBoard/images/user.jpg')}}">
                        @endif
                    </span>
                </div>
            </div>
            <!--end::User-->


        </div>
        <!--end::Topbar-->
    </div>
    <!--end::Container-->
</div>


<!-- begin:: Notifications modal -->
<div class="modal fade custom-modal" id="show_admin_notification_modal" tabindex="-1" role="dialog"
     aria-labelledby="show_admin_notification_modal"
     aria-hidden="true">
    <div class="modal-dialog  modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body">

                <div class="modal-inner text-center">
                    <form>
                        <div class="account-wrapper register-first">
                            <span style="display:table;margin:0 auto;">
                               <i class="flaticon-bell text-info icon-xl-3x"></i>
                            </span>
                            <div style="padding-right: 20px">
                                <p class="notification_title"></p>
                                <br/>
                                <p class="notification_details"></p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- end:: Notifications modal -->
