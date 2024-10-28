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
                                                <th scope="col">Tên thương hiệu</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                foreach($brands as $key => $value)
                                                {
                                            ?>
                                                    <tr>
                                                        <td><?php echo $value->id; ?></td>
                                                        <td><?php echo $value->name; ?></td>
                                                        <td><a href="{{ url('/admin/brand_delete', ['id_brand' => $value->id]) }}">Xóa</a></td>
                                                    </tr>
                                            <?php
                                                }
                                            ?>
                                        </tbody>
                                        <tfoot>
                                            <tr style="text-align: right">
                                                <td colspan="2"><a href="{{ url('/admin/brand_add') }}">Thêm</a></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                    
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
@endsection