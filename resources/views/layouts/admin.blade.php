<!DOCTYPE html>
<html
    lang="{!!  LaravelLocalization::getCurrentLocale() !!}"
    dir="{!! LaravelLocalization::getCurrentLocaleDirection() !!}"
    direction="{!! LaravelLocalization::getCurrentLocaleDirection() !!}"
    style="{!! LaravelLocalization::getCurrentLocaleDirection() !!}">

<!--begin::Head-->
<head>
    <base href="">
    <meta charset="utf-8"/>
    <title>{{ !empty($title) ? $title: trans('dashboard.admin_cpanel') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{!! __('dashboard.dashboard') !!}"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <link rel="shortcut icon" href="{!! asset('frontend/img/favicon.ico') !!}"/>

    <!--begin::Page Vendors Styles-->
    <link href="{{asset('adminBoard/assets/js/jsTree/default-dark/style.css')}}" rel="stylesheet" type="text/css"/>
    <!--end::Page Vendors Styles-->
    <link href="{{asset('adminBoard/assets/plugins/custom/bootstrapFileInput/css/fileinput.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <link href="{{asset('adminBoard/assets/plugins/custom/datepicker/themes/classic.css')}}" rel="stylesheet"
          type="text/css"/>
    <link href="{{asset('adminBoard/assets/plugins/custom/datepicker/themes/classic.date.css')}}" rel="stylesheet"
          type="text/css"/>

@if( LaravelLocalization::getCurrentLocale() =='ar')
    <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{asset('adminBoard/assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{asset('adminBoard/assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{asset('adminBoard/assets/css/themes/layout/header/base/light.rtl.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{asset('adminBoard/assets/css/themes/layout/header/menu/dark.rtl.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{asset('adminBoard/assets/css/themes/layout/brand/dark.rtl.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{asset('adminBoard/assets/css/themes/layout/aside/dark.rtl.css')}}" rel="stylesheet"
              type="text/css"/>
        <!--end::Layout Themes-->
        <link href="{{asset('adminBoard/assets/plugins/custom/bootstrapFileInput/css/fileinput-rtl.css')}}"
              rel="stylesheet" type="text/css"/>

        <link href="{{asset('adminBoard/assets/plugins/custom/datepicker/themes/rtl.css')}}" rel="stylesheet"
              type="text/css"/>


@else
    <!--begin::Global Theme Styles(used by all pages)-->
        <link href="{{asset('adminBoard/assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('adminBoard/assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Global Theme Styles-->
        <!--begin::Layout Themes(used by all pages)-->
        <link href="{{asset('adminBoard/assets/css/themes/layout/header/base/light.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{asset('adminBoard/assets/css/themes/layout/header/menu/dark.css')}}" rel="stylesheet"
              type="text/css"/>
        <link href="{{asset('adminBoard/assets/css/themes/layout/brand/dark.css')}}" rel="stylesheet" type="text/css"/>
        <link href="{{asset('adminBoard/assets/css/themes/layout/aside/dark.css')}}" rel="stylesheet" type="text/css"/>
        <!--end::Layout Themes-->


@endif

<!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700"/>
    <style>
        body, html {
            font-family: "Poppins", "ArbFONTSBEINNormalAR", sans-serif;
            font-weight: normal;
            font-style: normal;
        }
    </style>
    <!--end::Fonts-->
    <link href="{{asset('adminBoard/assets/plugins/custom/summernote/summernote-bs4.min.css')}}" rel="stylesheet"
          type="text/css"/>

    <link href="{{asset('adminBoard/assets/css/mystyle.css')}}" rel="stylesheet" type="text/css"/>
    <livewire:styles/>
    @stack('css')

</head>
<!--end::Head-->

<!--begin::Body-->
<body id="kt_body"
      class="header-fixed header-mobile-fixed subheader-enabled
       subheader-fixed subheader-mobile-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">

<!--begin::Main-->
<!--begin::Header Mobile-->
@include('backend.includes.header-mobile')
<!--end::Header Mobile-->

<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">

        <!--begin::Aside-->
        <div class="aside aside-left  aside-fixed  d-flex flex-column flex-row-auto" id="kt_aside">
            <!--begin::Brand-->
            <div class="brand flex-column-auto   " id="kt_brand">
                <!--begin::Logo-->

                <!--end::Logo-->

                <!--begin::Toggle-->
                <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
				<span class="svg-icon svg-icon svg-icon-xl"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg--><svg
                        xmlns="http://www.w3.org/2000/svg"
                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <path
            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
            fill="#000000" fill-rule="nonzero"
            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999) "/>
        <path
            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
            fill="#000000" fill-rule="nonzero" opacity="0.3"
            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999) "/>
    </g>
</svg><!--end::Svg Icon--></span></button>
                <!--end::Toolbar-->
            </div>
            <!--end::Brand-->

            <!--begin::Aside Menu-->
            @include('backend.includes.menu');
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside-->

        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
        @include('backend.includes.header')
        <!--end::Header-->

            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                @yield('content')
            </div>
            <!--end::Content-->

            <!--begin::Footer-->
        @include('backend.includes.footer')
        <!--end::Footer-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Main-->


<!-- begin::User Panel-->
@include('backend.includes.user-panel')
<!-- end::User Panel-->

@include('backend.includes.modals')


<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop">
	<span class="svg-icon"><!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Up-2.svg--><svg
            xmlns="http://www.w3.org/2000/svg"
            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <polygon points="0 0 24 0 24 24 0 24"/>
        <rect fill="#000000" opacity="0.3" x="11" y="10" width="2" height="10" rx="1"/>
        <path
            d="M6.70710678,12.7071068 C6.31658249,13.0976311 5.68341751,13.0976311 5.29289322,12.7071068 C4.90236893,12.3165825 4.90236893,11.6834175 5.29289322,11.2928932 L11.2928932,5.29289322 C11.6714722,4.91431428 12.2810586,4.90106866 12.6757246,5.26284586 L18.6757246,10.7628459 C19.0828436,11.1360383 19.1103465,11.7686056 18.7371541,12.1757246 C18.3639617,12.5828436 17.7313944,12.6103465 17.3242754,12.2371541 L12.0300757,7.38413782 L6.70710678,12.7071068 Z"
            fill="#000000" fill-rule="nonzero"/>
    </g>
</svg><!--end::Svg Icon--></span></div>
<!--end::Scrolltop-->




<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>
    var KTAppSettings = {
        "breakpoints": {
            "sm": 576,
            "md": 768,
            "lg": 992,
            "xl": 1200,
            "xxl": 1400
        },
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<!--end::Global Config-->


<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{asset('adminBoard/assets/plugins/global/plugins.bundle.js')}}"></script>
<script src="{{asset('adminBoard/assets/js/scripts.bundle.js')}}"></script>
<!--end::Global Theme Bundle-->
<script src="{{asset('adminBoard/assets/js/my_general_script.js')}}"></script>


<!--begin::Page Scripts(used by this page)-->
<script src="{{asset('adminBoard/assets/js/pages/widgets.js')}}"></script>
<script src="{{asset('adminBoard/assets/js/pages/crud/forms/widgets/bootstrap-switch.js')}}"></script>
<script src="{{asset('adminBoard/assets/js/pages/features/miscellaneous/bootstrap-notify.js')}}"></script>
<script src="{{asset('adminBoard/assets/js/pages/crud/file-upload/image-input.js')}}"></script>
<script src="{{asset('adminBoard/assets/js/pages/features/miscellaneous/sweetalert2.js')}}"></script>
<script src="{{asset('adminBoard/assets/js/pages/widgets.js')}}"></script>
<script src="{{asset('adminBoard/assets/js/pages/custom/profile/profile.js')}}"></script>
<script src="{{asset('adminBoard/assets/plugins/custom/bootstrapFileInput/js/plugins/piexif.js')}}"></script>
<script src="{{asset('adminBoard/assets/plugins/custom/bootstrapFileInput/js/plugins/sortable.js')}}"></script>
<script src="{{asset('adminBoard/assets/plugins/custom/bootstrapFileInput/js/fileinput.min.js')}}"></script>
<script src="{{asset('adminBoard/assets/plugins/custom/bootstrapFileInput/themes/fas/theme.min.js')}}"></script>



<script src="{{asset('adminBoard/assets/plugins/custom/summernote/summernote-bs4.min.js')}}"></script>
<script src="{{asset('adminBoard/assets/plugins/custom/datepicker/picker.js')}}"></script>
<script src="{{asset('adminBoard/assets/plugins/custom/datepicker/picker.date.js')}}"></script>
<!--end::Page Scripts-->


<!--Start:: Scripts-->
<script type="text/javascript">

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $(function () {
        $("#alert-message").fadeTo(5000, 300).slideUp(300, function () {
            $('#alert-message').slideUp(300);
        });
    });

    ///////////////////////////////////////////////////////////////////////////
    //////// Translate validation
    var required_validation = "{{ __('common.required') }}";
    var in_validation = "{{ __('common.in') }}";
    var digits_validation = "{{ __('common.digits') }}";
    var personal_id_validation = "{{ __('common.personal_id_validation') }}";
    var mobile_number_validation = "{{ __('common.mobile_number_validation') }}";
    var choose_validation = "{{ __('common.choose_validation') }}";
    var drag_and_drop = "{{ __('common.drag_and_drop_here') }}";

    ///////////////////////////////////////////////////////////////////////////
    //////// Translate Datatable
    window.lang = {
        lengthMenu: "@lang('general.show') _MENU_",
        info: "@lang('general.entries_from') _START_ @lang('general.to') _END_ @lang('general.form') _TOTAL_",
        infoEmpty: "@lang('general.entries_from') 0 @lang('general.to') 0 @lang('general.form') 0",
        infoFiltered: "(@lang('filtered_from') _MAX_ @lang('general.from_entries'))",
        processing: "@lang('general.processing')",
        loadingRecords: "@lang('general.loadingRecords')",
        zeroRecords: "@lang('general.not_result')",
        emptyTable: "@lang('general.not_values')",
        paginate: {
            first: "@lang('general.first')",
            previous: "@lang('general.previous')",
            next: "@lang('general.next')",
            last: "@lang('general.last')"
        }
    }

</script>


<!--Start::-->
@if( LaravelLocalization::getCurrentLocale() =='ar')
    <script src="{{asset('adminBoard/assets/plugins/custom/datepicker/translations/ar.js')}}"></script>
    <style>
        .fa-caret-down::before {
            content: "\f0d9";
        }

        .fa-caret-right::before {
            content: "\f0d7";
        }
    </style>
@endif
<!--End::-->

<livewire:scripts/>
@stack('js')



</body>
<!--end::Body-->
</html>


