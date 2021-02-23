<div class="tab-pane  active" id="blockView">
					<ul class="thumbnails">
                        @foreach($categoryProducts as $product)
						<li class="span3">
							<div class="thumbnail">
								<a href="{{url('product/'.$product['product_code'].'/'.$product['id'])}}">
							     	@if(isset($product['main_image']))
                                         <?php $product_image_path = 'images/products_images/small/'.$product['main_image']; ?>
									@else
									    <?php $product_image_path = '' ; ?>
									@endif

                                        @if(!empty($product['main_image']) && file_exists($product_image_path))
                                        <img loading="lazy" src="{{asset($product_image_path)}}" alt="">
                                        @else
                                        <img loading="lazy"  src="{{asset('images/products_images/small/no-image.png')}}" alt="">
										@endif

                            </a>
								<div class="caption">
									<h5>{{$product['product_name']}}</h5>
									<p>
										{{$product['brand']['name']}}
									</p>
									<?php

									$discounted_price = App\Model\Product::getDiscountPrice($product['id']);
									?>
									<h4 style="text-align:center"><a class="btn" href="#"> <i class="icon-zoom-in"></i></a> <a class="btn" href="#">Add to <i class="icon-shopping-cart"></i></a> <a class="btn btn-primary" href="#">
										@if($discounted_price>0)
										<del>BDT.{{$product['product_price']}}</del>
										@else
										BDT.{{$product['product_price']}}
										@endif
									</a></h4>
									@if($discounted_price > 0)
									<font color="red"> Discounted Price: BDT.{{$discounted_price}}</font>
									@endif

								</div>
							</div>
                        </li>
                        @endforeach

					</ul>
					<hr class="soft"/>
				</div>
