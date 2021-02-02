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
              <li class="breadcrumb-item active">Banners</li>
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
                <h3 class="card-title">Banners</h3>
              <a href="{{url('admin/add_edit_banner')}}"  class="btn btn-success float-right">Add Banner</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Image</th>
                    <th>Link</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($banners as $banner)
                  <tr>
                  <td>{{$banner['id']}}</td>
                  <td>{{$banner['title']}}</td>
                  <td>
                   <img src="{{url('images/banner_images/',$banner['image'])}}" width="150px" height="150px" alt="">
                  </td>
                  <td>{{$banner['link']}}</td>
                  <td>
                        @if($banner['status'] == 1)
                        <a title="Active" href="javascript:void(0)" class="text-lg   updateBannerStatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}"> <i class="fa fa-toggle-on " status="Active"></i></a>
                    @elseif($banner['status']== 0)
                        <a title="Inactive" href="javascript:void(0)" class=" text-lg  updateBannerStatus" id="banner-{{$banner['id']}}" banner_id="{{$banner['id']}}"> <i class="fa fa-toggle-off " status="InActive"></i></a>
                    @endif
                  </td>
                <td>
                    <a href="{{url('admin/add_edit_banner/'.$banner['id'])}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                    <a href="javascript:void(0)" record="banner" recordid="{{$banner['id']}}"  class="btn btn-danger btn-sm confirmDelete"><i class="fa fa-trash"></i></a>
                 </td>
                  </tr>
                  
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Parent banner</th>
                    <th>banner Name</th>
                    <th>Section</th>
                    <th>URL</th>
                    {{-- <th>Images</th> --}}
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
