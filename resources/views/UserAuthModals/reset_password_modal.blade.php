
<!-- New Password Modal Start -->


<div class="modal " id="new_password_modal-d">
    <div class="modal-dialog">
      <div class="modal-content modal-lg for_modal_newPassord_bg signin_h">

        <!-- Modal Header -->


          <div class="modal-body ">
                <div class="pull-right text-end">
                <img src="./assets/images/Group 152.svg " class="img-fluid for_modal_cancel_img_my_appointments  "  data-dismiss="modal" aria-label="Close" alt="...">
                </div>
                <div class=" new_account_text ">
                  <h3>New <span> Password</span></h3>
                  <p>Signup To Create New Account</p>
                </div>

            <form action="{{ route('resetPassword') }}" id="frm_reset_password-d" method="post">
                @csrf
                <div class="for_form_email_class pt-3 ">

                         <div class="input-group mb-3 new_pass_input  border-bottom">
                           <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                         <span class="for_icon_email_span"> <i class="fa fa-unlock-alt" aria-hidden="true"></i> </span>
                         <input type="password" name="password"  class="input_class reset_password-d" placeholder="Create password"/>
                         </div>
                 </div>

                 <div class="for_form_email_class  ">

                         <div class="input-group mb-3 new_pass_input  border-bottom">
                           <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                         <span class="for_icon_email_span"> <i class="fa fa-unlock-alt" aria-hidden="true"></i> </span>
                         <input type="password" name="password_confirmation" class="input_class "  placeholder="Confirm password"/>
                         </div>
                 </div>


                <div class="for_submit_btn_new_pass text-center">
                        <input type="hidden" name="code" class="code-d" id="code_user-d" value="">
                        <input type="hidden" name="email" class="email-d" id="email_user-d" value="">

                <button type="submit" class="btn btn-warning">Submit</button>
                </div>
            </form>




                {{--  <div class="text-center newpass_donthave_account">
                    <p class="dont_have_account_newpass">Don't have an</p>
                    <p class="account_css create_acount_text">account? <span>
                    <a href="" data-toggle="modal" data-target="#newpasswordModal">Sign Up</a>
                    <button id="option_signup_socail_modal-d">Sign Up</a>

                    </span></p>
                </div>  --}}
          </div>
      </div>
    </div>
</div>
<!-- New Password Modal End -->
