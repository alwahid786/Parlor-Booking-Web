<!-- Forgot Password Modal Start -->


<div class="modal " id="forgot_modal-d">
    <div class="modal-dialog">
      <div class="modal-content modal-lg forgot_modal_bg signin_h">

        <!-- Modal Header -->


          <div class="modal-body ">
              <div class="pull-right text-end">
                <img src="./assets/images/Group 152.svg " class="img-fluid for_modal_cancel_img_my_appointments  "  data-dismiss="modal" aria-label="Close" alt="...">
              </div>
              <div class=" new_account_text ">
                    <h3>Forgot <span> Account</span></h3>
                    <p>Enter your mail</p>
              </div>

            <form action="{{ route('forgotPassword') }}" class="frm_forgot_password-d" method="post">
                <div class="for_inputs_group">
                    <div class="for_form_email_clasds ">

                            <div class="input-group mb-3 forgot_account_input border-bottom">
                            <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                            <span class="for_icon_email_span"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                                <input type="email" name="reference" class="input_class" id="user_email-d" placeholder="Enter email"/>
                            </div>
                    </div>

                </div>
                        <div class="for_send_btn text-center">
                            <input type="hidden" name="user_type" id="forgot_user_type-d" value="user">
                            <input type="hidden" name="type" class="type-d" id="reset_password-d" value="user_reset_modal">

                        <button type="submit" class="btn btn-warning">Send</button>
                </div>
            </form>


            <div class="text-center forgot_dont_have_account ">
            <p class="dont_have_accounttt">Don't have an</p>
              <p class="account_css create_acount_text">account? <span>
                {{-- <a href="" data-toggle="modal" data-target="#entercodeModal">Sign Up</a> --}}
                <button id="goto_signup_modal-d">Sign Up</button>
              </span></p>
            </div>


         </div>
      </div>
    </div>
  </div>

<!-- Forgot Password Modal End -->
