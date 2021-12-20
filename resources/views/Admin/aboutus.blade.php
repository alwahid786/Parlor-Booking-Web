@extends('Admin.layouts.main');

@section('body-content')
@section('page-title')
About us
@endsection
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


    <div class="for-overflow">
        <div class="row">

            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9 for_add_aboutus_bg h_100vh-s mx-auto">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="for_aboutus_text">
                            <p>
                                About Us
                            </p>


                            <!--After Nav Services Page Start !-->
                            <div class="container-fluid">
                                <div class="for_about_us_text_dummy">
                                    <p>
                                        Find a stylish new haircut, book last-minute nails, or treat yourself to a
                                        relaxing
                                        massage.Fresha is
                                        easiest and most reliable way to book with local salons and spas. Top features
                                        include:Instant booking
                                        confirmation, say goodbye to phone calls and schedule your appointments directly
                                        in the
                                        venue's live
                                        calendar.
                                    </p>
                                </div>
                                <div class="for_dummy_text_specific">
                                    <p>
                                        Discover the best new salons and spas by searching across thousands of
                                        venues, all with live online booking availability.
                                    </p>
                                </div>
                                <div class="for_dummy_text_specific">
                                    <p>
                                        Stav in control of vour time with features to Book, Cancel, Reschedule
                                        and Rebook vour own appointments, all without contacting the venue.
                                    </p>
                                </div>

                                <div class="for_dummy_text_specific">
                                    <p>
                                        Find the best prices with exclusive online discounts for off-peak
                                        bookings and last-minute reservations.
                                    </p>
                                </div>

                                <div class="for_dummy_text_specific">
                                    <p>
                                        Read trusted, authentic ratings from customers who reviewed their
                                        in-store experience.
                                    </p>
                                </div>

                                <div class="for_dummy_text_specific">
                                    <p>
                                        Easilv find the way to vour appointment location with built-in map
                                        directions.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


            </div>
        </div>
    </div>







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

@endsection