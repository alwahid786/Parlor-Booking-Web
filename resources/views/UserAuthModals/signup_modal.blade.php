<!-- SignUp Create Account Modal Start-->


<div class="modal static_modal-d" id="signup_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content for_modal_bg ">

        <!-- Modal Header -->


          <div class="modal-body ">
              <div class="pull-right text-end">
                <img src="{{asset('assets/images/home_page_component/Group 152.svg')}}" class="img-fluid for_modal_cancel_img_my_appointments close"  data-dismiss="modal" aria-label="Close" alt="...">
              </div>
              <div class=" new_account_text ">
                <h3>New <span> Account</span></h3>
                <p>Signup To Create New Account</p>


              </div>



                <form action="{{ route('signup') }}" class="frm_signup-d"  method="post">
                    <div class="for_inputs_group for_email_pass_common">
                            <div class="for_form_email_class ">
                                <div class="form-group ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                                    <input type="text" name="name" class="form-control ps-0 rounded-0 input_class ms-0 border-bottom text-white" placeholder="Name"/>
                                </div>
                            </div>
                            <div class="for_form_email_class ">
                                    <div class="form-group">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                                        <input type="email"  name="email" class="form-control ps-0 rounded-0 input_class ms-0 border-bottom text-white" placeholder="Enter email"/>
                                    </div>
                            </div>


                            <div class="for_form_email_class">

                                <div class="form-group">
                                    <!-- <label class="text-white align-self-end fs_20px-s"><i class="fa fa-phone" aria-hidden="true"></i></label> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                    <input type="tel" name="phone_code" maxlength="3"  class="form-control ps-0 rounded-0 input_class ms-0 border-bottom text-white" placeholder="phone" >
                                </div>
                            </div>
                            <div class="for_form_email_class">
                                <div class="form-group">
                                    <input type="tel" name="phone_number" maxlength="12"  class="form-control ps-0 rounded-0 input_class ms-0 border-bottom text-white" placeholder="phone" >
                                </div>

                                {{-- <div class="input-group ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                    <input type="tel" name="phone_code" class="input_class ms-0 border-bottom text-white" placeholder="phone"/>
                                </div>

                                <div class="input-group ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                    <input type="tel" name="phone_code" class="input_class ms-0 border-bottom text-white" placeholder="phone"/>
                                </div> --}}
                            </div>

                            <div class="for_form_email_class ">

                                    <div class="form-group">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-unlock-alt" aria-hidden="true"></i> </span>
                                        <input type="password" name="password" class="form-control ps-0 rounded-0 input_class pswd_password-d ms-0 border-bottom text-white" placeholder="Create password"/>
                                    </div>
                            </div>

                            <div class="for_form_email_class ">

                                    <div class="form-group">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-unlock-alt" aria-hidden="true"></i> </span>
                                        <input type="password" name="password_confirmation" class="form-control ps-0 rounded-0 input_class ms-0 border-bottom text-white" placeholder="Confirm password"/>
                                    </div>
                            </div>

                    </div>
                    <div class="for_create_btn text-center">
                        <button type="submit" class="btn btn-warning">Create</button>
                        <input type="hidden" name="type"  class="user_modal_type-d" value="user">
                    </div>
                </form>



            <div class="text-center for_signup_dont_have_account ">
            <p class="dont_have_accounttt">Have an</p>
              <p class="account_css create_acount_text">account? <span  class="text-warning py-1 px-1 cursor_pointer-s" id="goto_login_modal-d"><u>Login</u></span></p>
                {{-- <a href="" data-toggle="modal" data-target="#forgotModal">Sign Up</a> --}}
            </div>


         </div>
      </div>
    </div>
  </div>
<!-- SignUp Create Account Modal End-->
