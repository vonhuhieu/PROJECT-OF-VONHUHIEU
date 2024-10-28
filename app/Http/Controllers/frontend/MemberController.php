<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\frontend\MemberRegisterRequest;
use App\Models\admin\Country;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Http\Requests\frontend\MemberLoginRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\frontend\Password_token;
use App\Http\Requests\frontend\MemberForgetPasswordRequest;
use Mail;
use App\Mail\ResetPasswordMail;
use App\Http\Requests\frontend\MemberResetPasswordRequest;

class MemberController extends Controller
{
    //
    public function member_register_form()
    {
        $countries = Country::all();
        return view('frontend/member_register/member_register', compact('countries'));
    }

    public function member_register(MemberRegisterRequest $request)
    {
        if($request->password != $request->password_confirm)
        {
            return redirect()->back()->withErrors('Mật khẩu nhập lại không khớp');
        }
        else
        {
            $new_user = new User();
                $new_user->name = $request->name;
                $new_user->email = $request->email;
                $new_user->password = bcrypt($request->password);
                $new_user->phone = $request->phone;
                $new_user->address = $request->address;
                $new_user->avatar = $request->hasFile('avatar') ? $request->file('avatar')->getClientOriginalName() : null;
                $new_user->id_country = $request->id_country;
                $new_user->level = 0;
                $new_user->save();

            if(!is_dir(public_path('/frontend/avatar/'.$new_user->id)))
            {
                mkdir(public_path('/frontend/avatar/'.$new_user->id));
            }

            if($request->hasFile('avatar'))
            {
                $request->file('avatar')->move(public_path('/frontend/avatar/'.$new_user->id), $new_user->avatar);
            }

            return redirect('/frontend/member_login')->with('success', __('Đăng ký thành công. Vui lòng đăng nhập để tiếp tục'));
        }
    }

    public function member_login_form()
    {
        return view('frontend/member_login/member_login');
    }

    public function member_login(MemberLoginRequest $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0,
        ];

        $remember = false;
        if($request->remember_me)
        {
            $remember = true;
        }

        if(Auth::attempt($login, $remember))
        {
            return redirect('/frontend/index');
        }
        else
        {
            return redirect()->back()->withErrors('Đăng nhập thất bại');
        }
    }
    
    public function member_forget_password_form()
    {
        return view('/frontend/member_forget_password/member_forget_password');
    }

    public function member_forget_password(MemberForgetPasswordRequest $request)
    {
        $id_user = User::where('email', $request->email)->first()->id;
        $email = $request->email;
        session()->put('id_user_reset_password', $id_user);

        $token_Record = Password_token::where('id_user', $id_user)->first();

        if($token_Record)
        {
            $token_Record->update([
                'id_user' => $id_user,
                'email' => $email,
                'token' => Str::random(60),
                'expire_at' => now()->addminutes(5),
            ]);
        }
        else
        {
            $new_token = new Password_token();
                $new_token->id_user = $id_user;
                $new_token->email = $request->email;
                $new_token->token = Str::random(60);
                $new_token->expire_at = now()->addMinutes(5);
                $new_token->save();
        }

        $token = ($token_Record) ? $token_Record->token : $new_token->token;

        $link = '<a href="' . url('/frontend/member_reset_password/'.$token) . '">Click vào link này để tạo mật khẩu mới</a>';
        $data = [
            'subject' => 'Tạo mật khẩu mới',
            'body' => $link,
        ];

        try
        {
            Mail::to($email)->send(new ResetPasswordMail($data));
            return response()->json(['Vui lòng kiểm tra email của bạn']);
        }
        catch(Exception $th)
        {
            return response()->json(['Có lỗi xảy ra. Vui lòng thử lại']);
        }
    }

    public function member_reset_password_form($token)
    {
        return view('frontend/member_forget_password/member_reset_password', compact('token'));
    }

    public function member_reset_password(MemberResetPasswordRequest $request, $token)
    {
        $id_user = session()->has('id_user_reset_password') ? session()->get('id_user_reset_password') : "";
        $token_Record = Password_token::where('id_user', $id_user)->first();
        if($token_Record->token != $request->token || now()->isAfter($token_Record->expire_at))
        {
            return redirect('frontend/member_forget_password')->withErrors('Link không tồn tại hoặc đã hết hạn');
        }
        else
        {
            User::find($id_user)->update([
                'password' => bcrypt($request->password),
            ]);
            session()->forget('id_user_reset_password');
            return redirect('/frontend/member_login')->with('success', __('Tạo mới mật khẩu thành công. Vui lòng đăng nhập lại để tiếp tục'));
        }
    }

    public function member_logout()
    {
        Auth::logout();
        return redirect('/frontend/member_login');
    }
}
