<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous"> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css"
        integrity="sha512-SfTiTlX6kk+qitfevl/7LibUOeJWlt9rbyDn92a1DqWOw9vWG2MFoays0sgObmWazO5BQPiFucnnEAjpAB+/Sw=="
        crossorigin="anonymous" />

    <link rel="stylesheet" href="{{ asset('assets/css/asside_bar_css/asside_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/navbar_css/nav_bar.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin_css/appointment.css') }}">
    <title>Appointments</title>
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

    </style>
</head>

<body>
    <!--Asside Bar Page Start !-->
    <div class="for-overflow">
        <div class="row">
            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-2 col-sm-3 col-3 for_asside_bar_bg">
                @include('includes.saloon_dashboard.saloon_dashboard_navbar',['id'=>$id])
            </div>
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9 h_100vh-s">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="for_all_appointments">
                            <h4>All Appointments
                                <span class="pull-right">
                                    @include('includes.saloon_dashboard.nav-bar',['id'=>$id])
                                </span>
                            </h4>


                            <!--After Nav Appointments Page Start !-->

                            <div>
                                <div class="row for_main_row_appointment ">
                                    @foreach ($all_appointments as $appointment)
                                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                                            <div class=" mb-3 for_appointments_card_width">
                                                <div class="row g-0">
                                                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                                        <img src="{{ asset('assets/images/saloon_dashboard_images/placeholder.svg') }} "
                                                            class="for_appointments_img_common " alt="...">

                                                    </div>
                                                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                                        <div class="card-body card_body_for_appointment">
                                                            <button type="button" class="btn btn-sm px-4 d-none" >View</button>
                                                            <h5>{{ $appointment->user->name }}</h5>
                                                            @foreach ($appointment->appointment_details as $appoint_details)
                                                            <h6>{{ $appoint_details->services->name }}</h6>

                                                            @endforeach
                                                            <p> {{  date('d/m/Y', strtotime($appointment->date)) }} {{ date('h:i A', strtotime($appointment->start_time)) ?? ''}}</p>
                                                            <h4>${{ $appointment->total_price }}</h4>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
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

        })
    </script>

</body>

</html>
