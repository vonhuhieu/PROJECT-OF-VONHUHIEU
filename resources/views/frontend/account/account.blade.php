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