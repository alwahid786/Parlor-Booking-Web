
    <!--Asside Bar Page Start !-->

         <div class="pt-3">
             <img src="{{ asset('assets/images/saloon_dashboard_images/Group 328.svg') }}" class="img-fluid asside_bar_icon_top" >
         </div>

         <!-- NavBar Child One Start !-->
        <!-- <div class="pt-3">
         <div class="pt-4 pic">
            <div class="for_img_css one text">
               <a href="Dashboard_PageTwentyOne.php">
               <img src="AssideBar/asside_bar_assets/images/Dashboard.svg" class="img-fluid for_first_img_asside_bar"> <span class="for_dashboard_assidebar"> Dashboard</span>
               </a>
            </div>
         </div>
         </div> -->
         <div class="pic">
            <div class="for_common_main_assidebar">
               <a href="{{ route('saloonDashboard', $id) }}">
               <img src="{{ asset('assets/images/saloon_dashboard_images/Dashboard.svg') }}" class="img-fluid ">
                 <span>Dashboard</span>

               </a>
            </div>
         </div>

         <!-- NavBar Child One End !-->


            <!-- NavBar Child One Start !-->
        <!-- <div class="pt-3">
         <div class="pt-4 pic">
            <div class="for_img_css_appointment one text">
               <a href="Appointment.php">
               <img src="AssideBar/asside_bar_assets/images/Calendar.svg" class="img-fluid "> <span> Appointment</span>
               </a>
            </div>
         </div>
         </div> -->



         <div class="pic">
            <div class="for_common_main_assidebar">
               <a href="{{ route('appointments', $id) }}">
               <img src="{{ asset('assets/images/saloon_dashboard_images/Calendar.svg') }}" class="img-fluid ">
                 <span>Appointment</span>

               </a>
            </div>
         </div>

         <!-- NavBar Child One End !-->


            <!-- NavBar Child One Start !-->
        <!-- <div class="pt-3">
         <div class="pt-4 pic">
            <div class="for_img_css_past one text">
               <a href="PastAppointment.php">
               <img src="AssideBar/asside_bar_assets/images/Group 238.svg" class="img-fluid "> <span> Past Appointment</span>
               </a>
            </div>
         </div>
         </div> -->


         <div class="pic">
            <div class="for_common_main_assidebar">
               <a href="{{ route('pastAppointments', $id) }}">
               <img src="{{ asset('assets/images/saloon_dashboard_images/Group 238.svg') }}" class="img-fluid ">
                 <span class="for_pastAppointment_text_css">Past Appointment</span>

               </a>
            </div>
         </div>




         <div class="pic">
            <div class="for_common_main_assidebar">
               <a href="{{ route('availability', $id) }}">
               <img src="{{ asset('assets/images/saloon_dashboard_images/Group 137.svg') }}" class="img-fluid ">
                 <span>Availability</span>

               </a>
            </div>
         </div>


         <div class="pic">
            <div class="for_common_main_assidebar">
               <a href="{{ route('service', $id) }}">
               <img src="{{ asset('assets/images/saloon_dashboard_images/Group 238.svg') }}" class="img-fluid ">
                 <span class="for_pastAppointment_text_css">Services</span>

               </a>
            </div>
         </div>


         <!-- NavBar Child One End !-->

            <!-- NavBar Child One Start !-->
        <!-- <div class="pt-3">
         <div class="pt-4 pic">
            <div class="for_img_css  text">
               <a href="AboutUs.php">
               <img src="AssideBar/asside_bar_assets/images/Group 50.svg" class="img-fluid "> <span> About Us</span>
               </a>
            </div>
         </div>
         </div> -->



         <div class="pic">
            <div class="for_common_main_assidebar">
               <a href="{{ route('aboutUs',$id) }}">
               <img src="{{ asset('assets/images/saloon_dashboard_images/Group 137.svg') }}" class="img-fluid ">
                 <span>About Us</span>

               </a>
            </div>
         </div>


         <div class="pic">
            <div class="for_common_main_assidebar">
               <a href="{{ route('privacyPolicy',$id) }}">
               <img src="{{ asset('assets/images/saloon_dashboard_images/Group 137.svg') }}" class="img-fluid ">
                 <span>Privacy Policy</span>

               </a>
            </div>
         </div>



         <div class="pic">
            <div class="for_common_main_assidebar">
               <a href="{{ route('termsConditions',$id) }}">
               <img src="{{ asset('assets/images/saloon_dashboard_images/Group 137.svg') }}" class="img-fluid ">
                 <span>Terms Conditions</span>

               </a>
            </div>
         </div>

         <!-- NavBar Child One End !-->






    <!--Asside Bar Page End !-->






