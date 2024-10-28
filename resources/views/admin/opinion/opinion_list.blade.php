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
                        <div class="card">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">id</th>
                                                <th scope="col">Họ tên người dùng</th>
                                                <th scope="col">Email người dùng</th>
                                                <th scope="col">Chủ đề</th>
                                                <th scope="col">Góp ý</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($user_opinions as $key => $value)
                                                {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $value->id; ?></td>
                                                        <td><?php echo $value->name; ?></td>
                                                        <td><?php echo $value->email; ?></td>
                                                        <td><?php echo $value->subject; ?></td>
                                                        <td><?php echo $value->opinion; ?></td>
                                                        <td><a href="{{ url('/admin/opinion_delete', ['id_opinion' => $value->id]) }}">Xóa</a></td>
                                                        <td><a href="{{ url('/admin/opinion_replay', ['id_opinion' => $value->id]) }}">Trả lời</a></td>
                                                    </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                    
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
@endsection