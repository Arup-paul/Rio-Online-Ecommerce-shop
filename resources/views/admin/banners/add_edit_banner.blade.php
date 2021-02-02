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
      <form @if(empty($bannerData['id'])) action="{{url('admin/add_edit_banner')}}" @else action="{{url('admin/add_edit_banner/'.$bannerData['id'])}}"  @endif method="post" enctype="multipart/form-data" name="bannerForm" id="bannerForm">
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
                    <label for="title">Banner Title*</label>
                    <input type="text" name="title" class="form-control" id="title" placeholder="Enter banner Name" @if(!empty($bannerData['title'])) value="{{$bannerData['title']}}" @else value="{{old('title')}}" @endif>
                  </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                    <label for="image">Banner Image*</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="image" class="custom-file-input" id="image" accept="image/*">
                        <label class="custom-file-label" for="image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                       </div>
                       </div>
                      @if(!empty($bannerData['image']))
                      <div >
                        <img style="width: 200px; margin-top:5px;" src="{{asset('images/banner_images/'.$bannerData->image)}}"   alt="">&nbsp;
                      {{-- <a href="javascript:void(0)" record="image" recordid="{{$bannerData['id']}}"  class="text text-danger confirmDelete"><i class="fa fa-trash"></i></a> --}}
                        </div>
                      @endif


                </div>


              </div>
                 <div class="col-md-6">
                        <div class="form-group">
                            <label for="link">Banner Link</label>
                            <input type="text" name="link" class="form-control" id="link" placeholder="Enter banner link" @if(!empty($bannerData['link'])) value="{{$bannerData['link']}}" @else value="{{old('link')}}" @endif>
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
