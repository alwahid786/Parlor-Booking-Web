@extends('Admin.layouts.main');

<head>
    <style>
        .w-5 {
            width: 20px;
        }

        .flex-1 {
            /* margin-top: 20px; */
            display: none;
        }

        .text-sm {
            margin-top: 10px;
        }

    </style>
</head>
@section('page-title')
Order Details
@endsection
@section('body-content')                         
    <section class="content">
        <div class="container-fluid">
            <h4 class="text-bold" align="center" style="background-color: rgb(211, 211, 211);" > Orders Details</h4>
            <ul class="nav nav-tabs" id="myTab" role="tablist">
                <li class="nav-item">
                  <a class="nav-link" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">Yesterday</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link active" id="profile-tab" data-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Today</a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab" aria-controls="contact" aria-selected="false">Tomorrow</a>
                </li>
              </ul>
              <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade " id="home" role="tabpanel" aria-labelledby="home-tab">
                    <table border="1" class="mt-3" align="center" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Order No#</th>
                                <th>Salon Detail</th>
                                <th>Customer Detail</th>
                                <th>Order Detail</th>
                                <th>Booking Service</th>
                                <th>Status</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach($salonCustomers as $salonCustomer)
                            <tr>
                                <td align="center"><?php echo ++$i ?></td>                            
                                <td>
                                    <h6>Salon Name: {{optional($salonCustomer->salon)->name}}</h6>
                                    <h6>Email:  {{optional($salonCustomer->salon)->email}}</h6>
                                    <h6>Phone No:  {{optional($salonCustomer->salon)->phone_code."".optional($salonCustomer->salon)->phone_number}}</h6>
                                    <h6>Gender: {{optional($salonCustomer->salon)->gender}}</h6>
                                    <h6>Address: {{optional($salonCustomer->salon)->address}}</h6>
                                    </td>
                                <td><h6>Name: {{$salonCustomer->user->name}}</h6>
                                <h6>Email: {{$salonCustomer->user->email}}</h6>
                                <h6>Phone No: {{$salonCustomer->user->phone_code."".$salonCustomer->user->phone_number}}</h6>
                                <h6>Gender: {{$salonCustomer->user->gender}}</h6>
                                <h6>Address: {{$salonCustomer->user->address}}</h6>
                                </td>
                                <td><h6>Start Time: {{ date('h:i A', strtotime($salonCustomer->start_time)) ?? ''}}</h6>
                                <h6>End Time: {{ date('h:i A', strtotime($salonCustomer->end_time)) ?? ''}}</h6>
                               <h6>Date: {{  date('d/m/Y', strtotime($salonCustomer->date)) }}</h6>
                               <h6>Total Price: {{$salonCustomer->total_price}} </h6></td>
                               <td>
                                @foreach($salonCustomer->appointmentDetails as $appointmentDetail)
                                <h6 align="center">Name: {{$appointmentDetail->services->name}}</h6>
                                <h6 align="center">Price: {{$appointmentDetail->services->price}}</h6>
                            @endforeach  
                            </td>
                               @if($salonCustomer->status == 'active')
                                <td align="center"><h6 style="color:#00008B;"><b>Active</b></h6></td>  
                                @elseif($salonCustomer->status == 'cancelled')
                                <td align="center"><h6 style="color:#DC143C;"><b>Cancelled</b></h6></td>  
                                @elseif($salonCustomer->status == 'completed')
                                <td align="center"><h6 style="color:#006400;"><b>Completed</b></h6></td>  
                                @elseif($salonCustomer->status == 'on-hold')
                                <td align="center"><h6 style="color:#2F4F4F;"><b>On-hold</b></h6></td> 
                                @elseif($salonCustomer->status == 'rejected')
                                <td align="center"><h6 style="color:#800000;"><b>Rejected</b></h6></td> 
                                @else
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                    <table border="1" class="mt-3" align="center" style="width: 100%;">
                        <thead>
                            <tr>
                                <th>Order No#</th>
                                <th>Salon Detail</th>
                                <th>Customer Detail</th>
                                <th>Order Detail</th>
                                <th>Booking Service</th>
                                <th>Status</th> 
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=0; ?>
                            @foreach($salonCustomerss as $salonCustomer)
                            <tr>
                                <td align="center"><?php echo ++$i ?></td> 
                                <td>
                                    <h6>Salon Name: {{optional($salonCustomer->salon)->name}}</h6>
                                    <h6>Email:  {{optional($salonCustomer->salon)->email}}</h6>
                                    <h6>Phone No:  {{optional($salonCustomer->salon)->phone_code."".optional($salonCustomer->salon)->phone_number}}</h6>
                                    <h6>Gender: {{optional($salonCustomer->salon)->gender}}</h6>
                                    <h6>Address: {{optional($salonCustomer->salon)->address}}</h6>
                                    </td>                            
                                <td><h6>Name: {{$salonCustomer->user->name}}</h6>
                                <h6>Email: {{$salonCustomer->user->email}}</h6>
                                <h6>Phone No: {{$salonCustomer->user->phone_code."".$salonCustomer->user->phone_number}}</h6>
                                <h6>Gender: {{$salonCustomer->user->gender}}</h6>
                                <h6>Address: {{$salonCustomer->user->address}}</h6>
                                </td>
                                <td><h6>Start Time: {{ date('h:i A', strtotime($salonCustomer->start_time)) ?? ''}}</h6>
                                <h6>End Time: {{ date('h:i A', strtotime($salonCustomer->end_time)) ?? ''}}</h6>
                               <h6>Date: {{  date('d/m/Y', strtotime($salonCustomer->date)) }}</h6>
                               <h6>Total Price: {{$salonCustomer->total_price}} </h6></td>
                               <td>
                                @foreach($salonCustomer->appointmentDetails as $appointmentDetail)
                                <h6 align="center">Name: {{$appointmentDetail->services->name}}</h6>
                                <h6 align="center">Price: {{$appointmentDetail->services->price}}</h6>
                            @endforeach  
                            </td>
                               @if($salonCustomer->status == 'active')
                                <td align="center"><h6 style="color:#00008B;"><b>Active</b></h6></td>  
                                @elseif($salonCustomer->status == 'cancelled')
                                <td align="center"><h6 style="color:#DC143C;"><b>Cancelled</b></h6></td>  
                                @elseif($salonCustomer->status == 'completed')
                                <td align="center"><h6 style="color:#006400;"><b>Completed</b></h6></td>  
                                @elseif($salonCustomer->status == 'on-hold')
                                <td align="center"><h6 style="color:#2F4F4F;"><b>On-hold</b></h6></td> 
                                @elseif($salonCustomer->status == 'rejected')
                                <td align="center"><h6 style="color:#800000;"><b>Rejected</b></h6></td> 
                                @else
                                @endif
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab"> <table border="1" class="mt-3" align="center" style="width: 100%;">
                    <thead>
                        <tr>
                            <th>Order No#</th>
                            <th>Salon Detail</th>
                            <th>Customer Detail</th>
                            <th>Order Detail</th>
                            <th>Booking Service</th>
                            <th>Status</th> 
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i=0; ?>
                        @foreach($salonCustomersss as $salonCustomer)
                        <tr>
                            <td align="center"><?php echo ++$i ?></td> 
                            <td>
                                <h6>Salon Name: {{optional($salonCustomer->salon)->name}}</h6>
                                <h6>Email:  {{optional($salonCustomer->salon)->email}}</h6>
                                <h6>Phone No:  {{optional($salonCustomer->salon)->phone_code."".optional($salonCustomer->salon)->phone_number}}</h6>
                                <h6>Gender: {{optional($salonCustomer->salon)->gender}}</h6>
                                <h6>Address: {{optional($salonCustomer->salon)->address}}</h6>
                                </td>                            
                            <td><h6>Name: {{$salonCustomer->user->name}}</h6>
                            <h6>Email: {{$salonCustomer->user->email}}</h6>
                            <h6>Phone No: {{$salonCustomer->user->phone_code."".$salonCustomer->user->phone_number}}</h6>
                            <h6>Gender: {{$salonCustomer->user->gender}}</h6>
                            <h6>Address: {{$salonCustomer->user->address}}</h6>
                            </td>
                            <td><h6>Start Time: {{ date('h:i A', strtotime($salonCustomer->start_time)) ?? ''}}</h6>
                            <h6>End Time: {{ date('h:i A', strtotime($salonCustomer->end_time)) ?? ''}}</h6>
                           <h6>Date: {{  date('d/m/Y', strtotime($salonCustomer->date)) }}</h6>
                           <h6>Total Price: {{$salonCustomer->total_price}} </h6></td>
                           <td>
                            @foreach($salonCustomer->appointmentDetails as $appointmentDetail)
                            <h6 align="center">Name: {{$appointmentDetail->services->name}}</h6>
                            <h6 align="center">Price: {{$appointmentDetail->services->price}}</h6>
                        @endforeach  
                        </td>
                           @if($salonCustomer->status == 'active')
                            <td align="center"><h6 style="color:#00008B;"><b>Active</b></h6></td>  
                            @elseif($salonCustomer->status == 'cancelled')
                            <td align="center"><h6 style="color:#DC143C;"><b>Cancelled</b></h6></td>  
                            @elseif($salonCustomer->status == 'completed')
                            <td align="center"><h6 style="color:#006400;"><b>Completed</b></h6></td>  
                            @elseif($salonCustomer->status == 'on-hold')
                            <td align="center"><h6 style="color:#2F4F4F;"><b>On-hold</b></h6></td> 
                            @elseif($salonCustomer->status == 'rejected')
                            <td align="center"><h6 style="color:#800000;"><b>Rejected</b></h6></td> 
                            @else
                            @endif
                        </tr>
                        @endforeach
                    </tbody>
                </table></div>
              </div>
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    </section>
@endsection
