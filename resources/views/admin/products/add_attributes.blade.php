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
                            <li class="breadcrumb-item active">attributes Attributes</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
            <form method="post"  name="addattrForm" id="addattrForm" action="{{url('admin/add_attributes/'.$productData['id'])}}">
                    @csrf
                    <div class="card card-default">
                        {{-- flash message --}}
                        @include('layouts.admin_layout.errors')

                        <div class="card-header">
                            <h3 class="card-title">Product Attributes</h3>

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
                                                  <input type="hidden" name="product_id" value="{{$productData['id']}}">
                                                   <input id="size" required  type="text" name="size[]"  placeholder="Size" style="width: 120px;"/>
                                                   <input id="sku" style="width: 120px;" required type="text" name="sku[]" placeholder="SKU"/>
                                                   <input id="price" required style="width: 120px;"  type="number" name="price[]"placeholder="Price"/>
                                                   <input id="stock" required style="width: 120px;"  type="number" name="stock[]"  placeholder="Stock"/>
                                                   <a href="javascript:void(0);" class="add_button btn btn-sm btn-info" title="add"><i class="fa fa-plus"></i></a>
                                               </div>
                                           </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"> Add Attribute</button>
                        </div>
                    </div>
              </form>
            </div>
        </section>

        <section class="content">
            <div class="container-fluid">
                <form method="post"  name="updateattrForm" id="updateattrForm" action="{{url('admin/edit_attributes/'.$productData['id'])}}">@csrf
                    <div class="card">
                     <div class="card-header">
                        <h3 class="card-title">Added Product Attribute</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                            <th>ID</th>
                            <th>Size</th>
                            <th>Sku</th>
                            <th>Price</th>
                            <th>Stock</th>
                            <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>

                                @foreach($productData['attributes'] as $attribute)


                            <tr>
                            <input type="hidden" name="attrId[]" value="{{$attribute['id']}}">
                            <td>{{$attribute['id']}}</td>
                            <td>{{$attribute['size']}}</td>
                            <td>{{$attribute['sku']}}</td>
                            <td>
                              <input type="number" name="price[]" value="{{$attribute['price']}}">
                            </td>
                            <td>
                                 <input type="number" name="stock[]" value="{{$attribute['stock']}}">
                                </td>

                           <td>
                            @if($attribute['status'] == 1)
                            <a href="javascript:void(0)" class="badge badge-success updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}"> Active</a>
                          @elseif($attribute['status'] == 0)
                              <a href="javascript:void(0)" class="badge badge-danger updateAttributeStatus" id="attribute-{{$attribute['id']}}" attribute_id="{{$attribute['id']}}"> InActive</a>
                          @endif
                            <a title="Delete Attribute" href="javascript:void(0)" record="attribute" recordid="{{$attribute['id']}}"  class="btn btn-danger btn-sm confirmDelete"><i class="fa fa-trash"></i></a>
                         </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                                <tr>
                                    <th>ID</th>
                                    <th>Size</th>
                                    <th>Sku</th>
                                    <th>Price</th>
                                    <th>Stock</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                        </table>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary"> Update Attribute</button>
                        </div>
                    </div>

                </form>

                    </div>
        </section>
    </div>


@endsection
