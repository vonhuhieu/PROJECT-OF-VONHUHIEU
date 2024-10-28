    <header id="header"><!--header-->
		<div class="header_top"><!--header_top-->
			<div class="container">
				<div class="row">
					<div class="col-sm-6">
						<div class="contactinfo">
							<ul class="nav nav-pills">
								<li><a href="#"><i class="fa fa-phone"></i> +2 95 01 88 821</a></li>
								<li><a href="#"><i class="fa fa-envelope"></i> info@domain.com</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-6">
						<div class="social-icons pull-right">
							<ul class="nav navbar-nav">
								<li><a href="#"><i class="fa fa-facebook"></i></a></li>
								<li><a href="#"><i class="fa fa-twitter"></i></a></li>
								<li><a href="#"><i class="fa fa-linkedin"></i></a></li>
								<li><a href="#"><i class="fa fa-dribbble"></i></a></li>
								<li><a href="#"><i class="fa fa-google-plus"></i></a></li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header_top-->
		
		<div class="header-middle"><!--header-middle-->
			<div class="container">
				<div class="row">
					<div class="col-md-4 clearfix">
						<div class="logo pull-left">
							<a href="index.html"><img src="{{ asset('/frontend/images/home/logo.png') }}" alt="" /></a>
						</div>
						<div class="btn-group pull-right clearfix">
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									USA
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canada</a></li>
									<li><a href="">UK</a></li>
								</ul>
							</div>
							
							<div class="btn-group">
								<button type="button" class="btn btn-default dropdown-toggle usa" data-toggle="dropdown">
									DOLLAR
									<span class="caret"></span>
								</button>
								<ul class="dropdown-menu">
									<li><a href="">Canadian Dollar</a></li>
									<li><a href="">Pound</a></li>
								</ul>
							</div>
						</div>
					</div>
					<div class="col-md-8 clearfix">
						<div class="shop-menu clearfix pull-right">
							<ul class="nav navbar-nav">
                                @if(Auth::check())
								    <li><a href="{{ url('/frontend/account') }}"><i class="fa fa-user"></i> Tài khoản</a></li>
								    <li><a href=""><i class="fa fa-star"></i> Danh sách yêu thích</a></li>
								    <li><a href="{{ url('/frontend/checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								    <li><a id="cart" href="{{ url('/frontend/cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
                                    <li><a href="{{ url('/frontend/member_logout') }}"><i class="fa fa-lock"></i> Đăng xuất</a></li>
                                @else
                                    <li><a href="{{ url('/frontend/checkout') }}"><i class="fa fa-crosshairs"></i> Thanh toán</a></li>
								    <li><a id="cart" href="{{ url('/frontend/cart') }}"><i class="fa fa-shopping-cart"></i> Giỏ hàng</a></li>
								    <li><a href="{{ url('/frontend/member_login') }}"><i class="fa fa-lock"></i> Đăng nhập</a></li>
                                    <li><a href="{{ url('/frontend/member_register') }}"><i class="fa fa-lock"></i> Đăng ký</a></li>
                                @endif
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-middle-->
	
		<div class="header-bottom"><!--header-bottom-->
			<div class="container">
				<div class="row">
					<div class="col-sm-9">
						<div class="navbar-header">
							<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
								<span class="sr-only">Toggle navigation</span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</button>
						</div>
						<div class="mainmenu pull-left">
							<ul class="nav navbar-nav collapse navbar-collapse">
								<li><a href="{{ url('/frontend/index') }}" class="active">Trang chủ</a></li>
								<!-- <li class="dropdown"><a href="#">Shop<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="shop.html">Products</a></li>
										<li><a href="product-details.html">Product Details</a></li> 
										<li><a href="checkout.html">Checkout</a></li> 
										<li><a href="cart.html">Cart</a></li> 
										<li><a href="login.html">Login</a></li> 
                                    </ul>
                                </li>  -->
								<li class="dropdown"><a href="#">Bài viết<i class="fa fa-angle-down"></i></a>
                                    <ul role="menu" class="sub-menu">
                                        <li><a href="{{ url('/frontend/blog_list') }}">Danh sách bài viết</a></li>
										<!-- <li><a href="blog-single.html">Blog Single</a></li> -->
                                    </ul>
                                </li> 
								<li><a href="404.html">404</a></li>
								<li><a href="{{ url('/frontend/contact') }}">Liên hệ</a></li>
								<li><a href="{{ url('/frontend/search_advanced') }}">Tìm kiếm nâng cao</a></li>
							</ul>
						</div>
					</div>
					<div class="col-sm-3">
						<div class="search_box pull-right">
							<form action="{{ url('/frontend/search') }}" method="GET" enctype="multipart/form-data">
								<input type="text" name="name" placeholder="Tìm kiếm"/>
								<button type="submit" name="submit">Tìm kiếm</button>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div><!--/header-bottom-->
	</header><!--/header-->