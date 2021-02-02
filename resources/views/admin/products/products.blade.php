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
              <li class="breadcrumb-item active">Products</li>
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
                <h3 class="card-title">Products</h3>
              <a href="{{url('admin/add_edit_product')}}"  class="btn btn-success float-right">Add Product</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Color</th>
                    <th>Product Image</th>
                    <th>Category</th>
                    <th>Section</th>
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>

                      @foreach($products as $product)


                  <tr>
                  <td>{{$product->id}}</td>
                  <td>{{$product->product_name}}</td>
                  <td>{{$product->product_code}}</td>
                  <td>{{$product->product_color}}</td>
                  <td>

                      <?php $product_image_path = "images/products_images/small/".$product->main_image; ?>
                      @if(!empty($product->main_image) && file_exists($product_image_path))
                       <img style="width:100px" src="{{asset('images/products_images/small/'.$product->main_image)}}" >
                      @else
                      <img style="width:100px"  src="{{asset('images/products_images/small/no-image.png')}}" alt="No Img">
                      @endif
                  </td>
                  <td >@if($product->category)
                      {{$product->category->category_name}}
                      @endif
                    </td>
                  <td>
                      @if($product->section)
                      {{$product->section->name}}
                        @endif
                    </td>

                  <td>
                        @if($product->status == 1)
                        <a href="javascript:void(0)" class="badge badge-success updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}"> Active</a>
                      @elseif($product->status == 0)
                          <a href="javascript:void(0)" class="badge badge-danger updateProductStatus" id="product-{{$product->id}}" product_id="{{$product->id}}"> InActive</a>
                      @endif
                  </td>
                <td>
                    <a title="Add/Edit Attributes" href="{{url('admin/add_attributes/'.$product->id)}}" class="btn btn-outline-success btn-sm"><i class="fa fa-plus"></i></a>
                    <a title="Add Images" href="{{url('admin/add_images/'.$product->id)}}" class="btn btn-outline-secondary btn-sm"><i class="fa fa-plus-circle"></i></a>
                    <a title="Edit Product" href="{{url('admin/add_edit_product/'.$product->id)}}" class="btn btn-outline-info btn-sm"><i class="fa fa-edit"></i></a>
                    <a title="Delete Product" href="javascript:void(0)" record="product" recordid="{{$product->id}}"  class="btn btn-outline-danger btn-sm confirmDelete"><i class="fa fa-trash"></i></a>
            </td>
                  </tr>
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Product Name</th>
                    <th>Product Code</th>
                    <th>Product Color</th>
                    <th>Product Image</th>
                    <th>Category</th>
                    <th>Section</th>
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
