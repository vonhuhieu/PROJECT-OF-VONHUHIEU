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
					<div class="blog-post-area">
						<h2 class="title text-center">Cập nhật tài khoản</h2>
						<div class="signup-form"><!--sign up form-->
						    <h2>Cập nhật tài khoản</h2>
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
                                        <input type="text" name="name" value="<?php echo Auth::user()->name; ?>" placeholder="Mời nhập họ tên" class="form-control form-control-line">
                                        @error('name')
                                            <p style="color: red; ">{{ $message }}</p>
                                        @enderror
                                        <br></br>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="example-email" class="col-md-12">Email</label>
                                    <div class="col-md-12">
                                        <input type="email" name="email" value="<?php echo Auth::user()->email; ?>" placeholder="Mời nhập email" class="form-control form-control-line">
                                        @error('email')
                                            <p style="color: red; ">{{ $message }}</p>
                                        @enderror
                                        <br></br>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Mật khẩu mới (nếu muốn thay đổi)</label>
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
                                        <input type="text" name="phone" value="<?php echo Auth::user()->phone; ?>" placeholder="Mời nhập số điện thoại" class="form-control form-control-line">
                                        @error('phone')
                                            <p style="color: red; ">{{ $message }}</p>
                                        @enderror
                                        <br></br>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-12">Địa chỉ</label>
                                    <div class="col-md-12">
                                        <input type="text" name="address" value="<?php echo Auth::user()->address; ?>" placeholder="Mời nhập địa chỉ" class="form-control form-control-line">
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

                                <div class="form-group">
                                    <div class="col-sm-12">
                                        <button type="submit" name="submit" class="btn btn-success">Cập nhật</button>
                                    </div>
                                </div>
                            </form>
					    </div>
					</div>
				</div>
@endsection