
@extends('layouts.admin_layout.admin_layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Update Admin Details</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ucfirst($adminDetails->type)}} Details</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

   <!-- Main content -->
   <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-6">
            <!-- general form elements -->
            <div class="card card-success">
              <div class="card-header">
                <h3 class="card-title">Update Admin Details</h3>
              </div>
              <!-- success or error message file include -->
              @include('layouts.admin_layout.errors')
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{url('/admin/updateAdminDetails')}}" method="post" name="updateadminDetailsForm" id="updateadminDetailsForm"enctype="multipart/form-data" >
              @csrf
                <div class="card-body">
                  <div class="form-group">
                  <div class="form-group">
                    <label for="email"> Email</label>
                    <input readonly value="{{$adminDetails->email}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="type"> Type</label>
                    <input readonly value="{{$adminDetails->type}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="name">{{ ucfirst($adminDetails->type)}}  Name</label>
                    <input type="text" required=""  value="{{ $adminDetails->name}}" name="name" id="name" class="form-control" placeholder="Enter {{ ucfirst($adminDetails->type)}} Name">
                  </div>
                  <div class="form-group">
                    <label for="name">{{ ucfirst($adminDetails->type)}}  Mobile No</label>
                    <input type="text" required=""  value="{{ $adminDetails->mobile}}" name="mobile" id="mobile" class="form-control" placeholder="Enter {{ ucfirst($adminDetails->type)}} Name">
                  </div>

                  <div class="form-group">
                    <label for="name">{{ ucfirst($adminDetails->type)}}  Image</label>
                    <input type="file"  name="image" id="image" class="form-control" placeholder="Enter {{ ucfirst($adminDetails->type)}} Image" accept="image/*">
                    @if (!empty(Auth::guard('admin')->user()->image))
                  <a target="_blank" href="{{url('images/admin_images/admin_photos/'.Auth::guard('admin')->user()->image)}}">View Image</a>
                     <input type="hidden" name="current_admin_image" value="{{Auth::guard('admin')->user()->image}}">
                    @endif
                  </div>




                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" class="btn btn-success">Update</button>
                </div>
              </form>
            </div>
            <!-- /.card -->



          </div>

        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->

  </div>

  @endsection
