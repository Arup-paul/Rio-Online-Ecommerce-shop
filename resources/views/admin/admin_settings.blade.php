
@extends('layouts.admin_layout.admin_layout')


@section('content')
<!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Settings</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">{{ucfirst($adminDetails->type)}} Settings</li>
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
                <h3 class="card-title">Update Password</h3>
              </div>
              <!-- success or error message file include -->
              @include('layouts.admin_layout.errors')
              <!-- /.card-header -->
              <!-- form start -->
              <form role="form" action="{{url('/admin/update-current-pwd')}}" method="post" name="updatePasswordForm" id="updatePasswordForm">
              @csrf
                <div class="card-body">
                  <div class="form-group">
                  
                    <label for="email"> Email</label>
                    <input readonly value="{{$adminDetails->email}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="type"> Type</label>
                    <input readonly value="{{ $adminDetails->type}}" class="form-control">
                  </div>
                  <div class="form-group">
                    <label for="password1">Current Password</label>
                    <input type="password"  class="form-control" name="current_pwd" id="current_pwd" placeholder="Enter Current Password" required="">
                    <span id="check_current_password"></span>
                  </div>
                  <div class="form-group">
                    <label for="password2">New Password</label>
                    <input type="password" class="form-control" required="" name="password" id="password" placeholder="Enter New Password">
                  </div>
                  <div class="form-group">
                    <label for="password3">Confirm Password</label>
                    <input type="password" class="form-control" required="" name="password_confirmation"  id="password_confirmation" placeholder="Enter Confirm Password">
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
