@extends('Admin.layouts.main');

@section('body-content')
    

{{-- <div class="wrapper">    --}}

    <!-- Navbar -->

        {{-- @include('Admin._partials.header') --}}
    {{-- @yield('header-content') --}}
    <!-- /.navbar -->
  
    <!-- Main Sidebar Container -->
    {{-- @yield('sidebar-content') --}}
    {{-- @include('Admin._partials.header') --}}

  
    <!-- Content Wrapper. Contains page content -->
    {{-- <div class="content-wrapper"> --}}
  
  
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">All Salon And Users</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <div id="example2_wrapper" class="dataTables_wrapper dt-bootstrap4"><div class="row"><div class="col-sm-12 col-md-6"></div><div class="col-sm-12 col-md-6"></div></div><div class="row"><div class="col-sm-12"><table id="example2" class="table table-bordered table-hover dataTable dtr-inline" role="grid" aria-describedby="example2_info">
                    <thead>
                    <tr role="row">
                      {{-- <th class="sorting_asc" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Name</th> --}}
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >ID#</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Name</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Email</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Gender</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Type</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Address</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Created</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Status</th>
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($allSalons as $salon)

                      <tr role="row" class="odd">
                        <td>{{$salon->id}}</td>
                        <td>{{$salon->name}}</td>
                        <td>{{$salon->email}}</td>
                        <td>{{$salon->gender}}</td>
                        <td>{{$salon->type}}</td>
                        <td>{{$salon->address}}</td>
                        <td>{{$salon->created_at}}</td>
                        @if($salon->status == 'accepted')
                        <td>
                          <span class="btn btn-info success" style="color:aliceblue">{{$salon->status}}</span>
                        </td>
                        @elseif($salon->status == 'rejected')
                        <td>
                          <span class="btn btn-danger fail" style="color:aliceblue">{{$salon->status}}</span>
                        </td>
                        @else
                        <td>
                          <span class="btn btn-warning waiting" style="color:aliceblue">{{$salon->status}}</span>
                        </td>
                        @endif

                        {{-- <td>
                          <span class="btn btn-info success d-none" style="color:aliceblue"></span>
                        </td> --}}


                        @if($salon->status == 'pending')
                        <td class="action">
                          <div class="d-flex">
                            <span class="btn btn-info accepted" id="{{$salon->id}}" value="accepted" }}>Accepted</span>                                
                            <span class="btn btn-danger rejected" id="{{$salon->id}}" value="rejected" data-src={{$salon->id}}>Rejected</span>      
                          </div>
                        </td>
                        @else
                          <td></td>
                        @endif
                      </tr>
                    @endforeach
                   
                    </tbody>
                  </table></div></div><div class="row"><div class="col-sm-12 col-md-5"><div class="dataTables_info" id="example2_info" role="status" aria-live="polite">Showing 1 to 10 of 57 entries</div></div><div class="col-sm-12 col-md-7"><div class="dataTables_paginate paging_simple_numbers" id="example2_paginate"><ul class="pagination"><li class="paginate_button page-item previous disabled" id="example2_previous"><a href="#" aria-controls="example2" data-dt-idx="0" tabindex="0" class="page-link">Previous</a></li><li class="paginate_button page-item active"><a href="#" aria-controls="example2" data-dt-idx="1" tabindex="0" class="page-link">1</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="2" tabindex="0" class="page-link">2</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="3" tabindex="0" class="page-link">3</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="4" tabindex="0" class="page-link">4</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="5" tabindex="0" class="page-link">5</a></li><li class="paginate_button page-item "><a href="#" aria-controls="example2" data-dt-idx="6" tabindex="0" class="page-link">6</a></li><li class="paginate_button page-item next" id="example2_next"><a href="#" aria-controls="example2" data-dt-idx="7" tabindex="0" class="page-link">Next</a></li></ul></div></div></div></div>
                      <!-- /.card-body -->
          </div>
              </div>
  
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>    


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        
        let public_path = "{{config('app.url').'/public/'}}";


        $(document).ready(function() {
          
          $('span.accepted,span.rejected').click(function(){
            var status = $(this).attr('value');
            var statusId = $(this).attr('id');
            var statusAccepted;
            var statusRejected;
            console.log(status,statusId);
            $.ajax({
                        url: '{{ route('salonStatus') }}',
                        method: 'GET',
                        type: 'GET',
                        success:'success',
                        data: {
                            status: status,
                            statusId: statusId
                        },
                        dataType: 'json',
                        success: function(response) {
                          if(response.status ==  'accepted'){
                            statusAccepted = response.status;
                            $(this).parents().find(".action").addClass("d-none")
                            $(this).parents().find(".waiting").addClass("d-none")
                            $(this).parents().find(".success").text(statusAccepted)
                            console.log( $(this).parent().parent().parent().find(".action"), "34e343");
                            console.log(statusAccepted );

                          }
                          if(response.status ==  'rejected'){
                            statusRejected = response.status;

                            console.log(statusRejected );
                          }
                        }


                      });
          });

          // let accepted = document.getElementsByTagName('span').getAttribute('value');
          let accepted = $('#accepted').html();

          console.log(accepted);
          // debugger
          // let accepted = $("span.accepted").attr('id');
          // let rejected = $("span.rejected").attr('id');

          // if(accepted && rejected){
          //   alert(accepted,rejected);
          // debugger;
          // }

          // let accepted = $("#accepted").val();
          // let rejected = $("#rejected").val();

                if (null != lat && null != long) {
                    $.ajax({
                        url: '{{ route('home') }}',
                        method: 'GET',
                        type: 'GET',
                        success:'success',
                        data: {
                            lat: lat,
                            long: long
                        },
                        dataType: 'json',
                        success: function(response) {
                            if(response.status == true){

                                var new_data = new Array();
                                new_data = response.data;
                                console.log(new_data);

                                $(new_data).each(function(i,e){

                                    let salon_name = e.salon_name;
                                    let user_address = e.user_address;
                                    let offer_discount = e.offer_discount;

                                  let td1 = ``

                                    let div = `
                                                <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4  col-12 ">
                                                    <div class="card border-0 bg_grey-s">
                                                        <div class="position-absolute discount_large_ticket-s ">
                                                            <img src=${public_path}assets/images/home_page_component/absolute_second.svg 
                                                                class="img-fluid  " alt="...">
                                                                <div class="position-absolute discount_text-s">
                                                                    <h6 class="mb-0  text-white">Discount</h6>
                                                                    <span class=" text-white fs_9px-s">
                                                                        ${offer_discount}
                                                                    </span>
                                                                </div>
                                                        </div>
                                                        <div class="br_20px-s overflow-hidden h_380px-s img-hover-zoom">
                                                            <img src="${public_path}${brosches_path}"
                                                                class="card-img-top  img-fluid object_fit_cover-s" alt="...">
                                                        </div>


                                                        <div class="card-body mb-5 p-0 for_card_body_mll">

                                                            <h6 class="for_glitter_ups_csss mt-2 mb-0">${salon_name}</h6>
                                                            <p class="card-text ">
                                                                <span><i class="fa fa-map-marker m-0" aria-hidden="true"></i></span>
                                                                <span class="css_for_1681_vinee">${user_address}</span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                `
                                        $("#nearBySaloon").append(div);

                                })

                                $(".message_d").addClass('d-none');
                                // console.log(JSON.stringify(response));


                                // debugger;
                            }
                            
                        }
                    })
                }


        });
    </script>
  @endsection