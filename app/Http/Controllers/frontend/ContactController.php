<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\frontend\User_opinion;
use App\Http\Requests\frontend\UserOpinionRequest;

class ContactController extends Controller
{
    //
    public function contact_form()
    {
        return view('frontend/contact/contact');
    }

    public function contact(UserOpinionRequest $request)
    {
        $data = $request->all();
        $data['id_user'] = Auth::id();
        if(User_opinion::create($data))
        {
            return redirect()->back()->with('success', __('Gửi thành công. Chúng tôi xin chân thành cảm ơn những đóng góp quý giá của bạn'));
        }
        else
        {
            return redirect()->back()->withErrors('Có lỗi xảy ra. Vui lòng thử lại');
        }
    }
}
