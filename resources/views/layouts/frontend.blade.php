<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="robots" content="all,follow">
    <!-- Favicon-->
    <link rel="shortcut icon" href="{!! asset('frontend/img/favicon.ico') !!}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{!! asset('frontend/vendor/bootstrap/css/bootstrap.min.css') !!}">
    <!-- Lightbox-->
    <link rel="stylesheet" href="{!! asset('frontend/vendor/lightbox2/css/lightbox.min.css') !!}">
    <!-- Range slider-->
    <link rel="stylesheet" href="{!! asset('frontend/vendor/nouislider/nouislider.min.css') !!}">
    <!-- Bootstrap select-->
    <link rel="stylesheet" href="{!! asset('frontend/vendor/bootstrap-select/css/bootstrap-select.min.css') !!}">
    <!-- Owl Carousel-->
    <link rel="stylesheet" href="{!! asset('frontend/vendor/owl.carousel2/assets/owl.carousel.min.css') !!}">
    <link rel="stylesheet" href="{!! asset('frontend/vendor/owl.carousel2/assets/owl.theme.default.css') !!}">
    <!-- Google fonts-->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Libre+Franklin:wght@300;400;700&amp;display=swap">
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css2?family=Martel+Sans:wght@300;400;800&amp;display=swap">
    <!-- FontAwesome CSS - loading as last, so it doesn't block rendering-->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css"
          integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr"
          crossorigin="anonymous">

    <!-- theme stylesheet-->
    <link rel="stylesheet" href="{!! asset('frontend/css/style.default.css') !!}" id="theme-stylesheet">
    <!-- Custom stylesheet - for your changes-->
    <link rel="stylesheet" href="{!! asset('frontend/css/custom.css') !!}">

    <!-- Tweaks for older IEs--><!--[if lt IE 9]-->
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <!-- end -->
    <livewire:styles/>
    @stack('style')

</head>
<body>
<div class="page-holder {!! request()->routeIs('detail')? 'bg-light' : '' !!}">
    <!-- navbar-->
@include('frontend.include.header')
<!-- HERO SECTION-->
    <div class="container">
        @yield('content')
    </div>


    <!-- footer-->
@include('frontend.include.footer')

<!-- modal-->
    <livewire:frontend.product-modal/>

<!-- JavaScript files-->

    <livewire:scripts/>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <x-livewire-alert::scripts/>
    <script defer src="https://unpkg.com/alpinejs@3.7.1/dist/cdn.min.js"></script>
    @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


    <script src="{!! asset('frontend/vendor/jquery/jquery.min.js') !!}"></script>
    <script src="{!! asset('frontend/vendor/bootstrap/js/bootstrap.bundle.min.js') !!}"></script>
    <script src="{!! asset('frontend/vendor/lightbox2/js/lightbox.min.js') !!}"></script>
    <script src="{!! asset('frontend/vendor/nouislider/nouislider.min.js') !!}"></script>
    <script src="{!! asset('frontend/vendor/bootstrap-select/js/bootstrap-select.min.js') !!}"></script>
    <script src="{!! asset('frontend/vendor/owl.carousel2/owl.carousel.min.js') !!}"></script>
    <script src="{!! asset('frontend/vendor/owl.carousel2.thumbs/owl.carousel2.thumbs.min.js') !!}"></script>
    <script src="{!! asset('frontend/js/front.js') !!}"></script>
    <script>
        // ------------------------------------------------------- //
        //   Inject SVG Sprite -
        //   see more here
        //   https://css-tricks.com/ajaxing-svg-sprite/
        // ------------------------------------------------------ //
        function injectSvgSprite(path) {

            var ajax = new XMLHttpRequest();
            ajax.open("GET", path, true);
            ajax.send();
            ajax.onload = function (e) {
                var div = document.createElement("div");
                div.className = 'd-none';
                div.innerHTML = ajax.responseText;
                document.body.insertBefore(div, document.body.childNodes[0]);
            }
        }

        // this is set to BootstrapTemple website as you cannot
        // inject local SVG sprite (using only 'icons/orion-svg-sprite.svg' path)
        // while using file:// protocol
        // pls don't forget to change to your domain :)
        injectSvgSprite('https://bootstraptemple.com/files/icons/orion-svg-sprite.svg');

    </script>

    @stack('js')


</div>
</body>
</html>

