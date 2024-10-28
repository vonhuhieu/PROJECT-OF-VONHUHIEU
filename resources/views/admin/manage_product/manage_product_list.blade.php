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
                                                <th scope="col">Email người bán</th>
                                                <th scope="col">Hình ảnh</th>
                                                <th scope="col">Tên sản phẩm</th>
                                                <th scope="col">Giá (VNĐ)</th>
                                                <th scope="col">Danh mục</th>
                                                <th scope="col">Thương hiệu</th>
                                                <th scope="col">Tình trạng</th>
                                                <th scope="col">Sale (%)</th>
                                                <th scope="col">Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                use App\Models\frontend\Product;
                                                use App\Models\User;
                                                foreach($products as $key => $value)
                                                {
                                                    $images = json_decode($value->image, true);
                                                    if($images != null)
                                                    {
                                                        $image = $images[0];
                                                    }
                                                    else
                                                    {
                                                        $image = "";
                                                    }
                                            ?>
                                                    <tr>
                                                        <td><?php echo $value->id; ?></td>
                                                        <td><?php echo Product::findOrFail($value->id)->user->email; ?></td>
                                                        <td><img style="width:350px; height:350px" src="{{ asset('/frontend/product/'.$value->id_user.'/'.$value->id.'/'.$image) }}"></td>
                                                        <td><?php echo $value->name; ?></td>
                                                        <td><?php echo number_format($value->price,0,'',','); ?></td>
                                                        <td><?php echo Product::findOrFail($value->id)->category->name; ?></td>
                                                        <td><?php echo Product::findOrFail($value->id)->brand->name; ?></td>
                                                        <td><?php echo ($value->status == 0) ? "Sale" : "New"; ?></td>
                                                        <td><?php echo ($value->status == 0) ? $value->sale : "X"; ?></td>
                                                        <td><a href="{{ url('/admin/delete_product', ['id_product' => $value->id]) }}">Xóa</a></td>
                                                        <td>
                                                            <label>Duyệt</label>
                                                            <input type="checkbox">
                                                        </td>
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