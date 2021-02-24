<table class="table table-bordered">
    <thead>
    <tr>
        <th>Product</th>
        <th colspan="2">Description</th>
        <th>Quantity/Update</th>
        <th>Price</th>
        <th>Category Product <br> Discount</th>
        <th>Total</th>
    </tr>
    </thead>
    <tbody>

    @php
        $total_price = 0;
        $total_discount = 0;

    @endphp

    @foreach($userCartItems as $item)
        @php $attrPrice = App\Model\Product::getDiscountAttrPrice($item['product_id'],$item['size'])  @endphp
        <tr>
            <td>
                @if(isset($item['product']['main_image']))
                    <?php $product_image_path = 'images/products_images/small/'.$item['product']['main_image']; ?>
                @else
                    <?php $product_image_path = '' ; ?>
                @endif

                @if(!empty($item['product']['main_image']) && file_exists($product_image_path))
                    <img loading="lazy" width="60" src="{{asset('images/products_images/large/'.$item['product']['main_image'])}}" alt=""/>
                @else
                    <img loading="lazy"  src="{{asset('images/products_images/small/no-image.png')}}" alt="">
                @endif
            </td>

            <td colspan="2">Product Name:{{$item['product']['product_name']}}<br/> Product Code:{{$item['product']['product_code']}}<br/> Color : {{$item['product']['product_color']}}<br/>Size : {{$item['size']}}</td>
            <td>
                <div class="input-append">
                    <input class="span1" style="max-width:34px"  value="{{$item['quantity']}}" id="appendedInputButtons" size="16" type="text">
                    <button class="btn btnItemUpdate qtyMinus" data-cartId="{{$item["id"]}}" type="button">
                        <i class="icon-minus"></i></button>
                    <button class="btn btnItemUpdate qtyPlus" data-cartId="{{$item["id"]}}" type="button"><i class="icon-plus"></i></button>
                    <button class="btn btn-danger" type="button"><i class="icon-remove icon-white"></i></button>				</div>
            </td>
            <td>BDT. {{$attrPrice['product_price']}} </td>
            <td>BDT. {{$attrPrice['discount']}}  </td>
            <td>BDT. {{$attrPrice['final_price'] * $item['quantity']}}</td>
        </tr>
        @php
            $total_price = $total_price + ($attrPrice['final_price'] * $item['quantity']);
            $total_discount = $total_discount + ($attrPrice['discount'] * $item['quantity']);

        @endphp
    @endforeach


    <tr>
        <td colspan="6" style="text-align:right">Sub Total:	</td>
        <td>BDT. {{$total_price}}</td>
    </tr>
    <tr>
        <td colspan="6" style="text-align:right">Voucher Discount:	</td>
        <td>BDT. {{$total_discount}}  </td>
    </tr>

    <tr>
        <td colspan="6" style="text-align:right"><strong>Grand Total</strong></td>
        <td class="label label-important" style="display:block"> <strong> BDT. {{$total_price}}</strong></td>
    </tr>
    </tbody>
</table>
