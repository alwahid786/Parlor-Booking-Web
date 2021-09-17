<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>@yield('page-title', 'GLITTERSUPS')</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.svg') }}" type="image/svg+xml" sizes="16x16">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        crossorigin="anonymous" />

    {{-- user calender css --}}
    <link rel="stylesheet" href="{{ asset('lib/dist/css/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/icon_navs.eot') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/icon_navs.svg') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/icon_navs.ttf') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/icon_navs.woff') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/pignose.calendar.eot') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/pignose.calendar.svg') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/pignose.calendar.ttf') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/pignose.calendar.woff') }}">



    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    {{-- <link rel="stylesheet" href="{{ dd(asset('assets/css/dashboard_create_account.css')) }}" /> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/user_nav_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">

    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin_css/profile_page.css') }}">

    {{--  calender for user appointment   --}}
    {{-- <link href="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.css" rel="stylesheet">
    <link href="{{ asset('assets/css/mobiscroll.jquery.min.css') }}" rel="stylesheet"> --}}



    <title>Document</title>
    <style>
        .after_navBar_bg_main {
            background-image: url("{{ asset('assets/images/user_nav_images/Image.svg') }}");
            background-color: rgba(0, 0, 0, 0.7);
            background-size: cover;
            height: 500px;
        }

        .one {
            padding-left: 36px;
            background-repeat: no-repeat;
            background-position-y: 9px;
            background-position-x: 8px;
            background-image: url("{{ asset('assets/images/home_page_component/Vector.svg') }}");
            /* margin-left: 10px; */
        }

        .two {
            padding-left: 36px;
            background-repeat: no-repeat;
            background-position-y: 9px;
            background-position-x: 8px;
            background-image: url("{{ asset('assets/images/home_page_component/celender.svg') }}");
            /* margin-left: 10px; */
        }

        .three {
            padding-left: 36px;
            background-repeat: no-repeat;
            background-position-y: 9px;
            background-position-x: 8px;
            background-image: url("{{ asset('assets/images/home_page_component/location.svg') }}");
            /* margin-left: 10px; */
        }

    </style>
</head>

<body>

    {{-- add test to class to differentiate --}}
    <div class="___class_+?0___">
        @include('includes.navbar')
    </div>

        <div class=" after_navBar_bg_main">
            @include('includes.search')
        </div>

    </div>
    <div class="w-100">
        @yield('content')
    </div>

    <div class="for-footer ">
        <div class="d-flex flex-wrap align-content-right">
            @include('partials.footer')
        </div>
    </div>



    {{--  @include('UserBookModal.book_service_modal',[$salon_uuid])  --}}
    @include('UserAuthModals.goto_signin_modal',[])
    @include('UserAuthModals.signup_socail_modal',[])
    @include('UserAuthModals.signin_modal',[]);
    @include('UserAuthModals.enter_code_modal',[])
    @include('UserAuthModals.signup_modal',[])
    @include('UserAuthModals.forgot_password_modal',[])
    @include('UserAuthModals.reset_password_modal',[])



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="{{ asset('lib/dist/js/pignose.calendar.min.js') }}"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/semantic-ui/2.3.1/semantic.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
        integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT" crossorigin="anonymous">
    </script>


    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js "></script> --}}

    <!-- Popper JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js "></script>

    <!-- Latest compiled JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js "></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>


        {{--  calender scripts on user appointment  --}}
        {{-- <script src="https://code.jquery.com/mobile/1.4.5/jquery.mobile-1.4.5.min.js"></script>

        <script src="{{ asset('assets/js/mobiscroll.jquery.min.js') }}"></script> --}}

    <script src="{{ asset('assets/js/common.js') }}"></script>
    <script src="{{ asset('assets/js/auth.js') }}"></script>
    <script src="{{ asset('assets/js/user.js') }}"></script>

    <script>
        $(function(event) {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
    </script>

    {{-- @stack('footer-head-scripts') --}}
    @yield('footer-scripts')

    <script>
        let LandingPage ="{{ route('home') }}"
    </script>

</body>

</html>
