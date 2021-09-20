 <div class="card shadow-lg p-3 mb-5 bg-body rounded for_card_all_notifications">
     <p> <b>All Notifications</b></p>
    {{--  {{ dd(count($salon_notifications->notifications)) }}  --}}
    @if (count($salon_notifications->notifications) == 0)
        <h3>No notifications available</h3>
    @else

        @foreach ($salon_notifications as $notification)
            @foreach ($notification as $single_notification)
                <div class="row divID ">
                    <div class="col-lg-3 col-md-3 col-sm-5 col-5">
                        <img src="{{ asset('assets/images/saloon_dashboard_images/Ellipse 47.svg') }}"
                        class="img-circle img-fluid for_common_img_md" alt="Cinque Terre">
                    </div>

                    <div class="col-lg-9 col-md-9 col-sm-7 col-7 for_katrina_salon_w">
                        <h5>
                            <span class="second">{{ $single_notification->noti_text ?? '' }}</span>
                        </h5>
                        <p>{{  \Carbon\Carbon::parse($single_notification->appointment->created_at)->diffForHumans() ?? '' }}</p>
                    </div>
                </div>
                <p class="dashed"></p>
            @endforeach
        @endforeach

    @endif

 </div>
