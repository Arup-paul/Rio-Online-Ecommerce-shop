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
                <form @if (empty($productData['id']))
                action="{{ url('admin/add_edit_product') }}" @else
                    action="{{ url('admin/add_edit_product/' . $productData['id']) }}" @endif
                    method="post" enctype="multipart/form-data" name="productForm" id="productForm">
                    @csrf
                    <div class="card card-default">
                        {{-- flash message --}}
                        @include('layouts.admin_layout.errors')

                        <div class="card-header">
                            <h3 class="card-title">{{ $title }}</h3>

                            <div class="card-tools">
                                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i
                                        class="fas fa-minus"></i></button>
                            </div>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <span class="text-red">* mark field must be fill up</span>
                            <div class="row">

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Category*</label>
                                        <select name="category_id" id="category_id" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($categories as $section)
                                             <optgroup label="{{$section['name']}}"></optgroup>
                                             @foreach ($section['categories'] as $category)
                                                 <option value="{{$category['id']}}" @if(!empty(@old('category_id')) && $category['id'] == @old('category_id')) selected="" @elseif(!empty($productData['category_id']) && $productData['category_id'] == $category['id']) selected=""  @endif>&nbsp;&nbsp;--&nbsp;&nbsp;{{$category['category_name']}}
                                                </option>
                                                    @foreach ($category['subcategories'] as $subcategory)
                                                 <option value="{{$subcategory['id']}}" @if(!empty(@old('category_id')) && $subcategory['id'] == @old('category_id')) selected="" @elseif(!empty($productData['category_id']) && $productData['category_id'] == $subcategory['id']) selected="" @endif>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;--&nbsp;{{$subcategory['category_name']}}
                                                </option>
                                                    @endforeach
                                             @endforeach
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Select Brand*</label>
                                        <select class="form-control" name="brand_id" id="brand_id">
                                            <option value="">select </option>
                                            @foreach($brands as $brand)
                                             <option value="{{$brand['id']}}"  @if(!empty($productData['brand_id']) && $productData['brand_id'] == $brand['id']) selected="" @endif>{{$brand['name']}}</option>
                                            @endforeach
                                        </select>

                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_name">Product Name*</label>
                                        <input type="text" name="product_name" class="form-control" id="product_name"
                                            placeholder="Enter product Name" @if (!empty($productData['product_name']))
                                    value="{{ $productData['product_name'] }}" @else value="{{ old('product_name') }}"
                                        @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_color">Product Color*</label>
                                        <input type="text" name="product_color" class="form-control" id="product_color"
                                            placeholder="Enter product color" @if (!empty($productData['product_color']))
                                    value="{{ $productData['product_color'] }}" @else value="{{ old('product_color') }}"
                                        @endif>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_discount">Product Discount*</label>
                                        <input type="text" name="product_discount" class="form-control"
                                            id="product_discount" placeholder="Enter product Dsicount" @if (!empty($productData['product_discount']))
                                    value="{{ $productData['product_discount'] }}" @else
                                        value="{{ old('product_discount') }}" @endif>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_weight">Product Weight*</label>
                                        <input type="text" name="product_weight" class="form-control" id="product_weight"
                                            placeholder="Enter Product weight" @if (!empty($productData['product_weight']))
                                            value="{{ $productData['product_weight'] }}" @else
                                            value="{{ old('product_weight') }}" @endif>
                                     </div>
                                </div>
                                <div class="col-md-6">

                                    <div class="form-group">
                                        <label for="product_name">Product Code*</label>
                                        <input type="text" name="product_code" class="form-control" id="product_code"
                                            placeholder="Enter product code" @if (!empty($productData['product_code']))
                                    value="{{ $productData['product_code'] }}" @else value="{{ old('product_code') }}"
                                        @endif>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_price">Product Main Price*</label>
                                        <input type="text" name="product_price" class="form-control" id="product_price"
                                            placeholder="Enter product price" @if (!empty($productData['product_price']))
                                    value="{{ $productData['product_price'] }}" @else value="{{ old('product_price') }}"
                                        @endif>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="product_price">Product Video*</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="product_video" class="custom-file-input"
                                                    id="product_video" accept="video/*">
                                                <label class="custom-file-label" for="product_video">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>
                                        </div>
                                         @if (!empty($productData['product_video']))
                                            <div>
                                            <a class="text text-sm text-success" download href="{{url('videos/product_videos/'.$productData['product_video'])}}"><i class="fa fa-download"></i></a> ||
                                              <a href="javascript:void(0)" record="product_video"
                                                    recordid="{{ $productData['id'] }}"
                                                    class="text text-danger confirmDelete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="main_image">Product Image*</label>
                                        <div class="input-group">
                                            <div class="custom-file">
                                                <input type="file" name="main_image" class="custom-file-input"
                                                    id="main_image" accept="image/*">
                                                <label class="custom-file-label" for="main_image">Choose file</label>
                                            </div>
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="">Upload</span>
                                            </div>

                                        </div>Recommended Image Size: Width:1040px; Height:1200px;
                                        @if (!empty($productData['main_image']))
                                            <div>
                                                <img style="width: 80px; margin-top:5px;"
                                                    src="{{ asset('images/products_images/small/' . $productData['main_image']) }}"
                                                    alt="">&nbsp;
                                                <a href="javascript:void(0)" record="product_image"
                                                    recordid="{{ $productData['id'] }}"
                                                    class="text text-danger confirmDelete"><i class="fa fa-trash"></i></a>
                                            </div>
                                        @endif

                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_title">Wash Care</label>
                                        <textarea name="wash_care" class="form-control" id="wash_care"
                                            placeholder="Enter Wash Care">@if (!empty($productData['wash_care'])) {{ $productData['wash_care'] }} @else {{ old('wash_care') }} @endif</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Fabric</label>
                                        <select name="fabric" id="fabric" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($fabricArray as $fabric)
                                             <option value="{{$fabric}}"  @if(!empty($productData['fabric']) && $productData['fabric'] = $fabric) selected="" @endif>{{$fabric}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Sleeve</label>
                                        <select name="sleeve" id="sleeve" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($sleeveArray as $sleeve)
                                             <option value="{{$sleeve}}" @if(!empty($productData['sleeve']) && $productData['sleeve'] = $sleeve) selected="" @endif>{{$sleeve}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Pattern</label>
                                        <select name="pattern" id="pattern" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($patternArray as $pattern)
                                             <option value="{{$pattern}} @if(!empty($productData['pattern']) && $productData['pattern'] = $pattern) selected="" @endif">{{$pattern}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Fit</label>
                                        <select name="fit" id="fit" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($fitArray as $fit)
                                             <option value="{{$fit}}" @if(!empty($productData['fit']) && $productData['fit'] = $fit) selected="" @endif>{{$fit}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Select Occasion</label>
                                        <select name="occasion" id="occasion" class="form-control select2"
                                            style="width: 100%;">
                                            <option value="">Select</option>
                                            @foreach($occasionArray as $occasion)
                                             <option value="{{$occasion}}" @if(!empty($productData['occasion']) && $productData['occasion'] = $occasion) selected="" @endif >{{$occasion}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="description">Product Description</label>
                                        <textarea name="description" id="description" placeholder="Enter Description"
                                            class="form-control">@if (!empty($productData['description'])) {{ $productData['description'] }} @else {{ old('description') }} @endif</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <textarea name="meta_title" class="form-control" id="meta_title"
                                            placeholder="Enter Meta Title">@if (!empty($productData['meta_title'])) {{ $productData['meta_title'] }} @else {{ old('meta_title') }} @endif</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea name="meta_description" class="form-control" id="meta_description"
                                            placeholder="Enter Meta Description"> @if (!empty($productData['meta_description'])) {{ $productData['meta_description'] }} @else {{ old('meta_description') }} @endif</textarea>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="meta_keywords">Meta Keywords</label>
                                        <textarea name="meta_keywords" class="form-control" id="meta_keywords"
                                            placeholder="Enter Meta Keywords">@if (!empty($productData['meta_keywords'])) {{ $productData['meta_keywords'] }} @else {{ old('meta_keywords') }} @endif</textarea>
                                    </div>
                                </div>
                                  <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="is_featured"> Featured Item</label>
                                        <input type="checkbox" value="Yes"  name="is_featured" id="is_featured" @if (!empty($productData['is_featured']) && $productData['is_featured'] == "Yes") checked=""  @endif>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{ $title }}</button>
                        </div>

                </form>
            </div>
        </section>


@endsection
