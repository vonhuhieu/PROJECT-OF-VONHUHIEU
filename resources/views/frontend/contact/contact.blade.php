@extends('frontend/layout.layout')

@section('content')
    <div id="contact-page" class="container">
    	<div class="bg"> 	
    		<div class="row">  	
	    		<div class="col-sm-8">
	    			<div class="contact-form">
	    				<h2 class="title text-center">Đóng góp ý kiến của bạn vào mẫu dưới đây</h2>
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

	    				<div class="status alert alert-success" style="display: none"></div>
				    	<form id="main-contact-form" class="contact-form row" name="contact-form" action="" method="POST" enctype="multipart/form-data">
                            @csrf 

				            <div class="form-group col-md-6">
				                <input type="text" name="name" value="<?php echo Auth::user()->name; ?>" class="form-control" placeholder="Vui lòng nhập họ tên của bạn">
				            </div>
				            <div class="form-group col-md-6">
				                <input type="email" name="email" value="<?php echo Auth::user()->email; ?>" class="form-control" required="required" placeholder="Vui lòng nhập email của bạn">
				            </div>
				            <div class="form-group col-md-12">
				                <input type="text" name="subject" class="form-control" required="required" placeholder="Vui lòng nhập chủ đề góp ý của bạn">
                                @error('subject')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
				            </div>
				            <div class="form-group col-md-12">
				                <textarea name="opinion" id="demo" required="required" class="form-control" rows="8" placeholder="Đóng góp ý kiến của bạn tại đây"></textarea>
                                @error('opinion')
                                    <p style="color: red">{{ $message }}</p>
                                @enderror
				            </div>                        
				            <div class="form-group col-md-12">
				                <input type="submit" name="submit" class="btn btn-primary pull-right" value="Xác nhận">
				            </div>
				        </form>
	    			</div>
	    		</div>	
	    	</div>  
    	</div>	
    </div><!--/#contact-page-->
@endsection