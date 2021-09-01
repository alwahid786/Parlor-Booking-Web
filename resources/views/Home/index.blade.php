@extends('Master_layout.layout')


@section('content')


    <!--Home Bar Page Start !-->
    <div class="container pt-5">
        <div class="row">
            <div class="col-10 text-center">
                <div class=" for_tap_salon_css">
                    <h1>Top Salon</h1>
                    <hr class="mx-auto fg_mustard-s my-2" width="120">
                    <hr class="mx-auto fg_mustard-s mt-0" width="64">
                </div>

            </div>
            <div class="col-2 d-flex justify-content-end">
                <a href=""><span class="fg_mustard-s">View more<i class="fa fa-arrow-right" aria-hidden="true"></i></span></a>
            </div>
        </div>

        <div class="row ">
            <!-- <div class="border-0 rounded-circle shadow left_scroll-btn-s">
                <span class="  px-2 py-3 pull-left "><i class="fa fa-arrow-left m-0" aria-hidden="true"></i></span>
            </div>
            <div>
                <span class=""><i class="fa fa-arrow-right" aria-hidden="true"></i></span>
            </div>  -->

            <div class="col d-flex salon_list-s">
                @foreach ($allSalons as $salon)
                    {{-- {{ dd($salon) }} --}}
                    <div class="row px-1 ">
                        <div class="col">
                            <div class="card border-0">
                                <div class="position-absolute discount_ticket-s">
                                    <img src=" {{ asset('assets/images/home_page_component/absolute_second.svg') }} " class="img-fluid " width="100"  alt="...">
                                    <div class="position-absolute discount_text-s">
                                        <h6 class="mb-0  text-white">Discount</h6>
                                        <span class=" text-white fs_9px-s">{{ $salon->offer == null ? 'O' : $salon->offer  }}</span>
                                    </div>
                                </div>
                                <div class="br_20px-s w_165px-s">
                                    <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}" class="card-img-top img-fluid br_20px-s" alt="...">
                                </div>
                                <div class="card-body px-0">
                                    <h4 class="text-break text-wrap">{{ $salon->name ?? '' }}</h4>
                                </div>
                            </div>
                            <div class="w_max_content-s">
                                <span class=""><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>{{ Str::limit($salon->description, 10, ' ...')  }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach

                {{-- <div class="row px-1 ">
                    <div class="col">
                        <div class="card border-0">
                            <div class="position-absolute discount_ticket-s">
                                <img src=" {{ asset('assets/images/home_page_component/absolute_second.svg') }} " class="img-fluid " width="100"  alt="...">
                                <div class="position-absolute discount_text-s">
                                    <h6 class="mb-0  text-white">Discount</h6>
                                    <span class=" text-white fs_9px-s">Up to 50% OFF</span>
                                </div>
                            </div>
                            <div class="br_20px-s w_165px-s">
                                <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}" class="card-img-top img-fluid br_20px-s" alt="...">
                            </div>
                            <div class="card-body px-0">
                                <h4 class="text-break text-wrap">GlitterUps</h4>
                            </div>
                        </div>
                        <div  class="w_max_content-s">
                            <span class=""><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>1681 Vine Street New York</span>
                        </div>
                    </div>
                </div>
                <div class="row px-1 ">
                    <div class="col">
                        <div class="card border-0">
                            <div class="position-absolute discount_ticket_2-s">
                                <img src=" {{ asset('assets/images/home_page_component/Blue_image_absolute.svg') }} " class="img-fluid " width="45"  alt="...">
                                <div class="position-absolute discount_text_2-s">
                                    <span class=" text-white text-break fs_9px-s">Big offer Buy 5 GET 1 FREE</span>
                                </div>
                            </div>
                            <div class="br_20px-s w_165px-s">
                                <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}" class="card-img-top img-fluid br_20px-s" alt="...">
                            </div>
                            <div class="card-body px-0">
                                <h4 class="text-break text-wrap">GlitterUps</h4>
                            </div>
                        </div>
                        <div  class="w_max_content-s">
                            <span class=""><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>1681 Vine Street New York</span>
                        </div>
                    </div>
                </div>
                <div class="row px-1 ">
                    <div class="col">
                        <div class="card border-0">
                            <div class="position-absolute discount_ticket-s">
                                <img src=" {{ asset('assets/images/home_page_component/absolute_second.svg') }} " class="img-fluid " width="100"  alt="...">
                                <div class="position-absolute discount_text-s">
                                    <h6 class="mb-0  text-white">Discount</h6>
                                    <span class=" text-white fs_9px-s">Up to 50% OFF</span>
                                </div>
                            </div>
                            <div class="br_20px-s w_165px-s">
                                <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}" class="card-img-top img-fluid br_20px-s" alt="...">
                            </div>
                            <div class="card-body px-0">
                                <h4 class="text-break text-wrap">GlitterUps</h4>
                            </div>
                        </div>
                        <div  class="w_max_content-s">
                            <span class=""><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>1681 Vine Street New York</span>
                        </div>
                    </div>
                </div>
                <div class="row px-1 ">
                    <div class="col">
                        <div class="card border-0">
                            <div class="position-absolute discount_ticket-s">
                                <img src=" {{ asset('assets/images/home_page_component/absolute_second.svg') }} " class="img-fluid " width="100"  alt="...">
                                <div class="position-absolute discount_text-s">
                                    <h6 class="mb-0  text-white">Discount</h6>
                                    <span class=" text-white fs_9px-s">Up to 50% OFF</span>
                                </div>
                            </div>
                            <div class="br_20px-s w_165px-s">
                                <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}" class="card-img-top img-fluid br_20px-s" alt="...">
                            </div>
                            <div class="card-body px-0">
                                <h4 class="text-break text-wrap">GlitterUps</h4>
                            </div>
                        </div>
                        <div  class="w_max_content-s">
                            <span class=""><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>1681 Vine Street New York</span>
                        </div>
                    </div>
                </div>
                <div class="row px-1 ">
                    <div class="col">
                        <div class="card border-0">
                            <div class="position-absolute discount_ticket_2-s">
                                <img src=" {{ asset('assets/images/home_page_component/Blue_image_absolute.svg') }} " class="img-fluid " width="45"  alt="...">
                                <div class="position-absolute discount_text_2-s">
                                    <span class=" text-white text-break fs_9px-s">Big offer Buy 5 GET 1 FREE</span>
                                </div>
                            </div>
                            <div class="br_20px-s w_165px-s">
                                <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}" class="card-img-top img-fluid br_20px-s" alt="...">
                            </div>
                            <div class="card-body px-0">
                                <h4 class="text-break text-wrap">GlitterUps</h4>
                            </div>
                        </div>
                        <div  class="w_max_content-s">
                            <span class=""><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>1681 Vine Street New York</span>
                        </div>
                    </div>
                </div>
                <div class="row px-1 ">
                    <div class="col">
                        <div class="card border-0">
                            <div class="position-absolute discount_ticket-s">
                                <img src=" {{ asset('assets/images/home_page_component/absolute_second.svg') }} " class="img-fluid " width="100"  alt="...">
                                <div class="position-absolute discount_text-s">
                                    <h6 class="mb-0  text-white">Discount</h6>
                                    <span class=" text-white fs_9px-s">Up to 50% OFF</span>
                                </div>
                            </div>
                            <div class="br_20px-s w_165px-s">
                                <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}" class="card-img-top img-fluid br_20px-s" alt="...">
                            </div>
                            <div class="card-body px-0">
                                <h4 class="text-break text-wrap">GlitterUps</h4>
                            </div>
                        </div>
                        <div  class="w_max_content-s">
                            <span class=""><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>1681 Vine Street New York</span>
                        </div>
                    </div>
                </div>
                <div class="row px-1 ">
                    <div class="col">
                        <div class="card border-0">
                            <div class="position-absolute discount_ticket-s">
                                <img src=" {{ asset('assets/images/home_page_component/absolute_second.svg') }} " class="img-fluid " width="100"  alt="...">
                                <div class="position-absolute discount_text-s">
                                    <h6 class="mb-0  text-white">Discount</h6>
                                    <span class=" text-white fs_9px-s">Up to 50% OFF</span>
                                </div>
                            </div>
                            <div class="br_20px-s w_165px-s">
                                <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}" class="card-img-top img-fluid br_20px-s" alt="...">
                            </div>
                            <div class="card-body px-0">
                                <h4 class="text-break text-wrap">GlitterUps</h4>
                            </div>
                        </div>
                        <div  class="w_max_content-s">
                            <span class=""><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>1681 Vine Street New York</span>
                        </div>
                    </div>
                </div>
                <div class="row px-1 ">
                    <div class="col">
                        <div class="card border-0">
                            <div class="position-absolute discount_ticket_2-s">
                                <img src=" {{ asset('assets/images/home_page_component/Blue_image_absolute.svg') }} " class="img-fluid " width="45"  alt="...">
                                <div class="position-absolute discount_text_2-s">
                                    <span class=" text-white text-break fs_9px-s">Big offer Buy 5 GET 1 FREE</span>
                                </div>
                            </div>
                            <div class="br_20px-s w_165px-s">
                                <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}" class="card-img-top img-fluid br_20px-s" alt="...">
                            </div>
                            <div class="card-body px-0">
                                <h4 class="text-break text-wrap">GlitterUps</h4>
                            </div>
                        </div>
                        <div  class="w_max_content-s">
                            <span class=""><span><i class="fa fa-map-marker" aria-hidden="true"></i></span>1681 Vine Street New York</span>
                        </div>
                    </div>
                </div> --}}
            </div>

        </div>



            <!-- <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 ">
                <div class="___class_+?19___">


                    <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}"
                        class="card-img-top for_firts_div_card_first mt-4 img-fluid" alt="...">

                    <img src="{{ asset('assets/images/home_page_component/absolute_second.svg') }}"
                        class="img-fluid discount_img" alt="...">
                    <span class="discount_text_css">Discount <br>
                        <span class="up_to_fifty_percent">Up to 50 %</span>
                    </span>
                    <div class="card-body for_card_body_ml">

                        <h6 class="for_glitter_ups_css">GlitterUps</h6>
                        <p class="card-text "> <span><i class="fa fa-map-marker" aria-hidden="true"></i></span> <span
                                class="css_for_1681_vine">1681 Vine Street New York</span> </p>





                    </div>



                </div>
            </div> -->

            <!-- <<div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 ">
                <div class="___class_+?30___">


                    <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}"
                        class="card-img-top for_firts_div_card_first mt-4 img-fluid" alt="...">

                    <img src="{{ asset('assets/images/home_page_component/Blue_image_absolute.svg') }}"
                        class="img-fluid getone_free_img" alt="...">
                    <span class="buyone_getone_Big_css">Big <br>
                        <span class="buyone_getone_Offer_css">Offer</span>
                        <br>
                        <span class="buyone_Buy_Offer_css">Buy</span>
                        <br>
                        <span>5</span><br>
                        <span>GET 1</span><br>
                        <span>FREE</span>
                    </span>
                    <div class="card-body for_card_body_ml">

                        <h6 class="for_glitter_ups_css">GlitterUps</h6>
                        <p class="card-text "> <span><i class="fa fa-map-marker" aria-hidden="true"></i></span> <span
                                class="css_for_1681_vine">1681 Vine Street New York</span> </p>





                    </div>



                </div>
            </div>

            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 ">
                <div class="___class_+?42___">
                    <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}"
                        class="card-img-top for_firts_div_card_first mt-4 img-fluid" alt="...">
                    <div class="card-body for_card_body_ml">

                        <h6 class="for_glitter_ups_css">GlitterUps</h6>
                        <p class="card-text"> <span><i class="fa fa-map-marker" aria-hidden="true"></i></span> <span
                                class="css_for_1681_vine">1681 Vine Street New York</span> </p>





                    </div>



                </div>
            </div>


            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 ">
                <div class="___class_+?50___">
                    <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}"
                        class="card-img-top for_firts_div_card_first mt-4 img-fluid" alt="...">
                    <div class="card-body for_card_body_ml">

                        <h6 class="for_glitter_ups_css">GlitterUps</h6>
                        <p class="card-text"> <span><i class="fa fa-map-marker" aria-hidden="true"></i></span> <span
                                class="css_for_1681_vine">1681 Vine Street New York</span> </p>





                    </div>



                </div>
            </div>


            <div class="col-xxl-2 col-xl-2 col-lg-2 col-md-4 col-sm-6 col-6 ">
                <div class="___class_+?58___">
                    <div>
                        <span class="dot pull-left for_arrow_left"><i class="fa fa-arrow-right"
                                aria-hidden="true"></i></span>
                    </div>
                    <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}"
                        class="card-img-top for_firts_div_card_first mt-4 img-fluid" alt="...">
                    <div class="card-body for_card_body_ml">

                        <h6 class="for_glitter_ups_css">GlitterUps</h6>
                        <p class="card-text"> <span><i class="fa fa-map-marker" aria-hidden="true"></i></span> <span
                                class="css_for_1681_vine">1681 Vine Street New York</span> </p>





                    </div>



                </div>
            </div>  -->






    </div>
    <!--Home Bar Page End !-->





    <!-- After navBar Third -->
    <div class="container pt-5">
        <!-- height: 35px;
                width: 35px;
                background-color: #f5b51b;
                border-radius: 50%;
                display: inline-block;
                position: absolute;
                top: 175px;
                margin-left: 3px; -->
                <div class="row">
                    <div class="col-10 text-center">
                        <div class=" for_tap_salon_css">
                            <h1>Tap Salon</h1>
                            <hr class="mx-auto fg_mustard-s my-2" width="120">
                            <hr class="mx-auto fg_mustard-s mt-0" width="64">
                        </div>

                    </div>
                    <div class="col-2 d-flex justify-content-end">
                        <a href=""><span class="fg_mustard-s">View more<i class="fa fa-arrow-right" aria-hidden="true"></i></span></a>
                    </div>

                </div>



        <div class="row for_after_nav_second_css">
            @foreach ($salonsNearByMe as $salon)
                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4  col-12 ">
                    <div class="card border-0">
                        <div class="position-absolute discount_large_ticket-s">
                            <img src="{{ asset('assets/images/home_page_component/absolute_second.svg') }}"class="img-fluid  " alt="...">
                            <div class="position-absolute text-white discount_large_text-s">
                                <h6 class="mb-0">Discount</h6>
                                <span class="up_to_fifty_percent">{{ $salon->offer == null ? 'O' : $salon->offer  }}</span>
                            </div>


                            </span>
                        </div>
                        <div>
                            <a href="UserSide/HomePageComponent/salons_child_one.php">
                                <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}" class="card-img-top  mt-4 img-fluid" alt="...">
                            </a>
                        </div>


                        <div class="card-body for_card_body_mll">

                            <h6 class="for_glitter_ups_csss">{{ $salon->name ?? '' }}</h6>
                            <p class="card-text ">
                                <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                <span  class="css_for_1681_vinee">{{ Str::limit($salon->description, 10, ' ...')  }}</span>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach

{{--
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-12 ">

                <div class="card border-0">
                    <div class="position-absolute discount_large_ticket-s">
                        <img src="{{ asset('assets/images/home_page_component/absolute_second.svg') }}"class="img-fluid  " alt="...">
                        <div class="position-absolute text-white discount_large_text-s">
                            <h6 class="mb-0">Discount</h6>
                            <span class="up_to_fifty_percent">Up to 50% OFF</span>
                        </div>


                        </span>
                    </div>
                    <div>
                        <a href="UserSide/HomePageComponent/salons_child_one.php">
                            <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}" class="card-img-top  mt-4 img-fluid" alt="...">
                        </a>
                    </div>


                    <div class="card-body for_card_body_mll">

                        <h6 class="for_glitter_ups_csss">GlitterUps</h6>
                        <p class="card-text ">
                            <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                             <span  class="css_for_1681_vinee">1681 Vine Street New York</span>
                        </p>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-12 ">

                    <div class="card border-0">
                        <div class="position-absolute discount_large_ticket2-s">
                            <img src="{{ asset('assets/images/home_page_component/Blue_image_absolute.svg') }}" class="img-fluid h_126px-s " alt="...">
                            <div class="position-absolute discount_large_text2-s text-white">
                                <span class="">Big <br>
                                    <span class="">Offer</span>
                                    <br>
                                    <span class="">Buy</span>
                                    <br>
                                    <span>5</span><br>
                                    <span>GET 1</span><br>
                                    <span>FREE</span>
                                </span>
                            </div>
                        </div>
                        <div>
                            <a href="UserSide/HomePageComponent/salons_child_one.php">
                                <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}" class="card-img-top  mt-4 img-fluid" alt="...">
                            </a>
                        </div>

                        <div class="card-body for_card_body_mll">
                            <h6 class="for_glitter_ups_csss">GlitterUps</h6>
                            <p class="card-text ">
                                <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                 <span class="css_for_1681_vinee">1681 Vine Street New York</span>
                            </p>
                        </div>
                    </div>

            </div> --}}

            {{-- <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6 col-6 ">

                <div class="card border-0">
                        <div class="position-absolute discount_large_ticket2-s">
                            <img src="{{ asset('assets/images/home_page_component/Blue_image_absolute.svg') }}" class="img-fluid h_126px-s " alt="...">
                            <div class="position-absolute discount_large_text2-s text-white">
                                <span class="">Big <br>
                                    <span class="">Offer</span>
                                    <br>
                                    <span class="">Buy</span>
                                    <br>
                                    <span>5</span><br>
                                    <span>GET 1</span><br>
                                    <span>FREE</span>
                                </span>
                            </div>
                        </div>
                        <div>
                            <a href="UserSide/HomePageComponent/salons_child_one.php">
                                <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}" class="card-img-top  mt-4 img-fluid" alt="...">
                            </a>
                        </div>

                        <div class="card-body for_card_body_mll">
                            <h6 class="for_glitter_ups_csss">GlitterUps</h6>
                            <p class="card-text ">
                                <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                 <span class="css_for_1681_vinee">1681 Vine Street New York</span>
                            </p>
                        </div>
                    </div>

                </div>

        </div> --}}

    </div>
    <!--Home Bar Page End !-->


    <!-- Modal Salon And Home Bar Start -->

    <div class="modal " id="modelpagefive">
        <div class="modal-dialog">
            <div class="modal-content modal-lg for_modal_bg">

                <!-- Modal Header -->


                <div class="modal-body ">

                    <div class="pull-right text-end">
                        <img src="{{ asset('assets/images/home_page_component/Group 152.svg') }} "
                            class="img-fluid for_modal_cancel_img_my_appointments  " data-dismiss="modal"
                            aria-label="Close" alt="...">


                    </div>
                    <div class="text-end pull-right for_modal_icon_pagefive">
                        <span>
                            <i class="fa fa-angle-left" aria-hidden="true"></i>
                            <span>
                                <i class="fa fa-angle-right" aria-hidden="true"></i>
                            </span>
                        </span>
                    </div>

                    <div>
                        <img src="{{ asset('assets/images/home_page_component/Ellipse 36.svg') }} "
                            class="img-fluid  for_modal_img_radius " alt="...">


                    </div>
                    <div class="text-end for_clock_celender_icon">
                        <i class="fa fa-clock-o clock_icon_css" aria-hidden="true">
                            <span> 9:00 am </span>
                            <i class="fa fa-calendar" aria-hidden="true">
                                <span> 20/05/2020 </span>
                            </i>
                        </i>
                    </div>

                    <div class="for_spa_text_css">
                        <p>
                            Spa
                            <span class="text-end pull-right">$13</span>
                        </p>

                        <p class="for_mt_spa_text_etc">
                            Spa
                            <span class="text-end pull-right">$13</span>
                        </p>

                        <p class="for_mt_spa_text_etc">
                            Spa
                            <span class="text-end pull-right">$13</span>
                        </p>

                        <p class="for_mt_spa_text_etc">
                            Spa
                            <span class="text-end pull-right">$13</span>
                        </p>
                    </div>

                    <div class="for_discount">
                        <p>Discount
                            <span class="pull-right">30%</span>
                        </p>

                    </div>

                    <div class="for_discount">
                        <p>Discount
                            <span class="pull-right">30%</span>
                        </p>

                    </div>



                </div>





            </div>
        </div>
    </div>
    <!-- Modal Salon And Home Bar End -->







@endsection
