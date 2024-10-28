@extends('frontend/layout.layout')

@section('slider')
    @include('frontend/layout.slider')
@endsection

@section('left')
    @include('frontend/layout.left')
@endsection

@section('content')
				<?php
					$qty = 0;
					if(session()->has('cart'))
					{
						foreach(session()->get('cart') as $key => $value)
						{
							$qty += $value['qty'];
						}
					}
				?>
				<input type="hidden" id="quantity" value="<?php echo $qty; ?>">
                <div class="col-sm-9 padding-right">
					<div class="features_items"><!--features_items-->
						<h2 class="title text-center">Sản phẩm mới nhất</h2>

						<?php
							use App\Models\frontend\Product;
							foreach($products as $key => $value)
							{
								$images = json_decode($value->image, true);
								
								if($images != null)
								{
									$image = $images[0];
								}
								else
								{
									$image = "";
								}
						?>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
													<span>
										        		<!-- <i class="fa fa-star"></i>
										        		<i class="fa fa-star"></i>
										        		<i class="fa fa-star"></i>
										        		<i class="fa fa-star"></i>
										        		<i class="fa fa-star-half-o"></i> -->
								       				</span>
													<img src="{{ asset('/frontend/product/'.$value->id_user.'/'.$value->id.'/'.$image) }}" alt="" />
													<h2><?php echo $value->price; ?> VNĐ</h2>
													<p><?php echo $value->name; ?></p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
														<span>
										        			<!-- <i class="fa fa-star"></i>
										        			<i class="fa fa-star"></i>
										        			<i class="fa fa-star"></i>
										        			<i class="fa fa-star"></i>
										        			<i class="fa fa-star-half-o"></i> -->
								       				 	</span>
														<input type="hidden" id="id_product" value="<?php echo $value->id; ?>">
														<h2><?php echo $value->price; ?> VNĐ</h2>
														<p><?php echo $value->name; ?></p>
														<a id="add_to_cart" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
													</div>
												</div>
										</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào danh sách yêu thích</a></li>
												<li><a href="{{ url('/frontend/product_detail', ['id_product' => $value->id]) }}"><i class="fa fa-plus-square"></i>Chi tiết</a></li>
											</ul>
										</div>
									</div>
								</div>
						<?php
							}
						?>
						
					</div><!--features_items-->
					
					<br></br><br></br>

					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">Sản phẩm nổi bật</h2>
						<?php
							foreach($outstanding_products as $key => $value)
							{
								$images = json_decode($value->image, true);
								
								if($images != null)
								{
									$image = $images[0];
								}
								else
								{
									$image = "";
								}
						?>
								<div class="col-sm-4">
									<div class="product-image-wrapper">
										<div class="single-products">
												<div class="productinfo text-center">
													<span>
										        		<!-- <i class="fa fa-star"></i>
										        		<i class="fa fa-star"></i>
										        		<i class="fa fa-star"></i>
										        		<i class="fa fa-star"></i>
										        		<i class="fa fa-star-half-o"></i> -->
														<?php
															$product_average = Product::find($value->id)->product_average;
															if($product_average->average != null)
															{
														?>
																@for($i = 1; $i <= 5; ++$i)
																	@if($i <= $product_average->average)
																		<i class="fa fa-star"></i>
																	@else
																		<i class=""></i>
																	@endif
																@endfor
														<?php
															}
														?>
								       				 </span>
													<img src="{{ asset('/frontend/product/'.$value->id_user.'/'.$value->id.'/'.$image) }}" alt="" />
													<h2><?php echo $value->price; ?> VNĐ</h2>
													<p><?php echo $value->name; ?></p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
														<span>
										        			<!-- <i class="fa fa-star"></i>
										        			<i class="fa fa-star"></i>
										        			<i class="fa fa-star"></i>
										        			<i class="fa fa-star"></i>
										        			<i class="fa fa-star-half-o"></i> -->
															<?php
																$product_average = Product::find($value->id)->product_average;
																if($product_average->average != null)
																{
															?>
																	@for($i = 1; $i <= 5; ++$i)
																		@if($i <= $product_average->average)
																			<i class="fa fa-star"></i>
																		@else
																			<i class=""></i>
																		@endif
																	@endfor
															<?php
																}
															?>
								       				 	</span>
														<input type="hidden" id="id_product" value="<?php echo $value->id; ?>">
														<h2><?php echo $value->price; ?> VNĐ</h2>
														<p><?php echo $value->name; ?></p>
														<a id="add_to_cart" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
													</div>
												</div>
										</div>
										<div class="choose">
											<ul class="nav nav-pills nav-justified">
												<li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào danh sách yêu thích</a></li>
												<li><a href="{{ url('/frontend/product_detail', ['id_product' => $value->id]) }}"><i class="fa fa-plus-square"></i>Chi tiết</a></li>
											</ul>
										</div>
									</div>
								</div>
						<?php
							}
						?>
						
					</div><!--/recommended_items-->
					
				</div>
@endsection

@section('js')
	<script>
		$(document).ready(function(){

			$.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

			$("a#add_to_cart").click(function(){
				var image = $(this).closest("div.single-products").find("img").attr("src");
				var name = $(this).closest("div.overlay-content").find("p").text();
				var id_product = $(this).closest("div.overlay-content").find("input#id_product").val();
				var price = $(this).closest("div.overlay-content").find("h2").text().replace(" VNĐ", "");
				$.ajax({
					method:"POST",
					url:"{{ url('/frontend/index_add_to_cart') }}",
					data:{
						image:image,
						name:name,
						id_product:id_product,
						price:price,
					},
					success:function(response){
						console.log(response);
						if(response.quantity > 0)
						{
							$("a#cart").text(response.quantity);
						}
					}
				})
			})

			var quantity = $("input#quantity").val();
			if(quantity > 0)
			{
				$("a#cart").text(quantity);
			}

			$("div.slider-track").click(function(){
				var price_range = $("div.tooltip-inner").text();
				$.ajax({
					method:"POST",
					url:"{{ url('/frontend/price_range') }}",
					data:{
						price_range:price_range,
					},
					success:function(response){
						console.log(response);
						var html = "";
						var data = response.data;
						data.map(function(value,key){
							var img = "{{ asset('/frontend/product') }}" + "/" + value['id_user'] + "/" + value['id_product'] + "/" + value['image'];
							var url = "{{ url('/frontend/product_detail') }}" + "/" + value['id_product'];
							html += '<div class="col-sm-4">' + 
										'<div class="product-image-wrapper">' + 
											'<div class="single-products">' + 
													'<div class="productinfo text-center">' + 
														'<img src="' + img + '" alt="" />' + 
														'<h2>' + value['price'] +  ' VNĐ</h2>' + 
														'<p>' + value['name'] + '</p>' + 
														'<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>' + 
													'</div>' + 
													'<div class="product-overlay">' + 
														'<div class="overlay-content">' + 
															'<h2>' + value['price'] +  ' VNĐ</h2>' + 
															'<p>' + value['name'] + '</p>' + 
															'<a id="add_to_cart" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>' + 
														'</div>' + 
													'</div>' + 
											'</div>' + 
											'<div class="choose">' + 
												'<ul class="nav nav-pills nav-justified">' + 
													'<li><a href="#"><i class="fa fa-plus-square"></i>Thêm vào danh sách yêu thích</a></li>' + 
													'<li><a href="' + url + '"><i class="fa fa-plus-square"></i>Chi tiết</a></li>' + 
												'</ul>' + 
											'</div>' + 
										'</div>' + 
								'</div>';
						})
						$("div.features_items").text("");
						$("div.features_items").append(html);
					}
				})
			})
		})
	</script>
@endsection