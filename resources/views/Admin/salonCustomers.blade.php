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
                                    {{-- <td>
                                        <a href="{{route('orderDetails',['id'=>$salonCustomer->user->id])}}" class="btn btn-info" type="button">Details</a>
                                      </td> --}}
                                    {{-- <td>{{$salonCustomer->user->created_at}}</td>--}}
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                {{-- <a href="{{route('orderDetails',['id'=>$salonDetail->id])}}" class="btn btn-info" type="button">Orders Detail</a> --}}
                <div class="col-12">
                    <div>
                        <h4 class="text-bold" align="center" style="background-color: lightgrey;" > Orders Details</h4>
                        <table border="1" class="mt-3" align="center" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>Order No#</th>
                                    <th>Customer Details</th>
                                    <th>Details</th>
                                    {{-- <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Booked Date</th>                              
                                    <th>Total Price</th>--}}
                                    <th>Services</th>
                                    <th>Status</th> 
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i=0; ?>
                                @foreach($salonCustomers as $salonCustomer)
                                <tr>
                                    <td align="center"><?php echo ++$i ?></td>
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


                </div>
          

            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
@endsection
