@extends('frontend/layout.layout')

@section('content')
    <section id="form"><!--form-->
		<div class="container">
			<div class="row">
				<div class="col-sm-4 col-sm-offset-1">
					<div class="login-form"><!--login form-->
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

						<h2>Đăng nhập vào tài khoản của bạn</h2>
						<form action="" method="POST" enctype="multipart/form-data">
                            @csrf 

							<input type="email" name="email" placeholder="Vui lòng nhập email" />
                            @error('email')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                            <br></br>

							<input type="password" name="password" placeholder="Vui lòng nhập mật khẩu" />
                            @error('password')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                            <br></br>
							<span>
								<input type="checkbox" class="checkbox"> 
								Keep me signed in
							</span>
                            <br></br>
                            <a href="{{ url('/frontend/member_forget_password') }}">Quên mật khẩu</a>
							<button type="submit" name="submit" class="btn btn-default">Đăng nhập</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection