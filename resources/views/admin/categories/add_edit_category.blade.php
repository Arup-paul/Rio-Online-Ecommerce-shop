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
              <li class="breadcrumb-item active">Categories</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      <form @if(empty($categoryData['id'])) action="{{url('admin/add_edit_category')}}" @else action="{{url('admin/add_edit_category/'.$categoryData['id'])}}"  @endif method="post" enctype="multipart/form-data" name="categoryForm" id="categoryForm">
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
               <span class="text-red">* field must not be empty</span>
            <div class="row">
              <div class="col-md-6">

                  <div class="form-group">
                  <label for="category_name">Category Name*</label>
                   <input type="text" name="category_name" class="form-control" id="category_name" placeholder="Enter Category Name" @if(!empty($categoryData['category_name'])) value="{{$categoryData['category_name']}}" @else value="{{old('category_name')}}" @endif>
                </div>
               <div id="appendCategoriesLevel">
                    @include('admin.categories.append_categories_level')
                 </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Select Section*</label>
                  <select name="section_id" id="section_id" class="form-control select2" style="width: 100%;">
                    <option value="">Select</option>
                    @foreach($getsections as $section)
                  <option value="{{$section->id}}" @if(!empty($categoryData['section_id']) && $categoryData['section_id'] == $section->id) selected @endif>{{$section->name}}</option>
                  @endforeach
                  </select>
                </div>
                <div class="form-group">
                    <label for="category_image">Category Image*</label>
                    <div class="input-group">
                      <div class="custom-file">
                        <input type="file" name="category_image" class="custom-file-input" id="category_image" accept="image/*">
                        <label class="custom-file-label" for="category_image">Choose file</label>
                      </div>
                      <div class="input-group-append">
                        <span class="input-group-text" id="">Upload</span>
                      </div>
                       </div>
                      @if(!empty($categoryData['category_image']))
                      <div >
                        <img style="width: 80px; margin-top:5px;" src="{{asset('images/categories_images/'.$categoryData->category_image)}}"   alt="">&nbsp;
                      <a href="javascript:void(0)" record="category_image" recordid="{{$categoryData['id']}}"  class="text text-danger confirmDelete"><i class="fa fa-trash"></i></a>
                        </div>
                      @endif
                      {{-- href="{{url('admin/delete_category_image/'.$categoryData->id)}}" --}}

                </div>


              </div>
            </div>
              <div class="row">
                  <div class="col-md-6">
                        <div class="form-group">
                            <label for="category_discount">Category Discount</label>
                            <input type="text" name="category_discount" class="form-control" id="category_discount" placeholder="Enter Category Discount" @if(!empty($categoryData['category_discount'])) value="{{$categoryData['category_discount']}}" @else value="{{old('category_discount')}}" @endif>
                       </div>
                  </div>


                       <div class="col-md-6">
                        <div class="form-group">
                            <label for="url">Category Url*</label>
                            <input type="text" name="url" class="form-control" id="url" placeholder="Enter Category Url" @if(!empty($categoryData['url'])) value="{{$categoryData['url']}}" @else value="{{old('url')}}" @endif>
                       </div>
                       </div>
                        <div class="col-md-6">
                            <div class="form-group">
                            <label for="description">Category Description</label>
                            <textarea name="description" id="description" placeholder="Enter Description"  class="form-control" >@if(!empty($categoryData['description'])) {{$categoryData['description']}} @else {{old('description')}} @endif</textarea>
                       </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                            <label for="meta_title">Meta Title</label>
                            <textarea name="meta_title" class="form-control" id="meta_title" placeholder="Enter Meta Title" >@if(!empty($categoryData['meta_title'])) {{$categoryData['meta_title']}} @else {{old('meta_title')}} @endif</textarea>
                       </div>
                       </div>
                       <div class="col-md-6">
                           <div class="form-group">
                            <label for="meta_description">Meta Description</label>
                            <textarea name="meta_description" class="form-control" id="meta_description" placeholder="Enter Meta Description"> @if(!empty($categoryData['meta_description'])) {{$categoryData['meta_description']}} @else {{old('meta_description')}} @endif</textarea>
                       </div>
                       </div>
                        <div class="col-md-6">
                           <div class="form-group">
                            <label for="meta_keywords">Meta Keywords</label>
                            <textarea name="meta_keywords" class="form-control" id="meta_keywords" placeholder="Enter Meta Keywords" >@if(!empty($categoryData['meta_keywords'])) {{$categoryData['meta_keywords']}} @else {{old('meta_keywords')}} @endif</textarea>
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
