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

    <link rel="stylesheet" href="{{ asset('assets/css/navbar.css') }}">
    {{-- <link rel="stylesheet" href="{{ dd(asset('assets/css/dashboard_create_account.css')) }}" /> --}}

    <link rel="stylesheet" href="{{ asset('assets/css/user_nav_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/home.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/footer.css') }}">



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
    <div>
        @yield('content')
    </div>

    <div class="for-footer ">
        <div class="d-flex flex-wrap align-content-right">
            @include('partials.footer')
        </div>
    </div>



    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
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


</body>

</html>
