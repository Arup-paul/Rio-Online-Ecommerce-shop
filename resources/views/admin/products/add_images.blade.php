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
                            <li class="breadcrumb-item active">Product Images</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <form method="post"  name="addimageForm" id="addimageForm" action="{{url('admin/add_images/'.$productData['id'])}}" enctype="multipart/form-data">
                    @csrf
                    <div class="card card-default">
                        {{-- flash message --}}
                        @include('layouts.admin_layout.errors')

                        <div class="card-header">
                            <h3 class="card-title">Product Images</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="product_name">Product Name:</label>&nbsp; {{$productData['product_name']}}
                                    </div>
                                     <div class="form-group">
                                        <label for="product_name">Product Code: </label>&nbsp; {{$productData['product_code']}}
                                    </div>
                                     <div class="form-group">
                                        <label for="product_name">Product Color: </label>&nbsp; {{$productData['product_color']}}
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                            <img style="width: 80px; margin-top:5px;"
                                                src="{{ asset('images/products_images/small/' . $productData['main_image']) }}"
                                                alt="">
                                    </div>
                                </div>

                                 <div class="col-md-12">
                                    <div class="form-group">
                                           <div class="field_wrapper">
                                               <div>
                                                   <input multiple="" id="images" required  type="file" name="images[]"  placeholder="Add Product Images" />
                                               </div>
                                           </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"> Add Images</button>
                        </div>
                    </div>
              </form>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <form method="post"  name="updateattrForm" id="updateattrForm" action="{{url('admin/edit_images/'.$productData['id'])}}">@csrf
                    <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">Added Product Images</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>ID</th>
                            <th>Image</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($productData['images'] as $image)
                            <tr>
                            <input type="hidden" name="attrId[]" value="{{$image['id']}}">
                            <td width="20%">{{$image['id']}}</td>
                            <td>
                                <img style="width: 150px; margin-top:5px;"
                                src="{{ asset('images/products_images/small/' . $image['image']) }}"
                                alt=""></td>
                           <td width="20%">
                            @if($image['status'] == 1)
                            <a href="javascript:void(0)" class="badge badge-success updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}"> Active</a>
                          @elseif($image['status'] == 0)
                              <a href="javascript:void(0)" class="badge badge-danger updateImageStatus" id="image-{{$image['id']}}" image_id="{{$image['id']}}"> InActive</a>
                          @endif
                            <a title="Delete Image" href="javascript:void(0)" record="image" recordid="{{$image['id']}}"  class="btn btn-danger btn-sm confirmDelete"><i class="fa fa-trash"></i></a>
                         </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Image</th>
                                    <th>Action</th>
                                    </tr>
                            </tfoot>
                        </table>
                        </div>
                        {{-- <div class="card-footer">
                            <button type="submit" class="btn btn-primary"> Update Images</button>
                        </div> --}}
                    </div>

                </form>

                    </div>
        </section>
    </div>


@endsection
