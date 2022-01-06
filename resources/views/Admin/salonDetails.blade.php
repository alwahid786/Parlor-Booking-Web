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
    Salon Details
@endsection
@section('body-content')


    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div>
                        <h4 class="text-bold"> Salon Details</h4>
                        <table border="1" class="mt-3">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>phone</th>
                                    <th>Gender</th>
                                    <th>Type</th>
                                    <th>Status</th>
                                    <th>Description</th>
                                    <th>Address</th>
                                    <th>Start Time</th>
                                    <th>End Time</th>
                                    <th>Created</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{$salonDetail->name}}</td>
                                    <td>{{$salonDetail->email}}</td>
                                    <td>{{$salonDetail->phone_code.$salonDetail->phone_number}}</td>
                                    <td>{{$salonDetail->gender}}</td>
                                    <td>{{$salonDetail->type}}</td>
                                    <td>{{$salonDetail->status}}</td>
                                    <td>{{$salonDetail->description}}</td>
                                    <td>{{$salonDetail->address}}</td>
                                    <td>{{$salonDetail->start_time}}</td>
                                    <td>{{$salonDetail->end_time}}</td>
                                    <td>{{$salonDetail->created_at}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>


                </div>
                <div class="col-12">
                    <div class="mt-3">
                        <h4  class="text-bold">Services</h4>
                        <table border="1" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>phone</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($salonDetail->services))
                                @foreach ($salonDetail->services as $service)
                                    
                                <tr>
                                    <td>{{$service->name}}</td>
                                    <td>{{$service->price}}Rs</td>
                                    <td>{{$salonDetail->phone_code.$salonDetail->phone_number}}</td>
                                    <td>{{$service->created_at}}</td>
                                </tr>
                                @endforeach
                                @endif
                            </tbody>
                        </table>
                    </div>


                </div>

                <div class="col-12">
                    <div class="mt-3">
                        <h4  class="text-bold">Offers</h4>
                        <table border="1" >
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Created At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if(isset($salonDetail->offers))
                                @foreach ($salonDetail->offers as $offer)
                                <tr>
                                    <td>{{$offer->name ?? ''}}</td>
                                    <td>{{$offer->price ?? ''}}Rs</td>
                                    <td>{{$offer->discount ?? ''}}%</td>
                                    <td>{{$offer->created_at ?? ''}}</td>
                                </tr>
                                @endforeach
                                @endif
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
