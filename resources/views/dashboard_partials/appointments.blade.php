 <div class="card shadow-lg p-3 mb-5 bg-body rounded for_appointments_card">
     <h5>Appointments
         <span class="float-right">
             <i class="fa fa-angle-down" aria-hidden="true">

             </i>
             <span class="for_today"> Today</span>

         </span>
     </h5>

     <div class="row divID ">

        @php
            $dt = new DateTime();
            $current_date = $dt->format('Y-m-d');
        @endphp
        @foreach ($appointments as $appointment)
        <input type="hidden" name="appointment_dates[]" class="appointment_dates" value="{{ $appointment->date }}">
            @if ($appointment->date == $current_date)
                @foreach ($appointment->appointment_details as $details)
                    <div class="col-lg-8 col-md-8 col-sm-8 col-8 for_today_img">
                        <img src="{{ asset('assets/images/saloon_dashboard_images/Ellipse 47.svg') }}"
                            class="img-circle img-fluid" alt="Cinque Terre">
                        <span>{{ $appointment->user->name  }} <br>
                            <span class="for_waxing">{{ $details->services->name }}</span>
                        </span>

                    </div>

                    <div class="col-lg-4 col-md-4 col-sm-4 col-4 ">
                        <div class="text-end for_finished_css">{{ $appointment->status == 'completed' ? 'Finished' : 'Pending'  }}</div>

                    </div>
                @endforeach
            @else
            <h3>Not Appointments Available Today</h3>
            @endif
            @endforeach
     </div>



    </div>

         <div class="card shadow-lg p-3 mb-5 bg-body rounded  for_services_main">
             <h5>Services
                 <a href="#">
                     <span class=" text-end">
                         View More
                         <span class="for_today">
                             <i class="fa fa-arrow-right" aria-hidden="true"></i>
                         </span>
                     </span>
                 </a>
             </h5>

             <div class="row p-3 for_over_flow_glitter_ups">
                 <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                     <div class="card mb-3 for_gliiter_ups_card_radius">
                         <div class="row g-0 ">
                             <div class="col-md-4 pt-3 ">
                                 <img src="{{ asset('assets/images/saloon_dashboard_images/placeholder.svg') }} "
                                     class="img-fluid glitter_ups_salon " alt="...">
                             </div>
                             <div class="col-md-8">
                                 <div class="card-body">
                                     <h6 class="card-title">GlitterUps Salon</h6>
                                     <p class="card-text">Hair Cut </p>
                                     <p class="card-text for_24"><b>$24</b> </p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>

                 <div class="col-lg-6 col-md-6 col-sm-12 col-12">
                     <div class="card mb-3 for_gliiter_ups_card_radius">
                         <div class="row g-0 ">
                             <div class="col-md-4 pt-3 ">
                                 <img src="{{ asset('assets/images/saloon_dashboard_images/placeholder.svg') }}"
                                     class="img-fluid glitter_ups_salon " alt="...">
                             </div>
                             <div class="col-md-8">
                                 <div class="card-body">
                                     <h6 class="card-title">GlitterUps Salon</h6>
                                     <p class="card-text">Hair Cut </p>
                                     <p class="card-text for_24"><b>$24</b> </p>
                                 </div>
                             </div>
                         </div>
                     </div>
                 </div>
             </div>

         </div>



@section('dashboard-footer')
    <script src="{{ asset('assets/js/salon_dashboard.js') }}"></script>

    <script>
    </script>

@endsection
