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

						<h2>Quên mật khẩu</h2>
						<form action="{{ url('/frontend/member_reset_password/'.$token) }}" method="POST" enctype="multipart/form-data">
                            @csrf 

                            <input type="hidden" name="token" value="<?php echo $token; ?>">
                            <br></br>

							<input type="password" name="password" placeholder="Vui lòng nhập mật khẩu mới" />
                            @error('password')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                            <br></br>

                            <input type="password" name="password_confirm" placeholder="Vui lòng nhập lại mật khẩu mới" />
                            @error('password_confirm')
                                <p style="color: red">{{ $message }}</p>
                            @enderror
                            <br></br>

							<button type="submit" name="submit" class="btn btn-default">Xác nhận</button>
						</form>
					</div><!--/login form-->
				</div>
			</div>
		</div>
	</section><!--/form-->
@endsection