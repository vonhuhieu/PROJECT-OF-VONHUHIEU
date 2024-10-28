<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\admin\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\Country;

class ProfileController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function profile()
    {
        $countries = Country::all();
        return view('admin/profile/profile', compact('countries'));
    }

    public function profile_update(ProfileUpdateRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        $matkhaucu = $user->password;
        $hinhcu = $user->avatar ?? '';

        $data = $request->except(['password','avatar', 'password_confirm']);

        if($request->filled('password'))
        {
            if($request->password == $request->password_confirm)
            {
                $data['password'] = bcrypt($request->password);
            }
            else
            {
                return redirect()->back()->withErrors('Mật khẩu nhập lại không khớp');
            }
        }

        else
        {
            $data['password'] = $matkhaucu;
        }

        if($request->hasFile('avatar'))
        {
            $data['avatar'] = $request->file('avatar')->getClientOriginalName();
        }

        if($user->update($data))
        {
            if($request->hasFile('avatar'))
            {
                if($hinhcu != '')
                {
                    if(file_exists(public_path('/admin/avatar/'.$hinhcu)))
                    {
                        unlink(public_path('/admin/avatar/'.$hinhcu));
                    }
                }
                $request->file('avatar')->move(public_path('/admin/avatar'), $request->file('avatar')->getClientOriginalName());
            }

            return redirect()->back()->with('success', __('Cập nhật tài khoản thành công'));
        }
        else
        {
            return redirect()->back()->withErrors('Cập nhật tài khoản thất bại');
        }
    }

    public function admin_logout()
    {
        Auth::logout();
        return redirect('/login');
    }
}
