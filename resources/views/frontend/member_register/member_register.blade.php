@extends('frontend/layout.layout')

@section('content')
                    <div class="col-lg-8 col-xlg-9 col-md-7">
                        <div class="card">
                            <div class="card-body">

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

                                    <!-- <div class="form-group">
                                        <label class="col-md-12">Message</label>
                                        <div class="col-md-12">
                                            <textarea rows="5" class="form-control form-control-line"></textarea>
                                        </div>
                                    </div> -->

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
                                            <button type="submit" name="submit" class="btn btn-success">Đăng ký</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
@endsection