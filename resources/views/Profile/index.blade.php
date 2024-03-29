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
    <link rel="stylesheet" href="{{ asset('assets/css/admin_css/past_appointments.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/admin_css/profile_page.css') }}">

    <title>Profile</title>
    <style>
        .pic:hover {
            background-image: url("AssideBar/asside_bar_assets/images/Grouphover.svg");
            /* background-color: red; */

            margin-left: 15px;
            height: 75px;
            width: 97%;



        }


        @media (min-width: 768px) and (max-width: 1024px) {
            .pic:hover {
                background-image: url("AssideBar/asside_bar_assets/images/Grouphover.svg");
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
                background-image: url("AssideBar/asside_bar_assets/images/Grouphover.svg");
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
            <div class="col-xxl-10 col-xl-10 col-lg-10 col-md-10 col-sm-9 col-9 for_add_aboutus_bg">


                <!-- <div class="">
                      <span>All Appointments</span>
                    <span class="pull-right">

                    </span>

                </div> -->
                <div class="row">
                    <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                        <div class="for_aboutus_text">


                            <div>

                                <span class="pull-right">
                                    @include('includes.saloon_dashboard.nav-bar',['id'=>$id , 'updateProfile'=>$profile])

                                </span>
                            </div>

                         <br />
                         <br />
                            <!--After Nav Services Page Start !-->
                            {{-- {{ dd($profile, date('h:i A', strtotime($profile->start_time)) ) }} --}}
                            <div class="container-fluid">

                                    @if(null != $profile->brosche)
                                        <div class="for_profile_main_img">
                                            <img src="{{ asset('/'.$profile->brosche[0]->path) }} " class="img-fluid w-100 h_493px-s" alt="...">
                                        </div>
                                    @else
                                        <div class="pt-5 for_upload_img_set_h_w">
                                            <img src="{{ asset('assets/images/saloon_dashboard_images/Rectangle 195.svg') }}  " class="img-fluid " alt="..."> <span>
                                        </div>

                                    @endif


                                {{-- <div class="for_profile_main_img">
                                    <img src="{{ asset('assets/images/saloon_dashboard_images/Rectangle 195.svg') }} "
                                        class="img-fluid " alt="...">

                                </div> --}}


                                {{-- <div class="upload_img_profile_main text-center">
                                    <button type="button" class="btn btn-outline-warning px-5 shadow-lg rounded">
                                        <i class="fa fa-upload" aria-hidden="true"></i>
                                        <span>
                                            Upload Image
                                        </span>
                                    </button>
                                </div> --}}


                                <div class="row">
                                    <div class="xol-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">

                                        <div class="row justify-content-center ">
                                        @if(null != $profile->brosche)
                                            {{-- {{ dd($updateProfile->brosche) }} --}}
                                                @foreach (array_slice($profile->brosche, 1,5) as $brosche)
                                                <div class="col-2 px-0">
                                                    <div class="pt-5 for_upload_img_set_h_w px-2 overflow_auto-s">
                                                        <div>
                                                            <img src=" {{ asset('assets/images/saloon_dashboard_images/group 152.svg') }} "
                                                            class="img-fluid for_cancel_icon_in_profile  " alt="...">
                                                        </div>
                                                        <div>
                                                            <img src="{{ asset('/'.$brosche->path) }}" class="img-fluid w_h_120px-s " alt="...">
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @else

                                            <div class="pt-5 for_upload_img_set_h_w">
                                                    <img src="{{ asset('assets/images/saloon_dashboard_images/Rectangle 260.svg') }}" class="img-fluid " alt="..."> <span>
                                                    <img src="{{ asset('assets/images/saloon_dashboard_images/Group 152.svg')}}" class="img-fluid for_cancel_icon_in_profile  "  alt="...">
                                            </div>

                                            @endif




                                            {{-- <div class="pt-5 for_upload_img_set_h_w">
                                                <img src="{{ asset('assets/images/saloon_dashboard_images/Rectangle 260.svg') }}"
                                                    class="img-fluid " alt="...">
                                                <span>
                                                    <img src=" {{ asset('assets/images/saloon_dashboard_images/Group 152.svg') }} "
                                                        class="img-fluid for_cancel_icon_in_profile  " alt="...">
                                                </span>


                                            </div> --}}
                                        </div>

                                    </div>


                                    <!-- Start Second Div -->
                                    <div class="row for_salon_infor">
                                        <p>Salon Information</p>
                                        <div class="xol-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-10 col-12">

                                            <div class="for_common_email_pass pt-4">
                                                <span>Name</span>
                                                <div class="input-group mb-3 w-75 border-bottom">
                                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                                    <input class="inp" placeholder="David Miller"
                                                        value="{{ $profile->name ?? '' }}" disabled />
                                                </div>
                                            </div>
                                        </div>

                                        <div class="xol-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

                                            <div class="for_common_email_pass pt-4">
                                                <span>Email Address</span>
                                                <div class="input-group mb-3 w-75 border-bottom">
                                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                                    <input class="inp" placeholder="abcd@gmail.com"
                                                        value="{{ $profile->email ?? '' }}" disabled />
                                                </div>
                                            </div>
                                        </div>



                                        <div class="xol-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

                                            <div class="for_common_email_pass pt-4">
                                                <span>Phone</span>
                                                <div class="input-group mb-3 w-75 border-bottom">
                                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                                    <input class="inp" placeholder="+ 000 0000 000"
                                                        value={{ $profile->phone_code . $profile->phone_number ?? '' }}  disabled/>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="xol-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

                                            <div class="for_common_email_pass pt-4">
                                                <span>Location</span>
                                                <div class="input-group mb-3 w-75 border-bottom">
                                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                                    <input class="inp"  value="{{ $profile->address ?? '' }}"  disabled/>
                                                </div>
                                            </div>
                                        </div>

                                        <span>Timing</span>

                                        <div class="xol-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

                                            <div class="for_common_email_pass pt-4">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Opening
                                                        Timing</label>
                                                    <input type="email" class="form-control w-75"
                                                        class="exampleFormControlInput1" placeholder="9 AM"
                                                        value="{{ date('h:i A', strtotime($profile->start_time)) ?? '' }}" disabled>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="xol-xxl-6 col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">

                                            <div class="for_common_email_pass pt-4">
                                                <div class="mb-3">
                                                    <label for="exampleFormControlInput1" class="form-label">Closing
                                                        Timing</label>
                                                    <input type="email" class="form-control w-75"
                                                        class="exampleFormControlInput1" placeholder="11 PM"
                                                        value="{{ date('h:i A', strtotime($profile->end_time)) ?? '' }}" disabled>
                                                </div>
                                            </div>
                                        </div>


                                    </div>
                                    <!-- ENd Second Div -->

                                    {{-- {{ dd($profile->days) }} --}}

                                    <!-- Third Div Start -->
                                    <div class="row w-100 py-5 px-xl-5 mt-4 available_days-s">
                                            <div class="col-12 my-4">
                                                <h4>
                                                    <i class="fa fa-calendar-check-o week_calander-s" aria-hidden="true"></i>
                                                    <span class="weekdays_heading-s">Availability On Week..</span>
                                                </h4>
                                            </div>
                                            <div class="col-12 my-5 d-flex px-lg-2 px-0">

                                                        @if($profile->days != [])

                                                            @php
                                                            $saloon_chosen_days = [];
                                                            @endphp

                                                            @foreach ($profile->days as $saloon_day)
                                                                @php
                                                                    $saloon_days[] = $saloon_day->day;
                                                                @endphp

                                                            @endforeach

                                                            @php

                                                                $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

                                                            @endphp

                                                                @php
                                                                    $chosen_days=  array_diff($days, $saloon_days??[]);

                                                                @endphp

                                                                @foreach ($days as $day)
                                                                       @if(in_array($day, $chosen_days))

                                                                            <div class="days_circle-s white_border-s text-center  ">
                                                                                <input type="checkbox" name="days[]" data-parent="{{ $day }}" class="form-check-input opacity_0-s days_circle-d"  value="{{ $day }}"  id="{{ $day }}-d">
                                                                            </div>

                                                                            @if (!$loop->last)
                                                                                {{-- {{ dd('last') }} --}}
                                                                                <div class="days_lines-s mt-3"></div>
                                                                            @endif


                                                                            @else

                                                                            <div class="days_circle-s white_border-s text-center checked_days-s">
                                                                                <input type="checkbox" name="days[]" data-parent="{{ $day }}" class="form-check-input opacity_0-s days_circle-d " checked value="{{ $day }}"  id="{{ $day }}-d">
                                                                            </div>

                                                                            @if (!$loop->last)
                                                                                <div class="days_lines-s mt-3"></div>
                                                                            @endif
                                                                        @endif

                                                                @endforeach


                                                        @else
                                                                @php

                                                                    $days = ['monday','tuesday','wednesday','thursday','friday','saturday','sunday'];

                                                                @endphp

                                                                @foreach ($days as $day)
                                                                    <div class="days_circle-s white_border-s text-center ">
                                                                        <input type="checkbox" name="days[]" data-parent="{{ $day }}" class="form-check-input opacity_0-s days_circle-d"  id="{{ $day }}-d">
                                                                    </div>

                                                                    @if (!$loop->last)
                                                                        {{-- {{ dd('last') }} --}}
                                                                        <div class="days_lines-s mt-3"></div>
                                                                    @endif
                                                                @endforeach


                                                        @endif
                                            </div>

                                            <div class="col-12 text-white d-flex justify-content-between">
                                                @if($profile->days != [])
                                                    @foreach ($days as $day)

                                                        @if (in_array($day, $chosen_days))
                                                            <span id="{{ $day }}" class="text-white ">{{ ucfirst(trans($day)) }}</span>

                                                            @else

                                                            <span id="{{ $day }}" class="text-white text-color-s ">{{ ucfirst(trans($day)) }}</span>
                                                        @endif
                                                    @endforeach
                                                @else
                                                    @foreach ($days as $day)
                                                            <span id="{{ $day }}" class="text-white ">{{ ucfirst(trans($day)) }}</span>

                                                    @endforeach
                                                @endif

                                            </div>


                                        </div>
                                    </div>
                                    <!-- Third Div End -->


                                    <!-- Description -->
                                    <div class="pt-5">
                                        <div class="mb-3 ">
                                            <label for="exampleFormControlTextarea1"
                                                class="form-label profile_page_description_text">Description</label>
                                            <textarea class="form-control pt-5 mt-5 for_text_area"
                                                id="exampleFormControlTextarea1"
                                                rows="3" disabled>{{ $profile->description ?? '' }}</textarea>
                                        </div>
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

<script src="{{ asset('assets/js/profile_setting.js') }}"></script>

</body>

</html>
