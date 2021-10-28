<!-- SignUp Option Modal Start-->

<div class="modal static_modal-d" id="signup_socail_modal-d" tabindex="-1" aria-labelledby="view-head" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content modal-lg for_modal_bg signin_h">

            <!-- Modal Header -->
            <div class="modal-body ">
                <div class="pull-right text-end">
                    <img src="{{asset('assets/images/home_page_component/Group 152.svg')}} " class="img-fluid for_modal_cancel_img_my_appointments close"  data-dismiss="modal" aria-label="Close" alt="...">
                </div>
                <div class="text-center for_sihnup_logo_main">
                    <img src="{{asset('assets/images/home_page_component/signup_logo.svg')}}" class="img-fluid">
                    <p>Connect with...</p>
                </div>
                <div class="for_btn_group">
                    <button type="button" class="btn  btn-lg">
                        <i class="fa fa-facebook" aria-hidden="true"></i>
                        <span >Sign in with Facebook</span>
                    </button>

                    <button type="button" class="btn btn_Google  btn-lg">
                        <i class="fa fa-google" aria-hidden="true"></i>

                        <span >
                            <a href="{{ route('googleLogin') }}">
                                Sign in with Google
                            </a>
                        </span>
                    </button>

                    <button type="button" class="btn btn_apple btn-lg">
                        <i class="fa fa-apple" aria-hidden="true"></i>
                        <span >Sign in with Apple</span>
                    </button>
                </div>

                <div class="text-center ">
                <p class="dont_have_accountt">Don't have an</p>
                <p class="account_css">account? <span class="text-warning py-1 px-1 cursor_pointer-s" id="option_signup_modal-d"><u>Sign Up</u></span></p>
                    {{-- <a href="" data-toggle="modal" data-target="#signupcreateModal">Sign Up</a> --}}
                </div>
            </div>
        </div>
    </div>
</div>

<!-- SignUp Option Modal End-->
