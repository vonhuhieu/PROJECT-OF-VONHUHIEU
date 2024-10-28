@extends('frontend/layout.layout')

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
                @if(Auth::check())
                    <input type="hidden" id="id_user" value="<?php echo Auth::id(); ?>">
                    <input type="hidden" id="avatar" value="<?php echo Auth::user()->avatar; ?>">
                    <input type="hidden" id="name" value="<?php echo Auth::user()->name; ?>">
                    <input type="hidden" id="email" value="<?php echo Auth::user()->email; ?>">
                @endif
                <div class="col-sm-9 padding-right">
					<div class="product-details"><!--product-details-->
                        <input type="hidden" id="id_product" value="<?php echo $product->id; ?>">\
                        <input type="hidden" id="name_product" value="<?php echo $product->name; ?>">
                        <input type="hidden" id="price_product" value="<?php echo $product->price; ?>">
						<div class="col-sm-5">
							<div class="view-product">
                                <?php
                                    use App\Models\frontend\Product;
                                    $images = json_decode($product->image, true);
                                    if($images != null)
                                    {
                                        $image = $images[0];
                                    }
                                    else
                                    {
                                        $image = "";
                                    }
                                ?>
								<img class="anhto" style="" src="{{ asset('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.$image) }}" alt="" />
								<a class="anhto" href="{{ asset('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.$image) }}" rel="prettyPhoto"><h3>ZOOM</h3></a>
								
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->
								    <div class="carousel-inner">
										<div class="item active">
                                            <?php
                                                foreach($images as $key => $value)
                                                {
                                            ?>
                                                    <a><img class="anhnho" id="<?php echo $key; ?>" src="{{ asset('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.'hinh85_'.$value) }}" alt=""></a>
                                            <?php
                                                }
                                            ?>
										</div>
									</div>

								  <!-- Controls -->
								  <a class="left item-control" href="#similar-product" data-slide="prev">
									<i class="fa fa-angle-left"></i>
								  </a>
								  <a class="right item-control" href="#similar-product" data-slide="next">
									<i class="fa fa-angle-right"></i>
								  </a>
							</div>

						</div>
						<div class="col-sm-7">
							<div class="product-information"><!--/product-information-->
                                @if($product->status == 1)
								    <img src="{{ asset('/frontend/images/product-details/new.jpg') }}" class="newarrival" alt="" />
                                @endif
								<h2><?php echo $product->name; ?></h2>
								<p>Web ID: <?php echo $product->id; ?></p>
								<span>
                                    @if($count_rate < 1)
                                        {!! $avg !!}
                                    @else
                                        @for($i = 1; $i <= 5; ++$i)
                                            @if($i <= $avg)
                                                <i class="fa fa-star"></i>
                                            @else
                                                <i class=""></i>
                                            @endif
                                        @endfor
                                    @endif
								</span>

								<span>
									<span><?php echo $product->price; ?> VNĐ</span>
									<label>Số lượng:</label>
									<input type="text" id="qty" value="3" />
									<button id="add_to_cart" type="button" class="btn btn-fefault cart">
										<i class="fa fa-shopping-cart"></i>
										Thêm vào giỏ hàng
									</button>
								</span>
								<p><b>Availability:</b> In Stock</p>
                                @if($product->status == 1)
								    <p><b>Tình trạng:</b> New</p>
                                @else
                                    <p><b>Tình trạng:</b> Sale <?php echo $product->sale; ?>%</p>
                                @endif
								<p><b>Thương hiệu:</b> <?php echo $product->brand->name; ?></p>
								<a href=""><img src="images/product-details/share.png" class="share img-responsive"  alt="" /></a>
							</div><!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#details" data-toggle="tab">Chi tiết</a></li>
								<li><a href="#companyprofile" data-toggle="tab">Công ty</a></li>
								<li class="active"><a href="#reviews" data-toggle="tab">Bình luận</a></li>
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="details" >
								<p>{!! $product->detail !!}</p>
							</div>
							
							<div class="tab-pane fade" id="companyprofile" >
								<p>Công ty Cổ Phần TM-DV-SX Việt Thương (Việt Thương Music) được ra đời vào năm 1993 và thành lập chính thức vào năm 1996 với khởi nguồn từ Trường Suối Nhạc – trường tư thục âm nhạc đầu tiên tại Việt Nam.

Tương tự như hệ thống phân phối nhạc cụ, chúng tôi phát triển thương hiệu Suối Nhạc phủ rộng tại nhiều địa bàn trong cả nước để đáp ứng nhu cầu học nhạc. Danh mục sản phẩm đầu tiên của Việt Thương là những cây Đàn organ và Piano mới toanh của Casio và Kawai Nhật Bản được giới thiệu tại thị trường Việt Nam. </p>
							</div>
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">

                                    <div class="rate">
                                        <div class="vote">
                                            @if($count_rate < 1)
                                                <div class="star_1 ratings_stars"><input value="1" type="hidden"></div>
                                                <div class="star_2 ratings_stars"><input value="2" type="hidden"></div>
                                                <div class="star_3 ratings_stars"><input value="3" type="hidden"></div>
                                                <div class="star_4 ratings_stars"><input value="4" type="hidden"></div>
                                                <div class="star_5 ratings_stars"><input value="5" type="hidden"></div>
                                            @else
                                                @for($i = 1; $i <= 5; ++$i)
                                                    @if($i <= $avg)
                                                        <div class="star_1 ratings_stars ratings_over"><input value="<?php echo $i; ?>" type="hidden"></div>
                                                    @else
                                                        <div class="star_1 ratings_stars"><input value="<?php echo $i; ?>" type="hidden"></div>
                                                    @endif 
                                                @endfor 
                                            @endif
                                            <span class="rate-np" id="rate">Điểm trung bình: {!! $avg !!}</span>
                                            <br></br>
                                            <span class="rate-np" id="count_rate">{!! $count_rate !!} lượt đánh giá </span>
                                        </div> 
                                    </div><!--/rating-area-->

                                    <h2 id="count_review">{!! $count_review !!} Bình luận</h2>
                                    <br></br><br></br>

									<div>
                                        <ul class="media-list">
                                            <?php
                                                foreach($reviewCha as $key => $value)
                                                {
                                            ?>
                                                    <li class="media" id="<?php echo $value->id; ?>">
                                                        <input type="hidden" id="id_reviewCha" value="<?php echo $value->id; ?>">
                                                        <input type="hidden" id="id_user_reviewCha" value="<?php echo $value->id_user; ?>">
                                                        <a class="pull-left" href="#">
                                                            <img style="width:250px; height:150px" class="media-object" src="{{ asset('/frontend/avatar/'.$value->id_user.'/'.$value->avatar) }}" alt="">
                                                        </a>
                                                        <div class="media-body">
                                                            <ul class="sinlge-post-meta">
                                                                <li><i class="fa fa-user"></i><?php echo $value->name; ?></li>
                                                                <li><i class="fa fa-clock-o"></i><?php echo $value->updated_at->format('H:i'); ?></li>
                                                                <li><i class="fa fa-calendar"></i><?php echo $value->updated_at->format('M d,y'); ?></li>
                                                            </ul>
                                                            <p>{!! $value->review !!}</p>
                                                            <button type="button" id="replay" class="btn btn-default pull-right">
                                                                Phản hồi
                                                            </button>
                                                            <div id="form_replay">
                                                                <form>
                                                                    <textarea name="" id="replay"></textarea>
                                                                    <button type="button" id="post-replay" class="btn btn-default pull-right">
                                                                        Xác nhận
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </li>
                                            <?php
                                                    foreach($product->product_review_replays as $key1 => $value1)
                                                    {
                                                        if($value1->level == $value->id)
                                                        {
                                            ?>
                                                            <li style="margin-left:50px;" class="media second-media">
								                                <a class="pull-left" href="#">
									                                <img style="width:121px; height:86px" class="media-object" src="{{ asset('/frontend/avatar/'.$value1->id_user.'/'.$value1->avatar) }}" alt="">
								                                </a>
								                                <div class="media-body">
									                                <ul class="sinlge-post-meta">
										                                <li><i class="fa fa-user"></i><?php echo $value1->name; ?></li>
										                                <li><i class="fa fa-clock-o"></i><?php echo $value1->updated_at->format('H:i'); ?></li>
										                                <li><i class="fa fa-calendar"></i><?php echo $value1->updated_at->format('M d, y'); ?></li>
									                                </ul>
									                                <p><?php echo $value1->review; ?></p>
									                                <button type="button" class="btn btn-default pull-right">
											                            Phản hồi
									                                </button>
								                                </div>
							                                </li>
                                                            <br></br><br></br><br></br>
                                            <?php
                                                        }
                                                    }
                                                }
                                            ?>
							                <!-- <li class="media">
								
								                <a class="pull-left" href="#">
									                <img class="media-object" src="images/blog/man-two.jpg" alt="">
								                </a>
								                <div class="media-body">
									                <ul class="sinlge-post-meta">
										                <li><i class="fa fa-user"></i>Janis Gallagher</li>
										                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									                </ul>
									                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									                <button type="button" class="btn btn-default pull-right">
											            Phản hồi
									                </button>
								                </div>
							                </li>
							                <li class="media second-media">
								                <a class="pull-left" href="#">
									                <img class="media-object" src="images/blog/man-three.jpg" alt="">
								                </a>
								                <div class="media-body">
									                <ul class="sinlge-post-meta">
										                <li><i class="fa fa-user"></i>Janis Gallagher</li>
										                <li><i class="fa fa-clock-o"></i> 1:33 pm</li>
										                <li><i class="fa fa-calendar"></i> DEC 5, 2013</li>
									                </ul>
									                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.  Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
									                <button type="button" class="btn btn-default pull-right">
											            Phản hồi
									                </button>
								                </div>
							                </li> -->
							
						                </ul>		
                                    </div>
                                    <br></br><br></br>
                                    
									<p><b>Viết trải nghiệm của bạn</b></p>
									
									<form action="">
										<span>
                                            @if(Auth::check())
											    <input type="text" value="<?php echo Auth::user()->name; ?>" placeholder="Họ tên"/>
											    <input type="email" value="<?php echo Auth::user()->email; ?>" placeholder="Email"/>
                                            @else
                                                <input type="text" value="" placeholder="Họ tên"/>
											    <input type="email" value="" placeholder="Email"/>
                                            @endif
										</span>
										<textarea name="" id="review"></textarea>
										<button type="button" id="post-review" class="btn btn-default pull-right">
											Xác nhận
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
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
			//vote
			$('.ratings_stars').hover(
	            // Handles the mouseover
	            function() {
	                $(this).prevAll().andSelf().addClass('ratings_hover');
	                // $(this).nextAll().removeClass('ratings_vote'); 
	            },
	            function() {
	                $(this).prevAll().andSelf().removeClass('ratings_hover');
	                // set_votes($(this).parent());
	            }
	        );

			$('.ratings_stars').click(function(){
		    	var check_login = @json(Auth::check());
                if(check_login == false)
                {
                    alert("Vui lòng đăng nhập để tiếp tục");
                }
                else
                {
                    var id_product = $("input#id_product").val();
                    var id_user = $("input#id_user").val();
                    var Values =  $(this).find("input").val();
                    var count_rate = parseInt($("span#count_rate").text());
                    $.ajax({
                        method:"POST",
                        url:"{{ url('/frontend/product_detail_rate') }}",
                        data:{
                            id_product:id_product,
                            id_user:id_user,
                            rate:Values,
                            count_rate:count_rate,
                        },
                        success:function(response){
                            console.log(response);
                            $("span#rate").text("Đánh giá: " + response.rate);
                            $("span#count_rate").text(response.count_rate + " lượt đánh giá");
                        }
                    })
                    if ($(this).hasClass('ratings_over')) {
		                $('.ratings_stars').removeClass('ratings_over');
		                $(this).prevAll().andSelf().addClass('ratings_over');
		            } else {
		        	    $(this).prevAll().andSelf().addClass('ratings_over');
		            }
                }
		    });

            $("button#post-review").click(function(){
                var check_login = @json(Auth::check());
                if(check_login == false)
                {
                    alert("Vui lòng đăng nhập để tiếp tục");
                }
                else
                {
                    var id_product = $("input#id_product").val();
                    var id_user = $("input#id_user").val();
                    var avatar = $("input#avatar").val();
                    var name = $("input#name").val();
                    var review = $("textarea#review").val();
                    var level = 0;
                    var count_review = parseInt($("h2#count_review").text());
                    
                    if(review != "")
                    {
                        $.ajax({
                            method:"POST",
                            url:"{{ url('/frontend/product_detail_review') }}",
                            data:{
                                id_product:id_product,
                                id_user:id_user,
                                avatar:avatar,
                                name:name,
                                review:review,
                                level:level,
                                count_review:count_review
                            },
                            success:function(response){
                                console.log(response);
                                var avatar = "{{ asset('/frontend/avatar') }}" + "/" + response.id_user + "/" + response.avatar;
                                var new_review = '<li class="media" id="' + response.id_review + '">' + 
								
                                                    '<a class="pull-left" href="#">' + 
                                                        '<img style="width:250px; height:150px" class="media-object" src="' + avatar + '" alt="">' + 
                                                    '</a>' + 
                                                    '<div class="media-body">' + 
                                                        '<ul class="sinlge-post-meta">' + 
                                                            '<li><i class="fa fa-user"></i>' + response.name + '</li>' + 
                                                            '<li><i class="fa fa-clock-o"></i>' + response.time + '</li>' + 
                                                            '<li><i class="fa fa-calendar"></i>' + response.day + '</li>' + 
                                                        '</ul>' + 
                                                        '<p>' + response.review + '</p>' + 
                                                        '<button type="button" class="btn btn-default pull-right">' + 
                                                            'Phản hồi' + 
                                                        '</button>' + 
                                                    '</div>' + 
                                                '</li>';
                                $("textarea#review").val("");
                                $("ul.media-list").append(new_review);
                                $("h2#count_review").text(response.count_review + " Bình luận");
                            }
                        })
                    }
                }
            })

            $("div#form_replay").hide();
            $("button#replay").click(function(){
                $(this).closest("li").find("div#form_replay").show();
            })

            $("button#post-replay").click(function(){
                var check_login = @json(Auth::check());
                if(check_login == false)
                {
                    alert("Vui lòng đăng nhập để tiếp tục");
                }
                else
                {
                    var id_user_reviewCha = $(this).closest("li").find("input#id_user_reviewCha").val();
                    var id_user = $("input#id_user").val();
                    if(id_user == id_user_reviewCha)
                    {
                        alert("Không được trả lời chính mình");
                    }
                    else
                    {
                        var id_product = $("input#id_product").val();
                        var id_user = $("input#id_user").val();
                        var avatar = $("input#avatar").val();
                        var name = $("input#name").val();
                        var replay = $(this).closest("li").find("textarea#replay").val();
                        var level = $(this).closest("li").find("input#id_reviewCha").val();
                        var count_review = parseInt($("h2#count_review").text());
                        if(replay != "")
                        {
                            $.ajax({
                                method:"POST",
                                url:"{{ url('/frontend/product_detail_replay') }}",
                                data:{
                                    id_product:id_product,
                                    id_user:id_user,
                                    avatar:avatar,
                                    name:name,
                                    replay:replay,
                                    level:level,
                                    count_review:count_review,
                                },
                                success:function(response){
                                    console.log(response);
                                    if(response.avatar == null)
                                    {
                                        response.avatar = "";
                                    }
                                    var avatar = "{{ asset('/frontend/avatar') }}" + "/" + response.id_user + "/" + response.avatar;
                                    var replay = '<li style="margin-left:50px;" class="media second-media">' + 
								                    '<a class="pull-left" href="#">' + 
									                    '<img style="width:121px; height:86px" class="media-object" src="' + avatar + '" alt="">' + 
								                    '</a>' + 
								                    '<div class="media-body">' + 
									                    '<ul class="sinlge-post-meta">' + 
										                    '<li><i class="fa fa-user"></i>' + response.name + '</li>' + 
										                    '<li><i class="fa fa-clock-o"></i>' + response.time + '</li>' + 
										                    '<li><i class="fa fa-calendar"></i>' + response.day + '</li>' + 
									                    '</ul>' + 
									                    '<p>' + response.replay+ '</p>' + 
									                    '<button type="button" class="btn btn-default pull-right">' + 
											                'Phản hồi' + 
									                    '</button>' + 
								                    '</div>' + 
							                    '</li>';
                                    $("textarea#replay").val("");
                                    $("div#form_replay").hide();
                                    $("ul.media-list").find("li#" + response.level).after(replay);
                                    $("h2#count_review").text(response.count_review + " Bình luận");
                                }
                            })
                        }
                    }
                }
            })

            $("img.anhnho").click(function(){
                var x = $(this).attr("src");
                $("img.anhto").attr("src", x);
                $("a.anhto").attr("href", x);
            })

            $("button#add_to_cart").click(function(){
                var image = $("img.anhto").attr("src");
                var name = $("input#name_product").val();
                var id_product = $("input#id_product").val();
                var price = $("input#price_product").val();
                var qty = $("input#qty").val();
                $.ajax({
                    method:"POST",
                    url:"{{ url('/frontend/product_detail_add_to_cart') }}",
                    data:{
                        image:image,
                        name:name,
                        id_product:id_product,
                        price:price,
                        qty: qty,
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