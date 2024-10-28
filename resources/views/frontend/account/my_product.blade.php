@extends('frontend/layout.layout')

@section('left')
                        <h2>Account</h2>
						<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							
							
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{ url('/frontend/account/account_update') }}">Cập nhật tài khoản</a></h4>
								</div>
							</div>
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title"><a href="{{ url('/frontend/account/my_product') }}">Sản phẩm đăng bán</a></h4>
								</div>
							</div>
							
						</div>
@endsection

@section('content')
                <div class="col-sm-9">
					<div class="table-responsive cart_info">
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
						<table class="table table-condensed">
							<thead>
								<tr class="cart_menu">
									<td class="image">Hình ảnh</td>
									<td class="description">Tên</td>
									<td class="price">Giá</td>
									<td class="total">Thao tác</td>
								</tr>
							</thead>
							<tbody>
								<?php
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
										<tr>
											<td class="cart_product">
												<a href=""><img style="width:110px; height:110px" src="{{ asset('/frontend/product/'.$value->id_user.'/'.$value->id.'/'.$image) }}" alt=""></a>
											</td>
											<td class="cart_description">
												<h4><a href=""><?php echo $value->name; ?></a></h4>
										
											</td>
											<td class="cart_price">
												<p><?php echo number_format($value->price,0,'',','); ?> VNĐ</p>
											</td>
					
											<td class="cart_total">
												<a href="{{ url('/frontend/account/update_product', ['id_product' => $value->id]) }}">Cập nhật</a>
												<a href="{{ url('/frontend/account/delete_product', ['id_product' => $value->id]) }}">Xóa</a>
											</td>
										</tr>
								<?php
									}
								?>
							</tbody>
                            <tfoot>
                                <tr style="text-align:right">
                                    <td colspan="3"><a href="{{ url('/frontend/account/add_product') }}">Thêm sản phẩm</a></td>
                                </tr>
                            </tfoot>
						</table>
					</div>
				</div>
@endsection