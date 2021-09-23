<style>

</style>

<!-- Done Modal Start -->
<div class="modal " id="book_service-d">
    <div class="modal-dialog">
        <div class="modal-content modal-lg for_modal_bg">

            <!-- Modal Header -->


            <div class="modal-body for_modal_boy_May_text">

                <div class="pull-right text-end">
                    <img src="./assets/images/Group 152.svg " class="img-fluid for_modal_cancel_img_my_appointments  "
                        data-dismiss="modal" aria-label="Close" alt="...">


                </div>
                <div class="text-end pull-right for_modal_icon_pagefive">
                    <span>
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span>
                            <i class="fa fa-angle-right" aria-hidden="true"></i>
                        </span>
                    </span>
                </div>

                {{-- <div class="calendar"></div> --}}
               {{-- <div mbsc-page class="demo-week-to-month">
                    <div style="height:10%">
                        <div id="demo"></div>
                    </div>
              </div> --}}

              <input type="text" id="text-calendar" class="calendar" />

                {{--  <div class="for_may_text">
                    <h1>May</h1>

                </div>


                <div class="for_mon_to_friday_text d-flex">
                    <p class="for_text_tuesday" onclick="javascript:myMon();" id="mon">Mon <br>
                        <span>
                            08
                        </span>


                    </p>
                    <p class="for_text_tuesday" onclick="javascript:myTue();" id="tue">Tue <br>
                        <span>
                            09
                        </span>
                    </p>

                    <p class="for_text_tuesday" onclick="javascript:myWed();" id="wed">Wed <br>
                        <span>
                            10
                        </span>
                    </p>

                    <p class="for_text_tuesday" onclick="javascript:myThu();" id="thu">Thu <br>
                        <span>
                            11
                        </span>
                    </p>

                    <p class="for_text_tuesday" onclick="javascript:myFri();" id="fri">Fri <br>
                        <span>
                            12
                        </span>
                    </p>

                    <p class="for_text_tuesday" onclick="javascript:mySat();" id="sat">Sat <br>
                        <span>
                            13
                        </span>
                    </p>
                    <p class="for_text_tuesday" onclick="javascript:mySun();" id="sun">Sun <br>
                        <span>
                            14
                        </span>
                    </p>
                </div>  --}}

                <form action="{{ route('bookService') }}" id="frm_booking_service-d">
                    @csrf
                    <div class=" for_clock_celender_icon">
                        <i class="fa fa-clock-o clock_icon_css" aria-hidden="true">
                            <span> Select Time </span>
                        </i>
                            <div class="row for_row_btn_group available_slots_main_container-d" id="main_container-d">
                                {{-- <div class="col-lg-4 col-md-4 col-sm-4 col-4 single_container"> --}}
                                    {{-- <input type="tel" name="time-d " class="time-d btn btn-danger for_common_btn_group" > --}}
                                    {{-- <input type="hidden" name="original_time" class="" > --}}

                                    {{-- <button type="button" class="btn btn-danger for_common_btn_group"></button> --}}
                                {{-- </div> --}}

                            </div>
                    </div>

                    <div class="text-center for_price_22_text">
                        {{-- <span>$<span id="total_booking_price-d"></span></span> --}}
                           <p class="for_border_none_actual_price">
                            Total Price
                            <span class="pull-right" >
                                $ <span id="total_booking_price-d">0</span>
                            </span>
                        </p>
                        <button type="submit" class="btn btn-warning"  id="done-d">Done</button>
                        <input type="hidden" name="salon_uuid" class="salon_uuid-d" value="{{ $salon_uuid }}">
                        <input type="hidden" name="date" class="booking_date-d" value="">
                        {{--  <input type="hidden" name="services_uuid[]" class="service_book_uuid-d" value="">  --}}
                        <input type="hidden" name="user_uuid" class="user_uuid-d" value="{{ Auth::user()->uuid ?? '' }}">

                    </div>
                </form>

            </div>

        </div>
    </div>

    <div class="clonables-d" style="display: none">
        <div class="col-lg-4 col-md-4 col-sm-4 col-4 single_container mt-2" id="available_slot_single_container-d">
            {{-- <input type="radio" name="time-d " class="time-d btn btn-danger for_common_btn_group available_slots" > --}}

            <input type="radio"  name="time"  class="btn-check btn btn-danger for_common_btn_group available_slots" id="option1" autocomplete="off" >
            <label class="btn btn-danger for_common_btn_group available_slots-d" for="option1"></label>
            {{-- <input type="hidden" name="original_time" class="original_time-d " > --}}

            {{-- <button type="button" class="btn btn-danger for_common_btn_group available_slots">9:00 am</button> --}}
        </div>
    </div>
</div>
<!-- Done Modal End -->

<!-- SignIn Modal Start -->


