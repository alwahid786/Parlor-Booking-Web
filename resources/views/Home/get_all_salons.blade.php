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

        </div>

        <div class="row ">
            <div class="col d-flex salon_list-s">
                @foreach ($allSalons as $salon)
                    {{-- {{ dd($salon) }} --}}
                    <div class="row px-1 ">
                        <div class="col">
                            <div class="card border-0">
                                <div class="position-absolute discount_ticket-s">
                                        <img src=" {{ asset('assets/images/home_page_component/absolute_second.svg') }} "class="img-fluid " width="100" alt="...">

                                    <div class="position-absolute discount_text-s">
                                        <h6 class="mb-0  text-white">Discount</h6>
                                        <span
                                            class=" text-white fs_9px-s">{{ $salon->offer == null ? 'O' : $salon->offer }}</span>
                                    </div>
                                </div>
                                <div class="br_20px-s w_165px-s">
                                    <a href="{{ route('bookingSalon', $salon->uuid) }}">
                                        <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}"
                                            class="card-img-top img-fluid br_20px-s" alt="...">
                                    </a>

                                </div>
                                <div class="card-body px-0">
                                    <h4 class="text-break text-wrap">{{ $salon->name ?? '' }}</h4>
                                </div>
                            </div>
                            <div class="w_max_content-s">
                                <span class="___class_+?29___"><span><i class="fa fa-map-marker"
                                            aria-hidden="true"></i></span>{{ Str::limit($salon->description, 10, ' ...') }}</span>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

        </div>
    </div>
    <!--Home Bar Page End !-->

    <!-- After navBar Third -->
    {{-- <div class="container pt-5">

            <div class="row">
                <div class="col-10 text-center">
                    <div class=" for_tap_salon_css">
                        <h1> Salon Near by me</h1>
                        <hr class="mx-auto fg_mustard-s my-2" width="120">
                        <hr class="mx-auto fg_mustard-s mt-0" width="64">
                    </div>

                </div>
                <div class="col-2 d-flex justify-content-end">
                    <a href="{{ route('allSalons') }}"><span class="fg_mustard-s">View more<i class="fa fa-arrow-right"
                                aria-hidden="true"></i></span></a>

                </div>

            </div> --}}

            {{-- <div class="row for_after_nav_second_css">
                @foreach ($salonsNearByMe as $salon)
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4  col-12 ">
                        <div class="card border-0">
                            <div class="position-absolute discount_large_ticket-s">
                                <img src="{{ asset('assets/images/home_page_component/absolute_second.svg') }}"
                                    class="img-fluid  " alt="...">
                                <div class="position-absolute text-white discount_large_text-s">
                                    <h6 class="mb-0">Discount</h6>
                                    <span
                                        class="up_to_fifty_percent">{{ $salon->offer == null ? 'O' : $salon->offer }}</span>
                                </div>


                                </span>
                            </div>
                            <div>
                                <a href="UserSide/HomePageComponent/salons_child_one.php">
                                    <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}"
                                        class="card-img-top  mt-4 img-fluid" alt="...">
                                </a>
                            </div>


                            <div class="card-body for_card_body_mll">

                                <h6 class="for_glitter_ups_csss">{{ $salon->name ?? '' }}</h6>
                                <p class="card-text ">
                                    <span><i class="fa fa-map-marker" aria-hidden="true"></i></span>
                                    <span
                                        class="css_for_1681_vinee">{{ Str::limit($salon->description, 10, ' ...') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div> --}}

        <!--Home Bar Page End !-->

        @include('Modals.salon_services', [$salon]);
    </div>
@endsection