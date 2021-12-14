@extends('Master_layout.layout')


@section('content')


    <!--Home Bar Page Start !-->
    <div class="container-fluid px-5  py-5 bg_grey-s">
        <div class="row px-xl-5">
            <div class="col-lg-10 col-9 text-center">
                <div class=" for_tap_salon_css ms-sm-5 ps-sm-5">
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
        <div class="row">

           @if(isset($allSalons))
                @foreach ($allSalons as $key => $salon)
                @if ($key < 8)
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4  col-12 ">
                        <div class="card border-0 bg_grey-s">
                            <div class="position-absolute discount_large_ticket-s ">
                                <a href="javascript:void(0)">
                                    <img src="{{ asset('assets/images/home_page_component/absolute_second.svg') }}"
                                        class="img-fluid  " alt="...">
                                    @if (isset($salon->offer->discount))
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
                                </a>
                            </div>
                            <div class="br_20px-s overflow-hidden h_380px-s img-hover-zoom">
                                <a href="javascript:void(0)">
                                    @if (isset($salon) && !empty($salon))
                                        @if (!empty($salon->brosche))
                                            <img src="{{ asset($salon->brosche[0]->path) }}"
                                                class="card-img-top  img-fluid object_fit_cover-s" alt="...">
                                        @else

                                            <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}"
                                                class="card-img-top  img-fluid object_fit_cover-s" alt="...">
                                        @endif
                                    @endif
                                </a>
                            </div>


                            <div class="card-body mb-5 p-0 for_card_body_mll">

                                <a href="javascript:void(0)">
                                    <h6 class="for_glitter_ups_csss mt-2 mb-0">{{ $salon->name ?? '' }}</h6>
                                    <p class="card-text ">
                                        <span><i class="fa fa-map-marker m-0" aria-hidden="true"></i></span>
                                        <span
                                            class="css_for_1681_vinee">{{ Str::limit($salon->description, 20, ' ...') }}</span>
                                    </p>
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
           @endif
        </div>

    </div>


    <!--Home Bar Page End !-->



    <!-- After navBar Third -->



    <div class="container-fluid  mt-3 py-5 bg_grey-s">

        <div class="row px-xl-5">
            <div class="col-lg-10 col-9 text-center">
                <div class=" for_tap_salon_css ms-sm-5 ps-sm-5">
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



        <div class="row  px-xl-5" id="nearBySaloon">
            {{-- @if (isset($salonsNearByMe) && !empty($salonsNearByMe))
                @foreach ($salonsNearByMe as $salon)
                    <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4  col-12 ">
                        <div class="card border-0 bg_grey-s">
                            <div class="position-absolute discount_large_ticket-s ">
                                <img src="{{ asset('assets/images/home_page_component/absolute_second.svg') }}"
                                    class="img-fluid  " alt="...">
                                @if (isset($salon->offer->discount))
                                    <div class="position-absolute discount_text-s">
                                        <h6 class="mb-0  text-white">Discount</h6>
                                        <span class=" text-white fs_9px-s">
                                            {{ $salon->offer->discount  ?? ''}}
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
                            <div class="br_20px-s overflow-hidden h_380px-s img-hover-zoom">
                                @if (isset($salon) && !empty($salon))
                                    @if (!empty($salon->brosche))
                                        <img src="{{ asset($salon->brosche[0]->path) }}"
                                            class="card-img-top  img-fluid object_fit_cover-s" alt="...">
                                    @else

                                        <img src="{{ asset('assets/images/home_page_component/placeholder11.svg') }}"
                                            class="card-img-top  img-fluid object_fit_cover-s" alt="...">
                                    @endif
                                @endif
                            </div>


                            <div class="card-body mb-5 p-0 for_card_body_mll">

                                <h6 class="for_glitter_ups_csss mt-2 mb-0">{{ $salon->name ?? '' }}</h6>
                                <p class="card-text ">
                                    <span><i class="fa fa-map-marker m-0" aria-hidden="true"></i></span>
                                    <span class="css_for_1681_vinee">{{ Str::limit($salon->description, 10, ' ...') }}</span>
                                </p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif --}}
            <h4 class="text-center message_d">No Near By Saloon Found</h4>
        </div>
        @if (isset($salon))
            @include('Modals.salon_services', [$salon ?? ''])
        @endif
    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        
        let public_path = "{{config('app.url').'/public/'}}";


        $(document).ready(function() {
            window.onload = function() {
                getLocation();
            };

            var x = document.getElementById("demo");

            function getLocation() {
                if (navigator.geolocation) {
                    navigator.geolocation.getCurrentPosition(showPosition);
                } else {
                    x.innerHTML = "Geolocation is not supported by this browser.";
                }
            }

            function showPosition(position) {
                // console.log(position.coords.latitude, position.coords.longitude);


                lat = position.coords.latitude;
                long = position.coords.longitude;
                console.log(lat,long);
                
                // return false;
                if (null != lat && null != long) {
                    $.ajax({
                        url: '{{ route('home') }}',
                        method: 'GET',
                        type: 'GET',
                        success:'success',
                        data: {
                            lat: lat,
                            long: long
                        },
                        dataType: 'json',
                        success: function(response) {
                            if(response.status == true){
                                // debugger
                                
                                console.log(response);
                                console.log(response.status);
                                console.log(response.data);
                                var new_data = new Array();
                                new_data = response.data;
                                console.log(new_data);

                                $(new_data).each(function(i,e){

                                    let salon_name = e.salon_name;
                                    let user_address = e.user_address;
                                    let offer_discount = e.offer_discount;

                                    if(user_address.length > 10) 
                                    user_address = user_address.substring(0,20)+'....';

                                    if(user_address  == null){
                                        user_address == '';
                                    }
                                    console.log(user_address,'description length');                                    
                                    let brosches_path = e.brosches_path;
                                    if(null == brosches_path)
                                        {
                                           brosches_path = "assets/images/home_page_component/placeholder11.svg";   
                                        }
                                    if(offer_discount == null){
                                        offer_discount = "0";
                                    }

                                    let div = `
                                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4  col-12 ">
                                                    <div class="card border-0 bg_grey-s">
                                                        <div class="position-absolute discount_large_ticket-s ">
                                                            <img src=${public_path}assets/images/home_page_component/absolute_second.svg 
                                                                class="img-fluid  " alt="...">
                                                                <div class="position-absolute discount_text-s">
                                                                    <h6 class="mb-0  text-white">Discount</h6>
                                                                    <span class=" text-white fs_9px-s">
                                                                        ${offer_discount}
                                                                    </span>
                                                                </div>
                                                        </div>
                                                        <div class="br_20px-s overflow-hidden h_380px-s img-hover-zoom">
                                                            <img src="${public_path}${brosches_path}"
                                                                class="card-img-top  img-fluid object_fit_cover-s" alt="...">
                                                        </div>


                                                        <div class="card-body mb-5 p-0 for_card_body_mll">

                                                            <h6 class="for_glitter_ups_csss mt-2 mb-0">${salon_name}</h6>
                                                            <p class="card-text ">
                                                                <span><i class="fa fa-map-marker m-0" aria-hidden="true"></i></span>
                                                                <span class="css_for_1681_vinee">${user_address}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                `
                                        $("#nearBySaloon").append(div);

                                })

                                $(".message_d").addClass('d-none');
                                // console.log(JSON.stringify(response));


                                // debugger;
                            }
                            
                        }
                    })
                }


            }
        });
    </script>
@endsection
