@extends('layouts.frontend_layout.front_layout')
@section('main_content')
<div class="span9">
    <ul class="breadcrumb">
        <li><a href="{{url('/')}}">Home</a> <span class="divider">/</span></li>
        <li><a href="{{url('/'.$productDetails['category']['url'])}}">{{$productDetails['category']['category_name']}}</a> <span class="divider">/</span></li>
        <li class="active">{{$productDetails['product_name']}}</li>
    </ul>
    <div class="row">
        <div id="gallery" class="span3">




                @if(isset($productDetails['main_image']))
                    <?php $product_image_path = 'images/products_images/small/'.$productDetails['main_image']; ?>
               @else
                   <?php $product_image_path = '' ; ?>
               @endif



                   @if(!empty($productDetails['main_image']) && file_exists($product_image_path))
                     <a href="{{asset('images/products_images/large/'.$productDetails['main_image'])}}" title="{{$productDetails['product_name']}}">
                      <img loading="lazy" src="{{asset('images/products_images/large/'.$productDetails['main_image'])}}" style="width:100%" alt="{{$productDetails['product_name']}}"/>
                    </a>
              @else
            <a href="{{asset('images/products_images/small/no-image.png')}}" title="{{$productDetails['product_name']}}">
                <img loading="lazy"  src="{{asset('images/products_images/small/no-image.png')}}" alt="">
              </a>
            @endif
            <div id="differentview" class="moreOptopm carousel slide">
                <div class="carousel-inner">
                    <div class="item active">
                        @foreach($productDetails['images'] as $image)
                        <a href="{{asset('images/products_images/large/'.$image['image'])}}"> <img style="width:29%" src="{{asset('images/products_images/large/'.$image['image'])}}" alt=""/></a>
                        @endforeach

                    </div>
                    <div class="item ">
                        @foreach($productDetails['images'] as $image)
                        <a href="{{asset('images/products_images/large/'.$image['image'])}}"> <img loading="lazy" style="width:29%" src="{{asset('images/products_images/large/'.$image['image'])}}" alt=""/></a>
                        @endforeach

                    </div>

                </div>
                <!--
                            <a class="left carousel-control" href="#myCarousel" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#myCarousel" data-slide="next">›</a>
                -->
            </div>

            <div class="btn-toolbar">
                <div class="btn-group">
                    <span class="btn"><i class="icon-envelope"></i></span>
                    <span class="btn" ><i class="icon-print"></i></span>
                    <span class="btn" ><i class="icon-zoom-in"></i></span>
                    <span class="btn" ><i class="icon-star"></i></span>
                    <span class="btn" ><i class=" icon-thumbs-up"></i></span>
                    <span class="btn" ><i class="icon-thumbs-down"></i></span>
                </div>
            </div>
        </div>
        <div class="span6">

            @if(Session::has('success_message'))
            <div class="alert alert-success alert-dismissable" role="alert" >
               {{Session::get('success_message')}}
              <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            </div>
          @endif

          @if(Session::has('error_message'))
          <div class="alert alert-danger alert-dismissable" role="alert" >
             {{Session::get('error_message')}}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          </div>
        @endif

            <h3>{{$productDetails['product_name']}}  </h3>
            <small>- {{$productDetails['brand']['name']}}</small>
            <hr class="soft"/>
            <small>{{$productStock}} items in stock</small>
            <form action="{{url('add-to-cart')}}" method="post" class="form-horizontal qtyFrm">
                @csrf
                <input type="hidden" name="product_id" value="{{$productDetails['id']}}">
                <div class="control-group">
                    <h4 class="getAttrPrice">
                        <?php 	$discounted_price = App\Model\Product::getDiscountPrice($productDetails['id']); ?>
                        @if($discounted_price>0)
                        <del>BDT.{{$productDetails['product_price']}}</del> BDT.{{$discounted_price}}
                        @else
                        BDT. {{$productDetails['product_price']}}
                        @endif
                    </a></h4>



                        <select name="size" id="getPrice" product-id="{{$productDetails['id']}}" class="span2 pull-left">
                            <option value="">Select Size</option>
                            @foreach($productDetails['attributes'] as $productAttribute)
                            <option value="{{ $productAttribute['size']}}">{{$productAttribute['size']}}</option>
                            @endforeach
                        </select>

                        <input name="quantity" type="number" class="span1" placeholder="Qty."/>
                        <button type="submit" class="btn btn-large btn-primary pull-right"> Add to cart <i class=" icon-shopping-cart"></i></button>
                    </div>
                </div>
            </form>

            <hr class="soft clr"/>
            <p class="span6">
                {{$productDetails['description']}}

            </p>
            <a class="btn btn-small pull-right" href="#detail">More Details</a>
            <br class="clr"/>
            <a href="#" name="detail"></a>
            <hr class="soft"/>
        </div>

        <div class="span9">
            <ul id="productDetail" class="nav nav-tabs">
                <li class="active"><a href="#home" data-toggle="tab">Product Details</a></li>
                <li><a href="#profile" data-toggle="tab">Related Products</a></li>
            </ul>
            <div id="myTabContent" class="tab-content">
                <div class="tab-pane fade active in" id="home">
                    <h4>Product Information</h4>
                    <table class="table table-bordered">
                        <tbody>
                            <tr class="techSpecRow"><th colspan="2">Product Details</th></tr>

                             @if($productDetails['brand']['name'])
                            <tr class="techSpecRow"><td class="techSpecTD1">Brand: </td><td class="techSpecTD2">{{$productDetails['brand']['name']}}</td></tr>
                            @endif

                            @if($productDetails['product_code'])
                            <tr class="techSpecRow"><td class="techSpecTD1">Code:</td><td class="techSpecTD2">{{$productDetails['product_code']}}</td></tr>
                            @endif

                            @if($productDetails['product_color'])
                            <tr class="techSpecRow"><td class="techSpecTD1">Color:</td><td class="techSpecTD2">{{$productDetails['product_color']}}</td></tr>
                            @endif

                            @if($productDetails['fabric'])
                            <tr class="techSpecRow"><td class="techSpecTD1">Fabric:</td><td class="techSpecTD2">{{$productDetails['fabric']}}</td></tr>
                            @endif

                            @if($productDetails['pattern'])
                            <tr class="techSpecRow"><td class="techSpecTD1">Pattern:</td><td class="techSpecTD2">{{$productDetails['pattern']}}</td></tr>
                            @endif

                            @if($productDetails['sleeve'])
                            <tr class="techSpecRow"><td class="techSpecTD1">Sleeve:</td><td class="techSpecTD2">{{$productDetails['sleeve']}}</td></tr>
                            @endif

                            @if($productDetails['fit'])
                            <tr class="techSpecRow"><td class="techSpecTD1">Fit:</td><td class="techSpecTD2">{{$productDetails['fit']}}</td></tr>
                            @endif

                            @if($productDetails['occasion'])
                            <tr class="techSpecRow"><td class="techSpecTD1">Occasion:</td><td class="techSpecTD2">{{$productDetails['occasion']}}</td></tr>
                            @endif
                        </tbody>
                    </table>



                    @if($productDetails['wash_care'])
                    <h5>Washcare</h5>
                    <p>{{$productDetails['wash_care']}}</p>
                    @endif
                    <h5>Disclaimer</h5>
                    <p>
                        There may be a slight color variation between the image shown and original product.
                    </p>
                </div>
                <div class="tab-pane fade" id="profile">
                    <div id="myTab" class="pull-right">
                        <a href="#blockView" data-toggle="tab"><span class="btn btn-large btn-primary"><i class="icon-th-large"></i></span></a>
                    </div>
                    <br class="clr"/>
                    <hr class="soft"/>

                        <div class="tab-pane active" id="blockView">
                            <ul class="thumbnails">
                                @foreach($relatedProducts as $related)
                                <li class="span3">
                                    <div class="thumbnail">
                                        <a href="{{url('product/'.$related['product_code'].'/'.$related['id'])}}">
                                            @if(isset($related['main_image']))
                                                <?php $product_image_path = 'images/products_images/small/'.$related['main_image']; ?>
                                           @else
                                               <?php $product_image_path = '' ; ?>
                                           @endif

                                               @if(!empty($related['main_image']) && file_exists($product_image_path))
                                               <img loading="lazy" src="{{asset($product_image_path)}}" alt="">
                                               @else
                                               <img loading="lazy"  src="{{asset('images/products_images/small/no-image.png')}}" alt="">
                                               @endif

                                   </a>
                                        <div class="caption">
                                            <h5>{{$related['product_name']}}</h5>
                                            <p>
                                                {{$related['brand']['name']}}
                                            </p>
                                            <h4 style="text-align:center"><a class="btn" href="product_details.html"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">{{$related['product_price']}}</a></h4>
                                        </div>
                                    </div>
                                </li>
                                @endforeach

                            </ul>
                            <hr class="soft"/>
                        </div>
                    </div>
                    <br class="clr">
                </div>
            </div>
        </div>
    </div>

@endsection
