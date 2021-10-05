@extends('Master_layout.layout')

@section('content')

    <!-- My Appointments Starts  -->


    <div class="container">
        <div class="row for_main_row_appointmentt ">
            <div class="text-center for_border_bottom_text">
                <h4>My
                    <span class="for_appointments_bottom_border">
                        Appointments
                        <hr class="for_appointments_hr text-center">
                </h4>

                    <div class=" text-end for_view_more_text">
                        <p> <a href="{{ route('userAllAppointments', Auth::user()->uuid) }}" />View More</a>
                            <i class="fa fa-arrow-right" aria-hidden="true"></i>
                        </p>
                    </div>
            </div>

                {{-- {{ dd(count($user_appointments)) }} --}}
                @if (count($user_appointments) > 0)
                    @foreach (array_slice($user_appointments, 0,3) as $user_appointment)

                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-12 col-12 ">
                        <div class=" mb-3 for_appointments_card_width">
                            <div class="row g-0">
                                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-4 col-sm-4 col-4">
                                    {{--  {{ dd($user_appointment) }}  --}}
                                    <img src="{{   asset('assets/images/home_page_component/placeholder.svg ') }} " class="for_appointments_img_commonn "
                                            data-toggle="modal" data-target="#modelpagefive" alt="...">

                                    </div>
                                    <div class="col-xxl-8 col-xl-8 col-lg-8 col-md-8 col-sm-8 col-8">
                                        <div class="card-body card_body_for_appointmentt">
                                            <button type="button" class="btn btn-secondary btn_view">{{ $user_appointment->status ?? '' }}
                                                {{-- <span class="ml-3"> <button type="button"
                                                        class="btn btn-primary btn_saturday_css">
                                                        {{ $user_appointment->day ?? 'No day available' }} <span class="badge bg-secondary">9</span>
                                                        <span class="visually-hidden">unread messages</span>
                                                    </button></span> --}}
                                            </button>
                                            <h5 style = "background: none !important; color:black !important">{{ $user_appointment->salon->name ?? 'David' }}</h5>
                                            <h6> {{ $user_appointment->appointment_details->services->name ?? 'Hair Color' }} </h6>
                                            <h4>
                                                <i class="fa fa-clock-o" aria-hidden="true"></i>

                                                <span>
                                                {{ date('h:i A', strtotime($user_appointment->start_time)) ?? ''}}
                                                </span>
                                            </h4>
                                            <p>
                                                <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                <span>
                                                {{ $user_appointment->salon->address ?? '1681 Vine Street New York' }}
                                                </span>
                                            </p>
                                            <h4 class="twenty_four_dollor_text">${{$user_appointment->total_price ?? '24,99'}}</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    @endforeach

                @else
                        <h3>No Active Appointments</h3>
                @endif


            </div>
        </div>

    </div>
    <!-- Copy Code Start -->
    <!-- My Appointments End -->
@endsection
