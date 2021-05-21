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
              <li class="breadcrumb-item active">Coupon</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <form @if(empty($couponData['id'])) action="{{url('admin/add_edit_coupon')}}" @else action="{{url('admin/add_edit_coupon/'.$couponData['id'])}}"  @endif method="post" enctype="multipart/form-data" name="couponForm" id="couponForm">
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
                    <label for="coupon_option">Coupon Option*</label> <br>
                    <span>
                      <input type="radio" id="AutomaticCoupon" name="coupon_option" value="Automatic">Automatic&nbsp;&nbsp;
                    </span>
                    <span>
                      <input type="radio" id="ManualCoupon" name="coupon_option" value="Manual">Manual&nbsp;&nbsp;
                    </span>
                  </div>
              </div>

              <div class="col-md-6"  >
                  <div class="form-group" id="couponField" style="display:none">
                    <label for="coupon_code">Coupon Code</label>
                    <input type="text" name="coupon_code" class="form-control" id="coupon_code" placeholder="Enter coupon Code" >
                  </div>
              </div>

              <div class="col-md-6"  >
                  <div class="form-group" >
                    <label for="categories">Select Categories</label>
                    <select name="categories[]" id="categories" class="form-control select2" multiple=""
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
