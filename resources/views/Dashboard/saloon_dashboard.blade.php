<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" />

    {{--  <script type="javascript" src="dist/js/pignose.calendar.full.min.js"></script>  --}}
    <link rel="stylesheet" href="{{ asset('lib/dist/css/pignose.calendar.min.css') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/icon_navs.eot') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/icon_navs.svg') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/icon_navs.ttf') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/icon_navs.woff') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/pignose.calendar.eot') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/pignose.calendar.svg') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/pignose.calendar.ttf') }}">
    <link rel="stylesheet" href="{{ asset('lib/dist/fonts/pignose.calendar.woff') }}">


    <link rel="stylesheet" href="{{ asset('assets/css/asside_bar_css/asside_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar_css/nav_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin_css/past_appointments.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin_css/page_twent_one.css') }}">
    <title>Dashboard</title>
    <style>
        .pic:hover {
            background-image: url("{{ asset('assets/images/saloon_dashboard_images/Grouphover.svg') }}");
            /* background-color: red; */

            margin-left: 15px;
            height: 75px;
            width: 97%;



        }


        @media (min-width: 768px) and (max-width: 1024px) {
            .pic:hover {
                background-image: url("{{ asset('assets/images/saloon_dashboard_images/Grouphover.svg') }}");
                background-size: cover;
                margin-left: 8px;
                height: 75px;
                width: 97%;
                font-size: 0px;
                position: relative;


            }

            .for_img_css_appointment span {
                margin-left: 3px;
                /* margin-top: 1px !important; */
                font-size: 10px;
            }

            .for_img_css_appointment span:hover {
                margin-top: 100px !important;
            }

            .for_img_css_appointment img {
                margin-left: 8px;
                width: 20%;
            }

            .for_img_css_past img {
                margin-left: 8px;
                width: 20%
            }

            .for_img_css_past span {
                margin-left: 1px;
                font-size: 8px;
            }
        }

        @media (min-width: 320px) and (max-width: 767px) {
            .col-2 {
                flex: 0 0 auto;
                width: 24.666667%;
            }

            .pic:hover {
                background-image: url("{{ asset('assets/images/saloon_dashboard_images/Grouphover.svg') }}");
                background-size: cover;
                margin-left: 7px;
                height: 64px;
                width: 98%;
                font-size: 9px;


            }

            .for_img_css img {
                margin-left: 5px;
                width: 22%;
                margin-top: -5px;
            }

            .for_img_css span {
                margin-left: 2px;
                font-size: 9px;
            }

            .for_img_css_appointment span {
                margin-left: 1px;
                font-size: 8px;
            }

            .for_img_css_appointment img {
                margin-left: 5px;
                width: 20%;
            }

            .for_img_css_past img {
                margin-left: 5px;
                width: 20%;
            }

            .for_img_css_past span {
                margin-left: 0px;
                font-size: 6px;
            }
        }

        .pignose-calendar {
            width: 100% !important;
            max-width: none;
            border-radius: 5px;
        }

        .pignose-calendar.pignose-calendar-blue .pignose-calendar-body .pignose-calendar-row .pignose-calendar-unit.pignose-calendar-unit-active a{
            border-radius: 5px !important;
            background-color: #133E59;
            color: white !important;
        }
        .pignose-calendar.pignose-calendar-blue .pignose-calendar-header .pignose-calendar-week{
            color: #7889A0;
        }
        .pignose-calendar.pignose-calendar-blue .pignose-calendar-header .pignose-calendar-week.pignose-calendar-week-sat, .pignose-calendar.pignose-calendar-blue .pignose-calendar-header .pignose-calendar-week.pignose-calendar-week-sun{
            color: #7889A0;
        }

        .pignose-calendar.pignose-calendar-blue .pignose-calendar-body .pignose-calendar-row .pignose-calendar-unit.pignose-calendar-unit-sat a, .pignose-calendar.pignose-calendar-blue .pignose-calendar-body .pignose-calendar-row .pignose-calendar-unit.pignose-calendar-unit-sun a{
            color: #070B31;
        }

        .pignose-calendar.pignose-calendar-blue .pignose-calendar-body .pignose-calendar-row .pignose-calendar-unit a{
            color: #070B31;
        }

        .pignose-calendar.pignose-calendar-blue .pignose-calendar-top[
            border-top-right-radius: 5px;
            border-top-left-radius: 5px;
        ]
        ]
        

    </style>
</head>

<body>
    <!--Asside Bar Page Start !-->
    <div class="for-overflow">
        <div class="row">
            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 for_asside_bar_bg">
                @include('includes.saloon_dashboard.saloon_dashboard_navbar',['id'=>$id])
            </div>
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9">
                <div class="">
                    {{--  <span>hjshdjshdjshdj</span>  --}}
                    <span class="pull-right">
                        @include('includes.saloon_dashboard.nav-bar',['id'=>$id])
                    </span>
                
            
          
        <div class="pt-5">
            <div class="row pt-5 w-100">
                <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-12 col-12">
                    <div class="card for_hello_beauty_bg">
                        <div class="text-white p-3 for_hello_beauty_salon">
                            <h5>Hello Beauty Salon</h5>
                            <div>
                                <p class="">Here are your important tasks and reports. <br>
                                    <span class="mt-n2 for_please_check_the">Please check the next
                                        appointment .</span>
                                </p>

                            </div>
                        </div>
                    </div>

                    <div class="pt-4">
                        @include('dashboard_partials.calender')
                    </div>

                    <div class="row pt-3">
                        @include('dashboard_partials.request_appointments',['appointments' => $appointments])

                        <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                            @include('dashboard_partials.appointments',['appointments' => $appointments])
                        </div>


                    </div>
                </div>

                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ex1">
                    @include('dashboard_partials.notifications')
                </div>

            </div>
        </div>

    </div>

    <!--Asside Bar Page End !-->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
                <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js" integrity="sha512-qTXRIMyZIFb8iQcfjXWCO8+M5Tbc38Qi5WzdPOYZHIlZpzBHG3L3by84BBBOiRGiEb7KKtAOAs5qYdUiZiQNNQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
                <script src="{{ asset('lib/dist/js/pignose.calendar.min.js') }}"></script>

                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
                                integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4"
                                crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
                                integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
                                crossorigin="anonymous"></script>
                <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.min.js"
                                integrity="sha384-Atwg2Pkwv9vp0ygtn1JAojH0nYbwNJLPhwyoVbhoPwBhjQPR5VtM2+xf0Uwh9KtT"
                                crossorigin="anonymous"></script>
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

                <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.2/jquery.validate.min.js" integrity="sha512-UdIMMlVx0HEynClOIFSyOrPggomfhBKJE28LKl8yR3ghkgugPnG6iLfRfHwushZl1MOPSY6TsuBDGPK2X4zYKg==" crossorigin="anonymous"></script>

                <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>

                <script src="{{ asset('assets/js/common.js') }}"></script>

                {{--  // for implementation of calendar  --}}
                {{--  <script src="../node_modules/pg-calendar/dist/js/pignose.calendar.min.js"></script>  --}}

                <script>
                    $('.for-audi').click(function() {

                        if ($('.toggle_show').hasClass('show')) {
                            $('.toggle_show').removeClass('show')
                            $('.for-audi-menu').removeClass('show')
                        } else {
                            $('.toggle_show').addClass('show')
                            $('.for-audi-menu').addClass('show')
                        }

                    })

                    $(document).ready(function() {

                         $.ajaxSetup({
                            headers: {
                                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            }
                        });
                        $("#test-d").click(function() {
                            alert('ok');
                        });

                        $('.navbar-light .dmenu').hover(function() {
                            $(this).find('.sm-menu').first().stop(true, true).slideDown(150);
                        }, function() {
                            $(this).find('.sm-menu').first().stop(true, true).slideUp(105)
                        });
                    });

                    $('.divID ').click(function() {
                        $(this).addClass('testcolor')
                        // $(this).removeClass('testcolor')
                        $(this).addClass('avi')
                    })

                    $('.second ').click(function() {
                        $(this).addClass('avi')
                        // $(this).removeClass('testcolor')

                    });


                    // $(function() {
                    //     $('.calendar').pignoseCalendar();
                    // });

                </script>

                @yield('dashboard-footer');

</body>

</html>
