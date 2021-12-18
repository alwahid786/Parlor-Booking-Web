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
                      <th class="sorting" tabindex="0" aria-controls="example2" rowspan="1" colspan="1" >Discount</th>
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
                        <td>
                          <div class="btn btn-primary discount" data-toggle="modal" data-target="#exampleModal" id="{{$salon->id}}">Discount</div>
                        </td>
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
                        @if($salon->status == 'pending')
                        <td class="action">
                          <div class="d-flex">
                            <span class="btn btn-info accepted" id="{{$salon->id}}" value="accepted" }}>accepted</span>                                
                            <span class="btn btn-danger rejected" id="{{$salon->id}}" value="rejected" data-src={{$salon->id}}>rejected</span>      
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
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Enter Discount</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>
                <div class="modal-body">
                  <form>
                    <div class="form-group">
                      <label for="recipient-name" class="col-form-label">Enter Discount:</label>
                      <input  type="number" min="0" max="99" class="form-control" id="discount-amount">
                    </div>
                    
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary submit-discount" data-dismiss="modal" id="submit-discount">Submit</button>
                </div>
              </div>
            </div>
        </div>
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
                data:{
                      status: status,
                      statusId: statusId
                    },
                    dataType: 'json',
                    success: function(response) {
                      if(response.status ==  'accepted'){
                        statusAccepted = response.status;                
                        console.log(statusAccepted );
                      }
                      if(response.status ==  'rejected'){
                        statusRejected = response.status;
                        // $(".action").addClass("d-none");
                        console.log(statusRejected );
                      }
                    }

                });
                if($(this).attr("value") == "accepted"){
                  var value = $(this);
                  console.log(value,'value print');
                  value.parents(".action").addClass("d-none");
                  console.log(value.parents(".action").hasClass("d-block"));
                  let parent = value.parents(".odd").find(".btn-warning");
                  parent.removeClass("btn-warning").addClass("btn-info").text("accepted");
                }
                if($(this).attr("value") == "rejected"){
                  var value = $(this);
                  value.parents(".action").addClass("d-none");
                  console.log(value.parents(".action").hasClass("d-block"));
                  let parent = value.parents(".odd").find(".btn-warning");
                  parent.removeClass("btn-warning").addClass("btn-danger").text("rejected");
                }
          });
          $(".discount").click(function(){
            discountId = $(this).attr('id');
            $("#submit-discount").click(function(){
              var discountAmount = document.getElementById("discount-amount").value;
              if(discountAmount){
                $.ajax({
                  url: '{{ route('discountAdd') }}',
                  method: 'GET',
                  type: 'GET',
                  success:'success',
                  data:{
                        discountAmount: discountAmount,
                        discountId: discountId
                      },
                      dataType: 'json',
                      success: function(response) {
                   
                      
                      }

                  });
              }
            console.log(discount);
           });
         });
        });
    </script>
  @endsection