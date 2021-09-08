@extends('Master_layout.layout')


@section('content')
    {{-- {{ dd($saloon_service) }}

    "id": 6
    +"uuid": "c267cb65-fa6c-4b97-a8b0-58a37efaf7da"
    +"salon_id": 9
    +"name": "makeup face"
    +"price": 1000
    +"slot": null
    +"status": "active"
    +"time": null
    +"created_at": "2021-09-03T11:37:45.000000Z"
    +"updated_at": "2021-09-03T11:37:45.000000Z"
    +"deleted_at": null --}}

    <div class="container">
    <!-- <div class="booking_now_child_two_actual_price">
     <div class="for_bg_actual_price">
     <p>
             Actual Price
            <span class=" pull-right">
                 $30
            </span>
        </p>
     </div> -->
     <div class="bg_booking_now_text">
        <p>
            Actual Price
            <span class="pull-right">
                {{-- ${{ $saloon_service->sum('total_price') }} --}}

            </span>
        </p>
        <p>
            Actual Price
            <span class="pull-right">
                $30

            </span>
        </p>
        <p class="for_border_none_actual_price">
            Actual Price
            <span class="pull-right">
                $30

            </span>
        </p>
     </div>
    </div>

</div>
    <!-- Booking Now Salon Child Two Div One  End -->


    <!-- Boking Now Salon Child Three Div Second Start -->
    <div class="for_third_main container">
        <div class="row for_main_row_appointment ">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="">
                                            <div class=" card-body beauty_salon_services">
                    <h5>Beauty Salon </h5>
                    <h5 class="for_services_text_css">Services</h5>
                    <p>With supporting text below as a natural lead-in to additional content...</p>

                </div>

            </div>
        </div>

        @foreach ($saloon_service as $service)
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="card for_border_card_dashed" data-bs-toggle="modal" data-bs-target="#example"
                    onclick="javascript:myFunction1();" id="demo1">
                    <div class="card-body for_spa_text">
                        <h5 id="for_java_spa1">{{ $service->name }} </h5>

                        <p>{{ $service->description }}</p>
                        <h4>Price</h4>
                        <h4 class="for_20_text">${{ $service->price }}</h4>
                    </div>
                </div>
            </div>

        @endforeach

        {{-- <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
            <div class="card for_border_card_dashed for_facial_w" data-bs-toggle="modal" data-bs-target="#example"
                onclick="javascript:myFunction2();" id="demo2">
                <div class="card-body for_spa_text">
                    <h5 id="for_java_spa2">Facial </h5>

                    <p>With supporting text below as a natural lead-in to additional content...</p>
                    <h4>Price</h4>
                    <h4 class="for_20_text">$20</h4>
                </div>

            </div>
        </div> --}}

        </div>












        {{-- <div class="row for_main_row_appointment mt-3 ">
            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="card for_border_card_dashed" data-bs-toggle="modal" data-bs-target="#example"
                    onclick="javascript:myFunction3();" id="demo3">
                    <div class="card-body for_spa_text">
                        <h5 id="for_java_spa3">Spa </h5>

                        <p>With supporting text below as a natural lead-in to additional content...</p>
                        <h4>Price</h4>
                        <h4 class="for_20_text">$20</h4>
                    </div>

                </div>
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="card for_border_card_dashed" data-bs-toggle="modal" data-bs-target="#example"
                    onclick="javascript:myFunction4();" id="demo4">
                    <div class="card-body for_spa_text">
                        <h5 id="for_java_spa4">Spa </h5>

                        <p>With supporting text below as a natural lead-in to additional content...</p>
                        <h4>Price</h4>
                        <h4 class="for_20_text">$20</h4>
                    </div>

                </div>
            </div>

            <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                <div class="card for_border_card_dashed for_facial_w" data-bs-toggle="modal" data-bs-target="#example"
                    onclick="javascript:myFunction5();" id="demo5">
                    <div class="card-body for_spa_text">
                        <h5 id="for_java_spa5">Facial </h5>

                        <p>With supporting text below as a natural lead-in to additional content...</p>
                        <h4>Price</h4>
                        <h4 class="for_20_text">$20</h4>
                    </div>

                </div>
            </div>

        </div> --}}
    </div>


    <!-- Boking Now Salon Child Three Div Second End -->

    @if (Auth::user())
        <div class="text-center for_done_btn_css">
            <button type="button" class="btn btn-warning" id="book_modal-d">Done</button>
        </div>
    @else
        <div class="text-center for_done_btn_css">
            <button type="button" class="btn btn-warning" id="check_account_modal-d">Done</button>
        </div>
    @endif





    @include('UserBookModal.book_service_modal',[])
    @include('UserAuthModals.goto_signin_modal',[])
    @include('UserAuthModals.signup_socail_modal',[])
    @include('UserAuthModals.signin_modal',[]);
    @include('UserAuthModals.enter_code_modal',[])
    @include('UserAuthModals.signup_modal',[])
    @include('UserAuthModals.forgot_password_modal',[])
    @include('UserAuthModals.reset_password_modal',[])

@endsection



@section('footer-scripts')
    <script>
           // user routes
    let UserAppointments = "{{ route('userAppointments') }}"

    let SalonServices = "{{ route('bookingSalonServices')}}"
    </script>

@endsection
