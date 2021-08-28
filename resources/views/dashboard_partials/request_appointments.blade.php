  <div class="col-lg-6 col-md-6 col-sm-12 col-12">
      <div class="card shadow-lg p-3 mb-5 bg-body rounded for_sm_responsive_appointment Appointment_scroll">
          <h6>
              <b> Appointment Request</b>
              <span class="end">See All</span>
          </h6>




          @foreach ($appointments as $appointment)

          @if (($appointment->status =='on-hold'))

            {{--  <div class="row mt-2">
                <div class="col-lg-5 col-md-5 col-sm-5 col-5 for_appointment_request">
                    <img src="{{ asset('assets/images/saloon_dashboard_images/Ellipse 47.svg') }}"
                        class="img-circle img-fluid" alt="Cinque Terre">
                    <span>{{ $appointment->user->name }}</span> <br>
                        <span class="for_appointment_child">{{ $details->services->name }}</span>
                    </span>
                </div>

                <div class="col-lg-7 col-md-7 col-sm-7 col-7 ">
                    <div class=" for_dates">
                        <p class="text-end"> {{  date('d/m/Y', strtotime($appointment->date)) }} {{ date('h:i A', strtotime($appointment->start_time)) ?? ''}}
                            <span>
                                <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                                <span>
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </span>
                            </span>
                        </p>
                    </div>

                </div>
            </div>    --}}
            <div class="main_container-d">
                <div class="row mt-2 single_container-d" data-container={{ $appointment->uuid }}>
                    <div class="col-2 for_appointment_request">
                        <img src="{{ asset('assets/images/saloon_dashboard_images/Ellipse 47.svg') }}"
                            class="img-circle img-fluid" alt="Cinque Terre">
                    </div>
                    <div class="col-4 for_appointment_request ">
                        <span>{{ $appointment->user->name }}</span>
                            <br>
                    @foreach ($appointment->appointment_details as $details)
                        <span >{{ $details->services->name }}</span>
                    @endforeach

                    </div>
                    <div class="col-4 for_dates ">
                        <p class="text-end"> {{  date('d/m/Y', strtotime($appointment->date)) }} {{ date('h:i A', strtotime($appointment->start_time)) ?? ''}}
                    </div>
                    <div class="col-2">
                        @if ($appointment->status == 'on-hold')
                            <i class="fa fa-check-circle-o approve-d" aria-hidden="true" data-setid={{ $appointment->uuid }}></i>

                            <span>
                                <i class="fa fa-times-circle cancel-d" aria-hidden="true" data-setid={{ $appointment->uuid }}></i>
                            </span>
                            @else
                                <p style="font-size: 9px;">Accepted</p>

                        @endif
                    </div>
                </div>
            </div>

          {{--  <div class="row mt-3">
              <div class="col-lg-5 col-md-5 col-sm-5 col-5 for_appointment_request">
                  <img src="{{ asset('assets/images/saloon_dashboard_images/Ellipse 47.svg') }}"
                  class="img-circle img-fluid" alt="Cinque Terre">
                  <span>Mable Clark <br>
                      <span class="for_appointment_child">Hair Cut</span>
                  </span>

              </div>

              <div class="col-lg-7 col-md-7 col-sm-7 col-7 ">
                  <div class=" for_dates">
                      <p class="text-end">04/04/2020- 10 AM
                          <span class="for_accepted">
                              Accepted
                          </span>
                      </p>
                  </div>

              </div>
          </div>  --}}

          {{--  <div class="row mt-2">
              <div class="col-lg-5 col-md-5 col-sm-5 col-5 for_appointment_request">
                  <img src="{{ asset('assets/images/saloon_dashboard_images/Ellipse 47.svg') }}"
                      class="img-circle img-fluid" alt="Cinque Terre">
                  <span>{{ $appointment->user->name }}</span> <br>
                      <span class="for_appointment_child">Hair Cut</span>
                  </span>

              </div>

              <div class="col-lg-7 col-md-7 col-sm-7 col-7 ">
                  <div class=" for_dates">
                      <p class="text-end">04/04/2020- 10 AM
                          <span>
                              <i class="fa fa-check-circle-o" aria-hidden="true"></i>
                              <span>
                                  <i class="fa fa-times-circle" aria-hidden="true"></i>
                              </span>
                          </span>
                      </p>
                  </div>

              </div>
          </div>  --}}
          @endif

          @endforeach

      </div>

  </div>


@section('dashboard-footer')
    <script src="{{ asset('assets/js/salon_dashboard.js') }}"></script>

    <script>
    </script>

@endsection
