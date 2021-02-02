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
              <li class="breadcrumb-item active">Brands</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <form @if(empty($brandData['id'])) action="{{url('admin/add_edit_brand')}}" @else action="{{url('admin/add_edit_brand/'.$brandData['id'])}}"  @endif method="post" enctype="multipart/form-data" name="brandForm" id="brandForm">
         @csrf
        <div class="card card-default">

           @include('layouts.admin_layout.errors')
          <div class="card-header">
          <h3 class="card-title">{{$title}}</h3>

            <div class="card-tools">
              <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i></button>
            </div>
          </div>
          <!-- /.card-header -->

          <div class="card-body">
            <div class="row">
              <div class="col-md-6">

                  <div class="form-group">
                  <label for="name">Brand Name*</label>
                   <input type="text" name="name" class="form-control" id="name" placeholder="Enter Brand Name" @if(!empty($brandData['name'])) value="{{$brandData['name']}}" @else value="{{old('name')}}" @endif>
                </div>
              </div>

            </div>
          </div>
              <div class="card-footer">
                <button type="submit" class="btn btn-primary">{{$title}}</button>
                </div>
         </div>

        </form>



        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>


@endsection
