@extends('admin/layout.layout')

@section('content')
            <div class="page-breadcrumb">
                <div class="row">
                    <div class="col-5 align-self-center">
                        <h4 class="page-title">Profile</h4>
                    </div>
                    <div class="col-7 align-self-center">
                        <div class="d-flex align-items-center justify-content-end">
                            <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="#">Home</a>
                                    </li>
                                    <li class="breadcrumb-item active" aria-current="page">Profile</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

            <div class="container-fluid">
                
                <div class="row">
                    <!-- Column -->
                    <div class="col-lg-4 col-xlg-3 col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <center class="m-t-30"> <img src="{{ asset('/admin/avatar/'.Auth::user()->avatar) }}" class="rounded-circle" width="150" />
                                    <h4 class="card-title m-t-10">Hanna Gover</h4>
                                    <h6 class="card-subtitle">Accoubts Manager Amix corp</h6>
                                    <div class="row text-center justify-content-md-center">
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-people"></i> <font class="font-medium">254</font></a></div>
                                        <div class="col-4"><a href="javascript:void(0)" class="link"><i class="icon-picture"></i> <font class="font-medium">54</font></a></div>
                                    </div>
                                </center>
                            </div>
                            <div>
                                <hr> </div>
                            <div class="card-body"> <small class="text-muted">Địa chỉ email </small>
                                <h6><?php echo Auth::user()->email; ?></h6> <small class="text-muted p-t-30 db">Số điện thoại</small>
                                <h6><?php echo Auth::user()->phone; ?></h6> <small class="text-muted p-t-30 db">Địa chỉ</small>
                                <h6><?php echo Auth::user()->address; ?></h6>
                                <div class="map-box">
                                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d470029.1604841957!2d72.29955005258641!3d23.019996818380896!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x395e848aba5bd449%3A0x4fcedd11614f6516!2sAhmedabad%2C+Gujarat!5e0!3m2!1sen!2sin!4v1493204785508" width="100%" height="150" frameborder="0" style="border:0" allowfullscreen></iframe>
                                </div> <small class="text-muted p-t-30 db">Social Profile</small>
                                <br/>
                                <button class="btn btn-circle btn-secondary"><i class="mdi mdi-facebook"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="mdi mdi-twitter"></i></button>
                                <button class="btn btn-circle btn-secondary"><i class="mdi mdi-youtube-play"></i></button>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                    <!-- Column -->
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
                                            <button type="submit" name="submit" class="btn btn-success">Cập nhật tài khoản</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Column -->
                </div>
                <!-- Row -->
                <!-- ============================================================== -->
                <!-- End PAge Content -->
                <!-- ============================================================== -->
                <!-- ============================================================== -->
                <!-- Right sidebar -->
                <!-- ============================================================== -->
                <!-- .right-sidebar -->
                <!-- ============================================================== -->
                <!-- End Right sidebar -->
                <!-- ============================================================== -->
            </div>
@endsection