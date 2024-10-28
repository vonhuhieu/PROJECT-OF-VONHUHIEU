@extends('frontend/layout.layout')

@section('left')
    @include('frontend/layout.left')
@endsection

@section('content')
    <form action="{{ url('/frontend/search_advanced') }}" method="POST" enctype="multipart/form_data">
        @csrf 
        
        <ul>
            <li style="display:inline-block">
                <input type="text" name="name" placeholder="Tên sản phẩm">
            </li>

            <li style="display:inline-block">
                <select name="price">
                    <option value="">Giá</option>
                    <option value="0-1000000">0-1,000,000 VNĐ</option>
                    <option value="1000000-10000000">1,000,000-10,000,000 VNĐ</option>
                    <option value="10000000-100000000">10,000,000-100,000,000 VNĐ</option>
                    <option value="100000000-1000000000">100,000,000-1,000,000,000 VNĐ</option>
                </select>
            </li>

            <li style="display:inline-block">
                <select name="id_category">
                    <option value="">Danh mục</option>
                    <?php
                        foreach($categories as $key => $value)
                        {
                    ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </li>

            <li style="display:inline-block">
                <select name="id_brand">
                    <option value="">Thương hiệu</option>
                    <?php
                        foreach($brands as $key => $value)
                        {
                    ?>
                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                    <?php
                        }
                    ?>
                </select>
            </li>

            <li style="display:inline-block">
                <select name="status">
                    <option value="">Tình trạng</option>
                    <option value="0">Sale</option>
                    <option value="1">New</option>
                </select>
            </li>
        </ul>

        <button type="submit" name="submit">Xác nhận</button>
    </form>

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
							if(isset($products))
							{
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
													<img src="{{ asset('/frontend/product/'.$value->id_user.'/'.$value->id.'/'.$image) }}" alt="" />
													<h2><?php echo $value->price; ?> VNĐ</h2>
													<p><?php echo $value->name; ?></p>
													<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Thêm vào giỏ hàng</a>
												</div>
												<div class="product-overlay">
													<div class="overlay-content">
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

							<div class="pagination-area">
							<ul class="pagination">
                                
							</ul>
							</div>
						<?php
							}
						?>
						
					</div><!--features_items-->
					<br></br><br></br>

					
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
		})
	</script>
@endsection