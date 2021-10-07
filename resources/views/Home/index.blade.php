@extends('Master_layout.layout')


@section('content')


    <!--Home Bar Page Start !-->
    <div class="container-fluid px-5 mt-3 py-5 bg_grey-s">
        <div class="row px-xl-5">
            <div class="col-lg-10 col-9 text-center">
                <div class=" for_tap_salon_css ms-5 ps-5">
                    <h1>Top Salon</h1>
                    <hr class="mx-auto fg_mustard-s my-2" width="120">
                    <hr class="mx-auto fg_mustard-s mt-0" width="64">
                </div>

            </div>
            <div class="col-lg-2 col-3 d-flex justify-content-end">
                    <a href="{{ route('allSalons') }}"><span class="fg_mustard-s">View more<i class="fa fa-arrow-right"
                                aria-hidden="true"></i></span></a>

            </div>
        </div>

        <div class="row px-xl-5">
            <div class="col d-flex salon_list-s">
                @foreach ($allSalons as $salon)
                    <div class="row px-1 ">
                        <div class="col">
                            <div class="card border-0 bg_grey-s">
                                <div class="position-absolute discount_ticket-s">
                                    <img src=" {{ asset('assets/images/home_page_component/absolute_second.svg') }} "
                                        class="img-fluid " width="100" alt="...">
                                    @if(isset($salon->offer->discount))
                                            <div class="position-absolute discount_text-s">
                                                <h6 class="mb-0  text-white">Discount</h6>
                                                <span class=" text-white fs_9px-s">
                                                    {{ $salon->offer->discount }}
                                                </span>
                                            </div>
                                        @else
                                            <div class="position-absolute discount_text-s">
                                                <h6 class="mb-0  text-white">Discount</h6>
                                                <span class=" text-white fs_9px-s">
                                                    0
                                                </span>
                                            </div>
                                        @endif
                                </div>
                                <div class="br_20px-s w_165px-s">
                                    <img src="{{ asset('assets/images/home_page_component/salon_1.jpg') }}"
                                        class="card-img-top img-fluid br_20px-s" alt="...">
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
    <div class="container-fluid px-5 mt-3 py-5">

            <div class="row px-xl-5">
                <div class="col-lg-10 col-9 text-center">
                    <div class=" for_tap_salon_css ms-5 ps-5">
                        <h1> Salon Near by me</h1>
                        <hr class="mx-auto fg_mustard-s my-2" width="120">
                        <hr class="mx-auto fg_mustard-s mt-0" width="64">
                    </div>

                </div>
                <div class="col-lg-2 col-3 d-flex justify-content-end">
                    <a href="{{ route('allSalons') }}"><span class="fg_mustard-s">View more<i class="fa fa-arrow-right"
                                aria-hidden="true"></i></span></a>

                </div>

            </div>

            <div class="row for_after_nav_second_css px-xl-5">
                @foreach ($salonsNearByMe as $salon)
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4  col-12 ">
                        <div class="card border-0">
                            <div class="position-absolute discount_large_ticket-s">
                                <img src="{{ asset('assets/images/home_page_component/absolute_second.svg') }}"
                                    class="img-fluid  " alt="...">
                               @if(isset($salon->offer->discount))
                                        <div class="position-absolute discount_text-s">
                                            <h6 class="mb-0  text-white">Discount</h6>
                                            <span class=" text-white fs_9px-s">
                                                {{ $salon->offer->discount }}
                                            </span>
                                        </div>
                                    @else
                                        <div class="position-absolute discount_text-s">
                                            <h6 class="mb-0  text-white">Discount</h6>
                                            <span class=" text-white fs_9px-s">
                                                0
                                            </span>
                                        </div>
                                    @endif
                            </div>
                            <div>
                                {{-- <a href="#"> --}}
                                    <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}"
                                        class="card-img-top  mt-4 img-fluid" alt="...">
                                {{-- </a> --}}
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
            </div>

        <!--Home Bar Page End !-->

        @include('Modals.salon_services', [$salon ??'']);
    </div>
@endsection
