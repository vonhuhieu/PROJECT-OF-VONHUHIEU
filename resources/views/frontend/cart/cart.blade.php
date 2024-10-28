@extends('frontend/layout.layout')

@section('content')
    <section id="cart_items">
		<div class="container">
			<div class="breadcrumbs">
				<ol class="breadcrumb">
				  <li><a href="#">Home</a></li>
				  <li class="active">Shopping Cart</li>
				</ol>
			</div>
			<div class="table-responsive cart_info">
				<table class="table table-condensed">
					<thead>
						<tr class="cart_menu">
							<td class="image">Hình ảnh</td>
							<td class="description"></td>
							<td class="price">Giá</td>
							<td class="quantity">Số lượng</td>
							<td class="total">Tổng tiền</td>
							<td></td>
						</tr>
					</thead>
					<tbody>
						<?php
                            $total_qty = 0;
                            $total_final = 0;
                            if(session()->has('cart'))
                            {
                                foreach(session()->get('cart') as $key => $value)
                                {
                                    $total_qty += $value['qty'];
                                    $price = str_replace(',', '', $value['price']);
                                    $total = $value['qty'] * $price;
                                    $total_final += $value['qty'] * $price;
                        ?>
                                    <tr id="<?php echo $key; ?>">
							            <td class="cart_product">
								            <a href=""><img style="width:110px; height:110px" src="<?php echo $value['image']; ?>" alt=""></a>
							            </td>
							            <td class="cart_description">
								            <h4><a href=""></a><?php echo $value['name']; ?></h4>
								            <p>Web ID: <?php echo $key; ?></p>
							            </td>
							            <td class="cart_price">
								            <p><?php echo number_format($value['price'],0,'',','); ?> VNĐ</p>
							            </td>
							            <td class="cart_quantity">
								            <div class="cart_quantity_button">
									            <a class="cart_quantity_up"> + </a>
									            <input class="cart_quantity_input" type="text" name="quantity" value="<?php echo $value['qty']; ?>" autocomplete="off" size="2">
									            <a class="cart_quantity_down"> - </a>
								            </div>
							            </td>
							            <td class="cart_total">
								            <p class="cart_total_price"><?php echo $total; ?> VNĐ</p>
							            </td>
							            <td class="cart_delete">
								            <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
							            </td>
						</tr>
                        <?php
                                }
                            }
                        ?>
					</tbody>
				</table>
			</div>
		</div>
	</section> <!--/#cart_items-->

	<section id="do_action">
		<div class="container">
			
			<div class="row">
				<div class="col-sm-6">

				</div>
				<div class="col-sm-6">
					<div class="total_area">
						<ul>
							<li class="quantity">Số lượng <span><?php echo $total_qty; ?></span></li>
							<li>Thuế <span>Không có</span></li>
							<li>Chi phí vận chuyển <span>Miễn phí</span></li>
							<li class="total">Giá trị đơn hàng <span><?php echo $total_final; ?> VNĐ</span></li>
						</ul>
							<a class="btn btn-default update" href="{{ url('/frontend/index') }}">Tiếp tục mua sắm</a>
							<a class="btn btn-default check_out" href="{{ url('/frontend/checkout') }}">Thanh toán</a>
					</div>
				</div>
			</div>
		</div>
	</section><!--/#do_action-->
@endsection

@section('js')
    <script>
        $(document).ready(function(){
            $.ajaxSetup({
                headers: {

                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $("a.cart_quantity_up").click(function(){
                var image = $(this).closest("tr").find("img").attr("src");
                var id_product = $(this).closest("tr").find("td.cart_description").find("p").text().replace("Web ID: ","");
                var name = $(this).closest("tr").find("td.cart_description").find("h4").text();
                var price = $(this).closest("tr").find("td.cart_price").find("p").text().replace(" VNĐ", "");
                var qty = $(this).closest("tr").find("input").val();
                $.ajax({
                    method:"POST",
                    url:"{{ url('/frontend/cart_quantity_up') }}",
                    data:{
                        image:image,
                        id_product:id_product,
                        name:name,
                        price:price,
                        qty:qty,
                    },
                    success:function(response){
                        console.log(response);
                        $("tr#" + response.id_product).find("input").val(response.qty);
                        var total = response.qty * response.price;
                        $("tr#" + response.id_product).find("p.cart_total_price").text(total + " VNĐ");
                        $("li.quantity").find("span").text(response.total_qty);
                        $("li.total").find("span").text(response.total_final + " VNĐ");
                        if(response.total_qty > 0)
                        {
                            $("a#cart").text(response.total_qty);
                        }
                        else
                        {
                            $("a#cart").text("Giỏ hàng");
                        }
                    }
                })
            })

            $("a.cart_quantity_down").click(function(){
                var image = $(this).closest("tr").find("img").attr("src");
                var id_product = $(this).closest("tr").find("td.cart_description").find("p").text().replace("Web ID: ","");
                var name = $(this).closest("tr").find("td.cart_description").find("h4").text();
                var price = $(this).closest("tr").find("td.cart_price").find("p").text().replace(" VNĐ", "");
                var qty = $(this).closest("tr").find("input").val();
                $.ajax({
                    method:"POST",
                    url:"{{ url('/frontend/cart_quantity_down') }}",
                    data:{
                        image:image,
                        id_product:id_product,
                        name:name,
                        price:price,
                        qty:qty,
                    },
                    success:function(response){
                        console.log(response);
                        if(response.qty == "")
                        {
                            $("tr#" + response.id_product).remove();
                        }
                        else
                        {
                            $("tr#" + response.id_product).find("input").val(response.qty);
                            var total = response.qty * response.price;
                            $("tr#" + response.id_product).find("p.cart_total_price").text(total + " VNĐ");
                        }
                        $("li.quantity").find("span").text(response.total_qty);
                        $("li.total").find("span").text(response.total_final + " VNĐ");
                        if(response.total_qty > 0)
                        {
                            $("a#cart").text(response.total_qty);
                        }
                        else
                        {
                            $("a#cart").text("Giỏ hàng");
                        }
                    }
                })
            })

            $("a.cart_quantity_delete").click(function(){
                var id_product = $(this).closest("tr").find("td.cart_description").find("p").text().replace("Web ID: ","");
                $.ajax({
                    method:"POST",
                    url:"{{ url('/frontend/cart_quantity_delete') }}",
                    data:{
                        id_product:id_product,
                    },
                    success:function(response){
                        console.log(response);
                        $("tr#" + response.id_product).remove();
                        $("li.quantity").find("span").text(response.total_qty);
                        $("li.total").find("span").text(response.total_final + " VNĐ");
                        if(response.total_qty > 0)
                        {
                            $("a#cart").text(response.total_qty);
                        }
                        else
                        {
                            $("a#cart").text("Giỏ hàng");
                        }
                    }
                })
            })

            var quantity = $("li.quantity").find("span").text();
            if(quantity > 0)
            {
                $("a#cart").text(quantity);
            }
        })
    </script>
@endsection