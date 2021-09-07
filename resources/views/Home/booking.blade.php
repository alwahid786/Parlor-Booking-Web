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
        <div class="on_week_text">

            <i class="fa fa-calendar-check-o" aria-hidden="true"></i>
            <span class="on_week_separate">Availability On Week</span>




            <div class="row for_over_flow">
                <div class="col-xxl-12  col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 for_col_12_child_one_dots">

                    <ul class='timeline'>
                        @foreach ($salon_days as $available_day)
                            <li style="color:green" >{{ ucfirst(trans($available_day->day)) }}</li>
                        @endforeach
                    </ul>

                </div>
            </div>



        </div>
    </div>


    <div class="text-center for_booking_now_btn">
        {{-- @if (Auth::user())
            <a href="../HomepageComponent/booking_now_salon_child_two.php">
            <a href="">
                <button type="button" class="btn btn-warning">Booking Now</button>
            </a>
        @else --}}
            {{-- <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#signinModal">Booking Now</button> --}}
            {{-- <button type="button" class="btn btn-warning" id="check_account_modal-d">Booking Now</button>
        @endif --}}
            <a href="{{ route('bookingSalonServices', $salon_uuid) }}">
                <button type="button" class="btn btn-warning">Booking Now</button>
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
