@extends('frontend/layout.layout')

@section('content')
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="{{ url('/frontend/index') }}">Trang chủ</a></li>
				  <li class="active">Thanh toán</li>
				</ol>
			</div><!--/breadcrums-->
			
			@if(!Auth::check())
                <div class="step-one">
				    <h2 class="heading">Đăng ký (Nếu chưa đăng nhập)</h2>
			    </div>

                <div class="shopper-informations">
				        <div class="row">
					        <div class="col-sm-3">
						        <div class="shopper-info">
                                    @if(session('success'))
                                        <div class="alert alert-success alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                            {{session('success')}}
                                        </div>
                                    @endif
                                
                                    @if($errors->any())
                                        <div class="alert alert-danger alert-dismissible">
                                            <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                                            <h4><i class="icon fa fa-check"></i> Thông báo!</h4>
                                            <ul>
                                                @foreach($errors->all() as $error)
                                                    <li>{{$error}}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif

                                    <form class="form-horizontal form-material" action="" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-group">
                                            <label class="col-md-12">Họ tên</label>
                                            <div class="col-md-12">
                                                <input type="text" name="name" placeholder="Mời nhập họ tên" class="form-control form-control-line">
                                                @error('name')
                                                    <p style="color: red; ">{{ $message }}</p>
                                                @enderror
                                                <br></br>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="example-email" class="col-md-12">Email</label>
                                            <div class="col-md-12">
                                                <input type="email" name="email" placeholder="Mời nhập email" class="form-control form-control-line">
                                                @error('email')
                                                    <p style="color: red; ">{{ $message }}</p>
                                                @enderror
                                                <br></br>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Mật khẩu</label>
                                            <div class="col-md-12">
                                                <input type="password" name="password" placeholder="Mời nhập mật khẩu" class="form-control form-control-line">
                                                @error('password')
                                                    <p style="color: red; ">{{ $message }}</p>
                                                @enderror
                                                <br></br>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Nhập lại mật khẩu</label>
                                            <div class="col-md-12">
                                                <input type="password" name="password_confirm" placeholder="Mời nhập lại mật khẩu" class="form-control form-control-line">
                                                @error('password_confirm')
                                                    <p style="color: red; ">{{ $message }}</p>
                                                @enderror
                                                <br></br>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Số điện thoại</label>
                                            <div class="col-md-12">
                                                <input type="text" name="phone" placeholder="Mời nhập số điện thoại" class="form-control form-control-line">
                                                @error('phone')
                                                    <p style="color: red; ">{{ $message }}</p>
                                                @enderror
                                                <br></br>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Địa chỉ</label>
                                            <div class="col-md-12">
                                                <input type="text" name="address" placeholder="Mời nhập địa chỉ" class="form-control form-control-line">
                                                @error('address')
                                                    <p style="color: red; ">{{ $message }}</p>
                                                @enderror
                                                <br></br>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-md-12">Ảnh đại diện</label>
                                            <div class="col-md-12">
                                                <input type="file" name="avatar" class="form-control form-control-line">
                                                @error('avatar')
                                                    <p style="color: red; ">{{ $message }}</p>
                                                @enderror
                                                <br></br>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="col-sm-12">Quốc tịch</label>
                                            <div class="col-sm-12">
                                                <select name="id_country" class="form-control form-control-line">
                                                    <option value="">Mời chọn quốc tịch</option>
                                                    <?php
                                                        foreach($countries as $key => $value)
                                                        {
                                                    ?>
                                                            <option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                                    <?php
                                                        }
                                                    ?>
                                                </select>
                                                <br></br>
                                            </div>
                                        </div>

                                        <div class="review-payment">
				                            <h2>Đơn hàng</h2>
			                            </div>

			                            <div style="width:938px"class="table-responsive cart_info">
				                            <table class="table table-condensed">
					                            <thead>
						                            <tr class="cart_menu">
							                            <td class="image">Hình ảnh</td>
							                            <td class="description"></td>
							                            <td class="price">Giá</td>
							                            <td class="quantity">Số lượng</td>
							                            <td class="total">Tổng tiền</td>
						                            </tr>
					                            </thead>
					                            <tbody>
						                        <?php
                                                    $total_qty = 0;
                                                    $total_final = 0;
                                                    if(session()->has('cart'))
                                                    {
                                                        if(!empty(session()->get('cart'))){
                                                        foreach(session()->get('cart') as $key => $value)
                                                        {
                                                            $total_qty += $value['qty'];
                                                            $price = str_replace(',', '', $value['price']);
                                                            $total = $price * $value['qty'];
                                                            $total_final += $value['qty'] * $price;
                                                ?>
                                                            <tr>
							                                    <td class="cart_product">
								                                    <a href=""><img style="width:110px; height:110px" src="<?php echo $value['image']; ?>" alt=""></a>
							                                    </td>
							                                    <td class="cart_description">
								                                    <h4><a href=""><?php echo $value['name']; ?></a></h4>
								                                    <p>Web ID: <?php echo $key; ?></p>
							                                    </td>
							                                    <td class="cart_price">
								                                    <p><?php echo $value['price']; ?> VNĐ</p>
							                                    </td>
							                                    <td class="cart_quantity">
								                                    <div class="cart_quantity_button">
									                                    <input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $value['qty']; ?>" autocomplete="off" size="2">
								                                    </div>
							                                    </td>
							                                    <td class="cart_total">
								                                    <p class="cart_total_price"><?php echo $total; ?> VNĐ</p>
							                                    </td>
						                                    </tr>
                                                <?php
                                                        }}
                                                    }
                                                ?>

						                            <tr>
							                                <td colspan="4">&nbsp;</td>
							                                <td colspan="2">
								                            <table class="table table-condensed total-result">
									                            <tr>
										                            <td>Số lượng</td>
										                            <td><?php echo $total_qty; ?></td>
									                            </tr>
									                            <tr>
										                            <td>Thuế</td>
										                            <td>Không</td>
									                            </tr>
									                            <tr class="shipping-cost">
										                            <td>Phí vận chuyển</td>
										                            <td>Miễn phí</td>										
									                            </tr>
									                            <tr>
										                            <td>Giá trị đơn hàng</td>
										                            <td><span><?php echo $total_final; ?> VNĐ</span></td>
									                            </tr>
                                                                <tr>
                                                                    <td><a class="btn btn-default update" href="{{ url('/frontend/index') }}">Tiếp tục mua sắm</a></td>
                                                                    @if(!empty(session()->get('cart')))
                                                                        <td><button type="submit" name="submit" class="btn btn-default check_out">Thanh toán</button></td>
                                                                    @endif
                                                                </tr>
								                            </table>
							                            </td>
						                            </tr>
					                            </tbody>
				                            </table>
			                            </div>
                                    </form>
						    </div>
					    </div>
								
				    </div>
			    </div>

            @else
                <form action="" method="POST" enctype="multipart/form-data">
                    @csrf 

                    <div class="review-payment">
				        <h2>Đơn hàng</h2>
			        </div>

			        <div class="table-responsive cart_info">
				        <table class="table table-condensed">
					        <thead>
						        <tr class="cart_menu">
							        <td class="image">Hình ảnh</td>
							        <td class="description"></td>
							        <td class="price">Giá</td>
							        <td class="quantity">Số lượng</td>
							        <td class="total">Tổng tiền</td>
							        <td></td>
						        </tr>
					        </thead>
					        <tbody>
						        <?php
                                    $total_qty = 0;
                                    $total_final = 0;
                                    if(session()->has('cart'))
                                    {
                                        if(!empty(session()->get('cart'))){
                                        foreach(session()->get('cart') as $key => $value)
                                        {
                                            $total_qty += $value['qty'];
                                            $price = str_replace(',', '', $value['price']);
                                            $total = $price * $value['qty'];
                                            $total_final += $value['qty'] * $price;
                                ?>
                                            <tr>
							                    <td class="cart_product">
								                    <a href=""><img style="width:110px; height:110px" src="<?php echo $value['image']; ?>" alt=""></a>
							                    </td>
							                    <td class="cart_description">
								                    <h4><a href=""><?php echo $value['name']; ?></a></h4>
								                    <p>Web ID: <?php echo $key; ?></p>
							                    </td>
							                    <td class="cart_price">
								                    <p><?php echo $value['price']; ?> VNĐ</p>
							                    </td>
							                    <td class="cart_quantity">
								                    <div class="cart_quantity_button">
									                    <input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $value['qty']; ?>" autocomplete="off" size="2">
								                    </div>
							                    </td>
							                    <td class="cart_total">
								                    <p class="cart_total_price"><?php echo $total; ?> VNĐ</p>
							                    </td>
						                    </tr>
                                <?php
                                        }}
                                    }
                                ?>

						        <tr>
							        <td colspan="4">&nbsp;</td>
							        <td colspan="2">
								        <table class="table table-condensed total-result">
									        <tr>
										        <td>Số lượng</td>
										        <td><?php echo $total_qty; ?></td>
									        </tr>
									        <tr>
										        <td>Thuế</td>
										        <td>Không</td>
									        </tr>
									        <tr class="shipping-cost">
										        <td>Phí vận chuyển</td>
										        <td>Miễn phí</td>										
									        </tr>
									        <tr>
										        <td>Giá trị đơn hàng</td>
										        <td><span><?php echo $total_final; ?> VNĐ</span></td>
									        </tr>
                                            <tr>
                                                <td><a class="btn btn-default update" href="{{ url('/frontend/index') }}">Tiếp tục mua sắm</a></td>
                                                @if(!empty(session()->get('cart')))
                                                    <td><button type="submit" name="submit" class="btn btn-default check_out">Thanh toán</button></td>
                                                @endif
                                            </tr>
								        </table>
							        </td>
						        </tr>
					        </tbody>
				        </table>
			        </div>
                </form>
            @endif
			
		</div>
	</section> <!--/#cart_items-->
@endsection