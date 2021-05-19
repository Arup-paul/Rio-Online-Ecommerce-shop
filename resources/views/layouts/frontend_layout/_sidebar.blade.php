<?php
use App\Model\Section;
$sections = Section::sections();

?>

<!-- Sidebar ================================================== -->
<div id="sidebar" class="span3">
    <div class="well well-small"><a id="myCart" href="{{url('cart')}}"><img src="front_images/ico-cart.png" alt="cart"><span class="totalCartItems">{{totalCartItems()}}</span>  Items in your cart</a></div>
    <ul id="sideManu" class="nav nav-tabs nav-stacked">
        @foreach($sections as $section)
        @if(count($section['categories']) > 0)
         <li class="subMenu"><a>{{$section['name']}}</a>
            @foreach($section['categories'] as $category)
            <ul>
            <li><a href="{{url($category['url'])}}"><i class="icon-chevron-right"></i><strong>{{$category['category_name']}}</strong></a></li>
               @foreach($category['subcategories'] as $subcategory)
            <li><a href="{{url($subcategory['url'])}}"><i class="icon-chevron-right"></i>{{$subcategory['category_name']}}</a></li>
                @endforeach
            </ul>
            @endforeach
        </li>
        @endif
        @endforeach

    </ul>
    <br>

    @if(isset($page_name) && $page_name=="listing" )

    <div class="well well-small">
        <h5>Fabric</h5>
    @foreach($fabricArray as $fabric)
     <input class="fabric" type="checkbox" value="{{$fabric}}" name="fabric[]" id="{{ $fabric}}">&nbsp;&nbsp; {{$fabric}} <br>
    @endforeach
    </div>
    <div class="well well-small">
    <h5>Sleeve</h5>
    @foreach($sleeveArray as $sleeve)
     <input class="sleeve" value="{{$sleeve}}" type="checkbox" name="sleeve[]" id="{{$sleeve}}">&nbsp;&nbsp; {{$sleeve}} <br>
    @endforeach
    </div>
   <div class="well well-small">
    <h5>Fit</h5>
    @foreach($fitArray as $fit)
     <input class="fit" type="checkbox" value="{{$fit}}" name="fit[]" id="{{$fit}}">&nbsp;&nbsp; {{$fit}} <br>
    @endforeach
   </div>
<div class="well well-small">
    <h5>Occassions</h5>
    @foreach($occasionArray as $occasion)
     <input class="occasion" type="checkbox" value="{{$occasion}}" name="occasion[]" id="{{$occasion}}">&nbsp;&nbsp; {{$occasion}} <br>
    @endforeach
     </div>
    <div class="well well-small">
    <h5>Pattern</h5>
    @foreach($patternArray as $pattern)
     <input class="pattern" type="checkbox" value="{{$pattern}}" name="pattern[]" id="{{ $pattern}}"">&nbsp;&nbsp; {{$pattern}} <br>
    @endforeach

    </div>
    @endif
    <br/>
    <div class="thumbnail">
        <img src="front_images/payment_methods.png" title="Payment Methods" alt="Payments Methods">
        <div class="caption">
            <h5>Payment Methods</h5>
        </div>
    </div>
</div>
