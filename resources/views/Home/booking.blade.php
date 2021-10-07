@extends('Master_layout.layout')

@section('content')
    <!-- Salon Child One After Nav Start -->
    <div class="salons_child_one_div_one">
        <h1>Glitter Salon</h1>
        <p>
            Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's
            standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make
            a type specimen book.
        </p>
    </div>

    <!-- Salon Child One After Nav End -->

    <!-- Salon Child One After Nav Div Two Strat -->
    <div class="availability_on_week_bg">
        <div class="for_text_yellow_color p-5">

            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
            <span class="on_week_separate">Availability On Week</span>




            <div class="row for_over_flow">
                <div class="col-xxl-12  col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 for_col_12_child_one_dots">
                    <div class="col-12 my-5 d-flex px-lg-2 px-0">

                        {{--  {{ dd($salon_days) }}  --}}
                        @if ($salon_days != [])
                            @foreach ($salon_days as $available_day)
                                {{--  <li style="color:green" >{{ ucfirst(trans($available_day->day)) }}</li>  --}}

                                <div class="days_circle-s white_border-s text-center checked_days-s">
                                    <input type="checkbox" name="days[]" data-parent="{{ $available_day->day }}" class="form-check-input opacity_0-s days_circle-d " checked value="{{ $available_day->day }}"  id="{{ $available_day->day }}-d">
                                </div>

                                @if (!$loop->last)
                                    <div class="days_lines-s mt-3"></div>
                                @endif
                            @endforeach

                        @else
                                <h4>No Available Days</h4>
                        @endif

                    </div>



                    <div class="col-12 text-white d-flex ">
                        @if ($salon_days != [])

                        @foreach ($salon_days as $available_day)
                            <span id="{{ $available_day->day }}" class="text-white text-color-s mr_150px-s text-left ">{{ ucfirst(trans($available_day->day)) }}</span>
                        @endforeach

                        @else
                                {{--  <h4>No Available Days</h4>  --}}
                        @endif

                    </div>

                </div>
            </div>



        </div>
    </div>


    <div class="text-center for_booking_now_btn">
        {{-- @if (Auth::user())
            <a href="../HomepageComponent/booking_now_salon_child_two.php">
            <a href="">
                <button type="button" class="btn btn-warning text-white">Booking Now</button>
            </a>
        @else --}}
            {{-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#signinModal">Booking Now</button> --}}
            {{-- <button type="button" class="btn btn-warning" id="check_account_modal-d">Booking Now</button>
        @endif --}}
            <a href="{{ route('bookingSalonServices', $salon_uuid) }}">
                <button type="button" class="btn btn-warning text-white">Booking Now</button>
            </a>
    </div>


    {{-- @include('UserAuthModals.goto_signin_modal',[]);
    @include('UserAuthModals.signin_modal',[]);
    @include('UserAuthModals.signup_socail_modal',[]);
    @include('UserAuthModals.signup_modal',[]);
    @include('UserAuthModals.forgot_password_modal',[]); --}}

@endsection

@section('footer-scripts')
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script> --}}

@endsection
