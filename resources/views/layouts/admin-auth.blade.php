<!DOCTYPE html>
<html lang="{!! LaravelLocalization::getCurrentLocale() !!}"
      dir="{!! LaravelLocalization::getCurrentLocaleDirection() !!}"
      direction="{!! LaravelLocalization::getCurrentLocaleDirection() !!}"
      style="{!! LaravelLocalization::getCurrentLocaleDirection() !!}">

<head>
    <meta charset="utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no"/>
    <meta name="description" content=""/>
    <meta name="author" content=""/>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{!! __('customAuth.login') !!}</title>

    <link href="{!! asset('adminBoard/adminLogin/login.css') !!}" rel="stylesheet"/>
    <link rel="icon" type="image/x-icon" href="{!! asset('frontend/img/favicon.ico') !!}"/>


    @if (LaravelLocalization::getCurrentLocale() == 'ar')
        <style>
            body, html {
                font-family: "Poppins", "ArbFONTSBEINNormalAR", sans-serif;
                font-weight: bolder;
                font-style: normal;
            }
        </style>
    @endif

    @yield('style')
</head>

<body class="bg-primary">

<div id="layoutAuthentication">
    <div id="layoutAuthentication_content">
        <main>
            <div class="container-xl px-4">
                <div class="row justify-content-center">
                    <div class="col-lg-5">
                        @yield('content')
                    </div>
                </div>
            </div>
        </main>
    </div>
    <div id="layoutAuthentication_footer">
        <footer class="footer-admin mt-auto footer-dark">
            <div class="container-xl px-4">
                <div class="row">
                    <div class="col-md-6 small">{!! __('dashboard.Copyright') !!}</div>
                    <div class="col-md-6 text-md-end small">
                    </div>
                </div>
            </div>
        </footer>
    </div>
</div>


@yield('script')
</body>

</html>
