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
						<h2 class="title text-center">Cập nhật sản phẩm</h2>
						 <div class="signup-form"><!--sign up form-->
						<h2>Cập nhật sản phẩm</h2>

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
                        
						<form action="" method="POST" enctype="multipart/form-data">
                            @csrf 

							<label><b>Tên sản phẩm</b></label>
							<input type="text" name="name" value="<?php echo $product->name; ?>" placeholder="Mời nhập tên sản phẩm">
							@error('name')
								<p style="color: red">{{ $message }}</p>
							@enderror
							<br></br>

							<label><b>Giá sản phẩm (đơn vị: VNĐ)</b></label>
							<input type="text" name="price" value="<?php echo number_format($product->price,0,'',','); ?>" placeholder="Mời nhập giá sản phẩm">
							@error('price')
								<p style="color: red">{{ $message }}</p>
							@enderror
							<br></br>

							<label><b>Danh mục</b></label>
							<select name="id_category">
								<option value="">Mời chọn danh mục</option>
								<?php
									foreach($categories as $key => $value)
									{
								?>
										<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
								<?php
									}
								?>
							</select>
							@error('id_category')
								<p style="color: red">{{ $message }}</p>
							@enderror
							<br></br>

							<label><b>Thương hiệu</b></label>
							<select name="id_brand">
								<option value="">Mời chọn thương hiệu</option>
								<?php
									foreach($brands as $key => $value)
									{
								?>
										<option value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
								<?php
									}
								?>
							</select>
							@error('id_brand')
								<p style="color: red">{{ $message }}</p>
							@enderror
							<br></br>

							<label><b>Tình trạng</b></label>
							<select name="status" id="status">
								<option value="">Mời chọn tình trạng</option>
								<option value="0">Sale</option>
								<option value="1">New</option>
							</select>
							@error('status')
								<p style="color: red">{{ $message }}</p>
							@enderror
							<br></br>

							<div id="sale">
								<label><b>Sale (nếu có)</b></label>
								<input type="text" name="sale" value="<?php echo $product->sale; ?>" placeholder="Mời nhập % sale">
								@error('sale')
								<p style="color: red">{{ $message }}</p>
							@enderror
								<br></br>
							</div>

							<label><b>Tên công ty</b></label>
							<input type="text" name="company" value="<?php echo $product->company; ?>" placeholder="Mời nhập tên công ty">
							@error('company')
								<p style="color: red">{{ $message }}</p>
							@enderror
							<br></br>

							<label><b>Thông tin chi tiết</b></label>
							<textarea rows="5" name="detail" placeholder="Mời nhập thông tin chi tiết" id="demo" class="form-control form-control-line"><?php echo $product->detail; ?></textarea>
							@error('detail')
								<p style="color: red">{{ $message }}</p>
							@enderror
							<br></br>

							<label><b>Hình ảnh</b></label>
							<input type="file" name="image[]" multiple>
							@error('image')
								<p style="color: red">{{ $message }}</p>
							@enderror
							<br></br>
                            
                            <label>Chọn hình muốn xóa</label>
                            <ul style="list-style:none">
                                <?php
                                    $images = json_decode($product->image, true);
                                    if($images != null)
                                    {
                                        foreach($images as $key => $value)
                                        {
                                ?>
                                            <li style="display:inline-block">
                                                <img src="{{ asset('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.'hinh85_'.$value) }}">
                                            </li>
                                            <li style="display:inline-block">
                                                <input type="checkbox" name="hinhxoa[]" value="<?php echo $value; ?>">
                                            </li>
                                <?php
                                        }
                                    }
                                ?>
                            </ul>
							<button type="submit" class="btn btn-default">Cập nhật sản phẩm</button>
						</form>
					</div>
					</div>
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

			$("select#status").click(function(){
				var status = $("select#status").val();
				$.ajax({
					method:"POST",
					url:"{{ url('/frontend/account/add_product_show_sale_input') }}",
					data:{
						status: status,
					},
					success:function(response){
						console.log(response);
						if(response.status == 0)
						{
							$("div#sale").show();
						}
						else
						{
							$("div#sale").hide();
						}
					}
				})
			})
		})
	</script>
@endsection