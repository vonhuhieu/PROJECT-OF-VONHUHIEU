<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Mail;
use App\Mail\CheckOutMail;
use Illuminate\Validation\Rule;
use Validator;
use App\Models\User;
use App\Models\admin\Country;
use Illuminate\Support\Facades\Auth;
use App\Models\frontend\History;

class CheckoutController extends Controller
{
    //
    public function checkout_form()
    {
        $countries = Country::all();
        return view('frontend/checkout/checkout', compact('countries'));
    }

    public function checkout(Request $request)
    {
        if(Auth::check())
        {
            $id_user = Auth::id();
            $email = Auth::user()->email;
            $phone = Auth::user()->phone;
            $name = Auth::user()->name;
        }
        else
        {
            $validate = $request->validate(
                [
                    'name' => 'required|max:200',
                    'email' => [
                        'required',
                        'email',
                        'max:200',
                        Rule::unique('users'),
                    ],
                    'password' => 'required|min:8',
                    'password_confirm' => 'same:password',
                    'phone' => [
                        'nullable',
                        Rule::unique('users'),
                    ],
                    'address' => 'nullable|max:200',
                    'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
                    'id_country' => 'nullable'
                ],

                [
                    'name.required' => 'Họ tên không được để trống',
                    'name.max' => 'Họ tên không được nhập quá :max ký tự',

                    'email.required' => 'Email không được để trống',
                    'email.email' => 'Email sai định dạng',
                    'email.max' => 'Email không được nhập quá :max ký tự',
                    'email.unique' => 'Email đã được sử dụng bởi người khác',

                    'password.required' => 'Mật khẩu không được để trống',
                    'password.min' => 'Mật khẩu phải nhập tối thiểu 8 ký tự',

                    'password_confirm.same' => 'Mật khẩu nhập lại không khớp',

                    'phone.unique' => 'Số điện thoại đã được sử dụng bởi người khác',
                    'address.max' => 'Địa chỉ không được nhập quá 200 ký tự',
                    'avatar.image' => 'Ảnh đại diện sai định dạng',
                    'avatar.mimes' => 'Ảnh đại diện sai định dạng',
                    'avatar.max' => 'Ảnh đại diện phải có dung lượng dưới 1MB', 
                ],
            );
            $validate['avatar'] = $request->hasFile('avatar') ? $request->file('avatar')->getClientOriginalName() : null;
            $new_user = new User();
                $new_user->name = $validate['name'];
                $new_user->email = $validate['email'];
                $new_user->password = bcrypt($validate['password']);
                $new_user->phone = $validate['phone'];
                $new_user->address = $validate['address'];
                $new_user->avatar = $validate['avatar'];
                $new_user->id_country = $validate['id_country'];
                $new_user->level = 0;
                $new_user->save();

            $id_user = $new_user->id;
            $email = $new_user->email;
            $phone = $new_user->phone;
            $name = $new_user->name; 

            if(!is_dir(public_path('frontend/avatar/'.$new_user->id)))
            {
                mkdir(public_path('frontend/avatar/'.$new_user->id));
            }

            if($request->hasFile('avatar'))
            {
                $request->file('avatar')->move(public_path('/frontend/avatar/'.$new_user->id), $request->file('avatar')->getClientOriginalName());
            }
        }

        $rows = "";
        if(session()->has('cart'))
        {
            if(!empty(session()->get('cart')))
            {
                $total_qty = 0;
                $total_final = 0;
                foreach(session()->get('cart') as $key => $value)
                {
                    $total_qty += $value['qty'];
                    $price = str_replace(',', '', $value['price']);
                    $total = $price * $value['qty'];
                    $total_final += $value['qty'] * $price;
                    $rows .=
                                '<tr>'.
							        '<td>'.
								        '<a href=""><img style="width:110px; height:110px" src="'.$value['image'].'" alt=""></a>'.
							        '</td>'.
							        '<td>'.
								        '<h4><a>'.$value['name'].'</a></h4>'.
								        '<p>Web ID: '.$key.'</p>'.
							        '</td>'.
							        '<td class="cart_price">'.
								        '<p>'.$value['price'].' VNĐ</p>'.
							        '</td>'.
							        '<td>'.
								        '<div>'.
									        '<input value="'.$value['qty'].'">'.
								        '</div>'.
							        '</td>'.
							        '<td>'.
								        '<p>'.$total.' VNĐ</p>'.
							        '</td>'.
						        '</tr>';
                }
            }
        }
        $table = '<table>
				    <thead>
						<tr>
							<td>Hình ảnh</td>
			                <td></td>
				            <td>Giá</td>
							<td>Số lượng</td>
						    <td>Tổng tiền</td>
					    </tr>
				    </thead>
					<tbody>'.
                        $rows.
                        '<tr>'.
							'<td colspan="4">&nbsp;</td>'.
							'<td colspan="2">'.
								'<table>'.
									'<tr>'.
										'<td>Số lượng</td>'.
										'<td>'.$total_qty.'</td>'.
									'</tr>'.
									'<tr>'.
										'<td>Thuế</td>'.
										'<td>Không</td>'.
									'</tr>'.
									'<tr>'.
										'<td>Phí vận chuyển</td>'.
										'<td>Miễn phí</td>'.										
									'</tr>'.
									'<tr>'.
										'<td>Giá trị đơn hàng</td>'.
										'<td><span>'.$total_final.' VNĐ</span></td>'.
									'</tr>'.
								'</table>'.
							'</td>'.
						'</tr>'.
					'</tbody>'.
				'</table>';
        
        $data = [
            'subject' => 'Đặt hàng thành công',
            'body' => $table,
        ];

        try
        {
            // gửi mail
            $to_email = $email;
            Mail::to($to_email)->send(new CheckOutMail($data));

            // lưu vào db
            $new_history = new History();
                $new_history->id_user = $id_user;
                $new_history->email = $email;
                $new_history->phone = $phone;
                $new_history->name = $name;
                $new_history->price = $total_final;
                $new_history->save();
            // xóa ss
            session()->forget('cart');

            return response()->json(['Đặt hàng thành công. Vui lòng kiểm tra email của bạn']);
        }
        catch(Exception $th)
        {
            return response()->json(['Có lỗi xảy ra. Vui lòng thử lại']);
        }
    }
}
