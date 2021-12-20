@extends('Admin.layouts.main');

@extends('Admin.layouts.main');

@section('body-content')
@section('page-title')
    Privacy Policy
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


    <!--Asside Bar Page Start !-->
    <div class="for-overflow">
        <div class="row">

            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9 for_add_aboutus_bg h_100vh-s mx-auto">
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="for_aboutus_text">
                            <p>
                                Confidentiality 
                            </p>



                            <!--After Nav Services Page Start !-->
                            <div class="container-fluid">
                                <div class="for_about_us_text_dummy">
                                    <p>
                                        Each party acknowledges that, whether by virtue of and in the course of this Agreement or otherwise, it may receive or otherwise become aware of information relating to the other party, their marketing plans, their clients, customers, businesses, business plans, finances, technology or affairs, which is proprietary and confidential to the other party (“Confidential Information”). 
                                    </p>
                                </div>
                                <div class="for_dummy_text_specific">
                                    <p>
                                        Each party undertakes to maintain and procure the maintenance of the confidentiality of Confidential Information at all times and to keep and procure the keeping of all Confidential Information secure and protected against theft, damage, loss or unauthorised access, and not at any time, whether during the term of this Agreement or at any time thereafter, without the prior written consent of the owner of the Confidential Information, directly or indirectly, use, disclose, exploit, copy or modify any Confidential Information, or authorise or permit any third party to do the same, other than for the sole purpose of the performance of its rights and obligations hereunder. 
                                    </p>
                                </div>
                                <div class="for_dummy_text_specific">
                                    <p>The terms of and obligations imposed by this Section 20 shall not apply to any Confidential Information which: </p>
                                    <ul>
                                        <li>at the time of receipt by the recipient is in the public domain; </li>
                                        <li>subsequently comes into the public domain through no fault of the recipient, its officers, employees or agents;</li>
                                        <li>is lawfully received by the recipient from a third party on an unrestricted basis; or</li>
                                        <li>is already known to the recipient before receipt hereunder.</li>
                                    </ul>
                                    <p>The recipient may disclose Confidential Information in confidence to a professional adviser of the recipient or if it is required to do so by law, regulation or order of a competent authority. This Clause shall survive the termination or expiry of this Agreement.</p>
                                </div>
        
                               
                              
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
@endsection