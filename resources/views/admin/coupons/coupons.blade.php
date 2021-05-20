@extends('layouts.admin_layout.admin_layout')

@section('content')
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Catalogues</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Coupons</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
 <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
              @include('layouts.admin_layout.errors')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Coupons</h3>
              <a href="#"  class="btn btn-success float-right">Add Coupons</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Coupon Option</th>
                    <th>Coupon Code</th>
                    <th>Categories</th>
                    <th>Users</th> 
                    <th>Coupon Type</th> 
                    <th>Amount Type</th> 
                    <th>Amount</th> 
                    <th>Expiry Date</th>  
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody> 
                      @foreach($coupons as $key =>  $coupon) 
                  <tr>
                  
                  <td>{{$coupon['id']}}</td>  
                  <td>{{$coupon['coupon_option']}}</td> 
                  <td>{{$coupon['coupon_code']}}</td> 
                  <td>{{$coupon['categories']}}</td> 
                  <td>{{$coupon['users']}}</td> 
                  <td>{{$coupon['coupon_type']}}</td> 
                  <td>{{$coupon['amount_type']}}</td> 
                  <td>{{$coupon['amount']}} 
                       @if($coupon['amount_type'] == "Percentage") 
                        % 
                       @else
                       TK
                       @endif
                  </td> 
                  <td>{{$coupon['expiry_date']}}</td>  
                  <td>
                      @if($coupon['status'] == 1)
                        <a href="javascript:void(0)" class="badge badge-success updatecouponStatus" id="coupon-{{$coupon['id']}}" coupon_id="{{$coupon['id']}}"> Active</a>
                      @elseif($coupon['status'] == 0)
                          <a href="javascript:void(0)" class="badge badge-danger updatecouponStatus" id="coupon-{{$coupon['id']}}" coupon_id="{{$coupon['id']}}"> InActive</a>
                      @endif
                  </td>
                <td><a href="{{url('admin/add_edit_coupon/'.$coupon['id'])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" record="coupon" recordid="{{$coupon['id']}}"  class="btn btn-danger btn-sm confirmDelete"><i class="fa fa-trash"></i></a></td>
                  </tr>
    
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Coupon Option</th>
                    <th>Coupon Code</th>
                    <th>Categories</th>
                    <th>Users</th> 
                    <th>Coupon Type</th> 
                    <th>Amount Type</th> 
                    <th>Amount</th> 
                    <th>Expiry Date</th>  
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </tfoot>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          </div>
        </div>
      </div>
    </section>
  </div>


@endsection
