@extends('layouts.frontend_layout.front_layout')
@section('main_content')
<div class="span9">
			<ul class="breadcrumb">
				<li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
				<li class="active"><?php echo $categoryDetails['bredcrumbs'] ?></li>
			</ul>
			<h3> {{$categoryDetails['categoryDetails']['category_name']}} <small class="pull-right"> {{count($categoryProducts)}} products are available </small></h3>
			<hr class="soft"/>
			<p>
				{{ $categoryDetails['categoryDetails']['description']}}
			</p>
			<hr class="soft"/>
			<form name="sortProducts" id="sortProducts" class="form-horizontal span6">
                   <input type="hidden" name="url" id="url" value="{{$url}}">
				<div class="control-group">
					<label class="control-label alignL">Sort By </label>
					<select name="sort" id="sort">
						<option value="">Select</option>
						<option value="product_latest" @if(isset($_GET['sort']) && $_GET['sort'] == "product_latest" ) selected @endif>Latest Products</option>
						<option value="product_name_a_z" @if(isset($_GET['sort']) && $_GET['sort'] == "product_name_a_z" ) selected @endif>Product Name A - Z</option>
						<option value="product_latest_z_a" @if(isset($_GET['sort']) && $_GET['sort'] == "product_latest_z_a" ) selected @endif>Product Name Z - A</option>
						<option value="price_lowest" @if(isset($_GET['sort']) && $_GET['sort'] == "price_lowest" ) selected @endif>Lowest Price List</option>
						<option value="price_highest" @if(isset($_GET['sort']) && $_GET['sort'] == "price_highest" ) selected @endif>Highest Price List</option>
					</select>
				</div>
			</form>

			<br class="clr"/>
		         <div class="tab-content filter_products">
				   @include('Frontend.products.ajax_products_listing')
				 </div>
			<a href="compair.html" class="btn btn-large pull-right">Compair Product</a>
			<div class="pagination">
				<ul>
					@if(isset($_GET['sort']) && !empty($_GET['sort']) )
				   {{$categoryProducts->appends(['sort' => 'price_lowest'])->links() }}
				   @else
				   {{$categoryProducts->links()}}
				   @endif
				</ul>
			</div>
			<br class="clr"/>
		</div>
@endsection