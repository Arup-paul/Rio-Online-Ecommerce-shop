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
        <div class="row">
          <div class="col-12">
            @include('layouts.admin_layout.errors')
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Brands</h3>
                <a href="{{url('admin/add_edit_brand')}}"  class="btn btn-success float-right">Add Brand</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($brands as $brand)
                  <tr>
                  <td>{{$brand->id}}</td>
                  <td>{{$brand->name}}</td>
                  <td>
                      @if($brand->status == 1)
                        <a title="Active" href="javascript:void(0)" class="text-lg   updateBrandStatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}"> <i class="fa fa-toggle-on " status="Active"></i></a>
                      @elseif($brand->status == 0)
                          <a title="Inactive" href="javascript:void(0)" class=" text-lg  updateBrandStatus" id="brand-{{$brand->id}}" brand_id="{{$brand->id}}"> <i class="fa fa-toggle-off " status="InActive"></i></a>
                      @endif
                  <a title="Edit Brands" href="{{url('/admin/add_edit_brand',$brand->id)}}" class="btn btn-outline-info btn-sm"><i class="fa fa-edit"></i></a>
                      <a title="Delete brand" href="javascript:void(0)" record="brand" msg="Delete This Brand" recordid="{{$brand->id}}"  class="btn btn-outline-danger btn-sm confirmDelete"><i class="fa fa-trash"></i></a>
                  </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Status</th>
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
