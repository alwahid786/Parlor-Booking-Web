<!-- Forgot Password Modal Start -->


<div class="modal static_modal-d" id="forgot_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true" >
    <div class="modal-dialog">
        <div class="modal-content modal-lg forgot_modal_bg signin_h">

            <!-- Modal Header -->
            <div class="modal-body ">
                <div class="pull-right text-end">
                    <img src="{{asset('assets/images/home_page_component/Group 152.svg')}} " class="img-fluid for_modal_cancel_img_my_appointments close"  data-dismiss="modal" aria-label="Close" alt="...">
                </div>
                <div class=" new_account_text ">
                    <h3>Forgot <span>Password</span></h3>
                    <p>Enter your mail</p>
                </div>

                <form action="{{ route('forgotPassword') }}" class="frm_forgot_password-d" method="post">
                    <div class="for_inputs_group for_email_pass_common">
                        <div class="for_form_email_clasds ">
                            <div class="input-group mb-3 forgot_account_input ">
                            <!-- <input type="text" class="form-control border-bottom" placeholder="Recipient's username" aria-label="Recipient's username" aria-describedby="basic-addon2"> -->
                            <span class="for_icon_email_span">
                                <img src="{{asset('assets/images/saloon_dashboard_images/email.svg')}}" width="20" class="img-fluid" alt="email">
                            </span>
                                <input type="email" name="reference" class="input_class border-bottom mt-1 w-100 text-white" id="user_email-d" placeholder="Enter email"/>
                            </div>
                        </div>
                    </div>
                    <div class="for_send_btn text-center">
                        <input type="hidden" name="user_type" id="forgot_user_type-d" value="user">
                        <input type="hidden" name="type" class="type-d" id="reset_password-d" value="">
                        <button type="submit" class="btn btn-warning">Send</button>
                    </div>
                </form>

                <div class="text-center forgot_dont_have_account ">
                    <p class="dont_have_accounttt">Don't have an</p>
                    <p class="account_css create_acount_text">account? <span class="text-warning py-1 px-1 cursor_pointer-s" id="goto_signup_modal-d"><u>Sign Up</u></span></p>
                        {{-- <a href="" data-toggle="modal" data-target="#entercodeModal">Sign Up</a> --}}
                </div>


            </div>
        </div>
    </div>
</div>

<!-- Forgot Password Modal End -->
