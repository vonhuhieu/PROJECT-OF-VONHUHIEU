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
                                    <label>Chủ đề</label>
                                    <input type="text" name="subject" value="<?php echo $subject; ?>" class="form-control" placeholder="Mời nhập chủ đề">
                                    @error('subject')
                                        <p style="color: red">{{ $message }}</p>
                                    @enderror
                                    <br></br>

                                    <label>Phản hồi</label>
                                    <textarea name="replay" id="demo"></textarea>
                                    @error('replay')
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