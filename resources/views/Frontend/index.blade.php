@extends('layouts.frontend_layout.front_layout')


@section('main_content')
<div class="span9">
    @if($featuredItemsCount > 0)
    <div class="well well-small">
        <h4>Featured Products <small class="pull-right">{{$featuredItemsCount}} featured products</small></h4>
        <div class="row-fluid">
            <div id="featured" @if($featuredItemsCount > 4)   class="carousel slide" @endif>
                <div class="carousel-inner">
                    @foreach($featuresItemsChunk as $key => $featuresItem)
                    @if($featuresItem > 0)
                    <div class="item @if($key==0) active @endif">
                        <ul class="thumbnails">
                            @foreach($featuresItem as $item)
                            <li class="span3"  style="height: 300px; width: 33%">
                                <div class="thumbnail">
                                    <i class="tag"></i>
                                    <a href="{{url('product/'.$item['product_code'].'/'.$item['id'])}}">
                                        <?php $product_image_path = 'images/products_images/small/'.$item['main_image']; ?>
                                        @if(!empty($item['main_image']) && file_exists($product_image_path))
                                        <img loading="lazy" src="{{asset($product_image_path)}}" alt="">
                                        @else
                                        <img loading="lazy" src="{{asset('images/products_images/small/no-image.png')}}" alt="">
                                        @endif
                                    </a>
                                    <div class="caption">
                                    <h5>{{$item['product_name']}}</h5>
                                        <?php
                                        $discounted_price = App\Model\Product::getDiscountPrice($item['id']);
                                        ?>
                                        <h4 style="text-align:center"> <a class="btn" href="#">View </a>
                                            <a class="btn btn-primary" href="#">
                                                @if($discounted_price>0)
                                                    <del>BDT.{{$item['product_price']}}</del>
                                                @else
                                                    BDT.{{$item['product_price']}}
                                                @endif
                                            </a>

                                            </h4>
                                        @if($discounted_price > 0)
                                            <font color="red"> Discounted Price: BDT.{{$discounted_price}}</font>
                                        @endif
                                    </div>
                                </div>
                            </li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    @endforeach

                </div>
                <a class="left carousel-control" href="#featured" data-slide="prev">‹</a>
                <a class="right carousel-control" href="#featured" data-slide="next">›</a>
            </div>
        </div>
    </div>
    @endif
    <h4>Latest Products </h4>
    <ul class="thumbnails">
        @foreach($newProducts as $product)
        <li class="span3">
            <div class="thumbnail">
                <a href="{{url('product/'.$product['product_code'].'/'.$product['id'])}}">
                    <?php $product_image_path = 'images/products_images/medium/'.$product['main_image']; ?>
                    @if(!empty($product['main_image']) && file_exists($product_image_path))
                    <img src="{{asset($product_image_path)}}" alt="">
                    @else
                    <img src="{{asset('images/products_images/small/no-image.png')}}" alt="">
                    @endif
                </a>
                <div class="caption">
                <h5>{{$product['product_name']}}</h5>
                    <p>
                        {{$product['product_code']}}  ({{$product['product_color']}})
                    </p>

                    <?php
                    $discounted_price = App\Model\Product::getDiscountPrice($product['id']);
                    ?>
                    <h4 style="text-align:center"> <a class="btn" href="#">View </a>
                        <a class="btn btn-primary" href="#">
                            @if($discounted_price>0)
                                <del>BDT.{{$product['product_price']}}</del>
                            @else
                                BDT.{{$product['product_price']}}
                            @endif
                        </a>

                    </h4>
                    @if($discounted_price > 0)
                        <font color="red"> Discounted Price: BDT.{{$discounted_price}}</font>
                    @endif
                </div>
            </div>
        </li>
        @endforeach

    </ul>
</div>
@endsection
