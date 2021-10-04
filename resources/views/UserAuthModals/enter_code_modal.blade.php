<div class="modal static_modal-d" id="enter_code_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content modal-lg for_modal_bggg signin_h">

        <!-- Modal Header -->


          <div class="modal-body ">
                <div class="pull-right text-end">
                <img src="{{asset('assets/images/home_page_component/Group 152.svg')}}" class="img-fluid for_modal_cancel_img_my_appointments close"  data-dismiss="modal" aria-label="Close" alt="...">
                </div>
                <div class=" new_account_text ">
                  <h3>Enter <span> Code</span></h3>
                  <p>Enter your code</p>
                </div>


                <form action="{{ route('enterCode') }}" class="frm_validate_code-d" id="frm_validate_code-d" method="post">
                    @csrf
                    <div class="row mt-5 for_row_enter_code">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 for_enter_code_responsive_main_div code_border-s code_border-d ">
                            <div class="for_common_email_pass pt-4 ">
                                <div class="input-group mb-5 w-75 ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <input type="number" class="inp dot dot_one v_code-d v_code-s text-center text-white"  name='number_box_1'  id='number_box_1' min='0' max="9" maxlength="1" placeholder="0"/>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 code_border-s code_border-d">
                            <div class="for_common_email_pass pt-4">

                                <div class="input-group mb-5 w-75 ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <input  type="number"  class="inp dot dot_two v_code-d v_code-s text-center text-white" name='number_box_2' id='number_box_2' min='0' max="9" maxlength="1"  placeholder="1"/>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 code_border-s code_border-d">
                            <div class="for_common_email_pass pt-4">
                                <div class="input-group mb-5 w-75 ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <input type="number" class="inp dot dot_three v_code-d v_code-s text-center text-white"   name='number_box_3' id='number_box_3' min='0' max="9" maxlength="1"  placeholder="2"/>
                                </div>

                            </div>
                        </div>

                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-3 col-sm-3 col-3 code_border-s code_border-d">
                            <div class="for_common_email_pass pt-4">
                                <div class="input-group mb-5 w-75 ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <input type="number" class="inp dot dot_four v_code-d v_code-s text-center text-white last-d" name='number_box_4' id='number_box_4' min='0' max="9" maxlength="1"   placeholder="3"/>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="for_submit_btn text-center">
                        <input type="hidden" name="email" class="email-d" value="">
                            <input type='hidden' name='activation_code' id='hdn_activation_code-d' />
                            {{--  <input type="hidden" name="type" class="type-d" id="reset_password-d" value="user_reset_modal">  --}}
                            <input type="hidden" name="user_type" class="user_type-d" value="">
                        <button type="submit" class="btn btn-warning">Submit</button>
                    </div>
                </form>



                {{--  <div class="text-center entercode_donthave_account">
                    <p class="dont_have_accountttt">Don't have an</p>
                    <p class="account_css create_acount_text">account? <span>
                    <a href="" data-toggle="modal" data-target="#newpasswordModal">Sign Up</a>
                    </span></p>
                </div>  --}}
          </div>
      </div>
    </div>
</div>
<!-- Enter Code Modal End -->
