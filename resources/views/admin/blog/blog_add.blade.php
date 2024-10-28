@extends('admin/layout.layout')

@section('content')
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

            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <div class="card card-body">
                            <form class="form-horizontal m-t-30" action="" method="POST" enctype="multipart/form-data">
                                @csrf 

                                <div class="form-group">
                                    <label>Tiêu đề</label>
                                    <input type="text" name="title" class="form-control" placeholder="Mời nhập tiêu đề bài viết">
                                    @error('title')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                    <br></br>
                                </div>

                                <div class="form-group">
                                    <label>Hình ảnh</label>
                                    <input type="file" name="image" class="form-control">
                                    @error('image')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                    <br></br>
                                </div>

                                <div class="form-group">
                                    <label>Nội dung</label>
                                    <textarea rows="5" name="content" placeholder="Mời nhập nội dung" id="demo" class="form-control form-control-line"></textarea>
                                    @error('content')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                    <br></br>
                                </div>

                                <div class="form-group">
                                    <input type="submit" name="submit" class="form-control" value="Xác nhận">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
@endsection