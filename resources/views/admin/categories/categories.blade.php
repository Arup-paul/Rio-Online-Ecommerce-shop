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
        <div class="row">
          <div class="col-12">
              @include('layouts.admin_layout.errors')

            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Categories</h3>
              <a href="{{url('admin/add_edit_category')}}"  class="btn btn-success float-right">Add Category</a>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Parent Category</th>
                    <th>Category Name</th>
                    <th>Section</th>
                    <th>URL</th>
                    {{-- <th>Images</th> --}}
                    <th>Status</th>
                    <th>Action</th>
                  </tr>
                  </thead>
                  <tbody>
                      @foreach($categories as $category)
                      @if(!isset($category->parentCategory->category_name))
                      <?php $parent_category = "Root";?>
                      @else
                      <?php $parent_category = $category->parentCategory->category_name;?>
                      @endif

                  <tr>
                  <td>{{$category->id}}</td>
                  <td>{{$parent_category}}</td>
                  <td>{{$category->category_name}}</td>
                  <td>{{$category->section->name}}</td>
                  <td>{{$category->url}}</td>
                 {{-- <td>
                  <img src="{{url('images/categories_images/',$category->category_image)}}" width="150px" height="150px" alt="">
                  </td> --}}
                  <td>
                      @if($category->status == 1)
                        <a href="javascript:void(0)" class="badge badge-success updateCategoryStatus" id="category-{{$category->id}}" category_id="{{$category->id}}"> Active</a>
                      @elseif($category->status == 0)
                          <a href="javascript:void(0)" class="badge badge-danger updateCategoryStatus" id="category-{{$category->id}}" category_id="{{$category->id}}"> InActive</a>
                      @endif
                  </td>
                <td><a href="{{url('admin/add_edit_category/'.$category->id)}}" class="btn btn-info btn-sm"><i class="fa fa-edit"></i></a>
                <a href="javascript:void(0)" record="category" recordid="{{$category->id}}"  class="btn btn-danger btn-sm confirmDelete"><i class="fa fa-trash"></i></a></td>
                  </tr>
                  {{-- href="{{url('admin/delete_category/'.$category->id)}}" --}}
                  @endforeach
                  </tbody>
                  <tfoot>
                  <tr>
                    <th>ID</th>
                    <th>Parent Category</th>
                    <th>Category Name</th>
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
