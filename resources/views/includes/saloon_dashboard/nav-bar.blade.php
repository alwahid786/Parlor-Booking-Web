<div class="container ">

    <div class="pull-right">
        <nav class="navbar navbar-expand-sm   navbar-light  ">
            <div class="form-inline ">
                <!-- <div class="collapse navbar-collapse" id="navbarTogglerDemo03"> -->
                <ul class="navbar-nav ml-auto ">
                    <li>
                        {{--  {{ dd($updateProfile) }}  --}}
                        @if (($updateProfile !=[]) && (null != $updateProfile->media) )
                            <img src="{{ asset('/'.$updateProfile->media[0]->path) }} "  class="img-fluid rounded-circle for_nav_bar_icon_img">
                        @else
                            <img src="{{    asset('assets/images/saloon_dashboard_images/Ellipse 46.svg') }}"
                                class="img-fluid rounded-circle for_nav_bar_icon_img">
                        @endif
                    </li>
                    <li class="nav-item dropdown dmenu align-self-center">
                        <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">

                            Beauty Salon
                        </a>
                        <div class="dropdown-menu sm-menu">
                            <a class="dropdown-item" href="{{ route('profile', $id) }}">
                                <i class="fa fa-user" aria-hidden="true"></i>
                                <span class="">Profile</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('profileSetting', $id) }}">
                                <i class="fa fa-cog" aria-hidden="true"></i><span class="">Settings</span>
                            </a>
                            <a class="dropdown-item" href="{{ route('logout') }}">
                                <i class="fa fa-sign-out" aria-hidden="true"></i><span class="">Log Out</span>
                            </a>
                        </div>
                    </li>

                </ul>
            </div>
    </div>
    </nav>
</div>

</div>
