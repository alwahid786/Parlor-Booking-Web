<!-- SignUp Create Account Modal Start-->


<div class="modal " id="signup_modal-d">
    <div class="modal-dialog">
      <div class="modal-content modal-lg for_modal_bgg signin_h">

        <!-- Modal Header -->


          <div class="modal-body ">
              <div class="pull-right text-end">
                <img src="./assets/images/Group 152.svg " class="img-fluid for_modal_cancel_img_my_appointments  "  data-dismiss="modal" aria-label="Close" alt="...">
              </div>
              <div class=" new_account_text ">
                <h3>New <span> Account</span></h3>
                <p>Signup To Create New Account</p>


              </div>



                <form action="{{ route('signup') }}" class="frm_signup-d"  method="post">
                    <div class="for_inputs_group">
                            <div class="for_form_email_class ">

                                    <div class="input-group mb-3  border-bottom">
                                        <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-user" aria-hidden="true"></i> </span>
                                        <input type="text" name="name" class="input_class" placeholder="Name"/>
                                    </div>
                            </div>


                            <div class="for_form_email_class ">
                                    <div class="input-group mb-3 border-bottom">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-envelope-o" aria-hidden="true"></i> </span>
                                        <input type="email"  name="email" class="input_class" placeholder="Enter email"/>
                                    </div>
                            </div>


                            <div class="for_form_email_class w_75-s mx-auto">
                                <div class="row px-0 mx-0 w-100">
                                    <div class="col-6">
                                        <div class="form-group d-flex">
                                            <label class="text-white align-self-end fs_20px-s"><i class="fa fa-phone" aria-hidden="true"></i></label>
                                            <input type="tel" name="phone_code" maxlength="3"  class="form-control phone_input-s" placeholder="phone" >
                                        </div>
                                    </div>
                                    <div class="col-6 px-0">
                                        <div class="form-group">
                                            <input type="tel" name="phone_number" maxlength="12"  class="form-control phone_input-s" placeholder="phone" >
                                        </div>
                                    </div>
                                </div>


                                {{-- <div class="input-group mb-3  ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                    <input type="tel" name="phone_code" class="input_class" placeholder="phone"/>
                                </div>

                                <div class="input-group mb-3  ">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-phone" aria-hidden="true"></i> </span>
                                    <input type="tel" name="phone_code" class="input_class" placeholder="phone"/>
                                </div> --}}
                            </div>

                            <div class="for_form_email_class ">

                                    <div class="input-group mb-3  border-bottom">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-unlock-alt" aria-hidden="true"></i> </span>
                                        <input type="password" name="password" class="input_class pswd_password-d" placeholder="Create password"/>
                                    </div>
                            </div>

                            <div class="for_form_email_class ">

                                    <div class="input-group mb-3  border-bottom">
                                    <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                                    <span class="for_icon_email_span"> <i class="fa fa-unlock-alt" aria-hidden="true"></i> </span>
                                        <input type="password" name="password_confirmation" class="input_class" placeholder="Confirm password"/>
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
              <p class="account_css create_acount_text">account? <span>
                {{-- <a href="" data-toggle="modal" data-target="#forgotModal">Sign Up</a> --}}
                <button type="button"  id="goto_login_modal-d">Login</button>
              </span></p>
            </div>


         </div>
      </div>
    </div>
  </div>
<!-- SignUp Create Account Modal End-->
