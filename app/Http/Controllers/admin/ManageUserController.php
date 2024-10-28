<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\frontend\Product;
use Illuminate\Support\Facades\File;

class ManageUserController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function manage_user_list()
    {
        $users = User::where('level',0)->get();
        return view('admin/manage_user/manage_user_list', compact('users'));
    }

    public function delete_user($id_user)
    {
        $user = User::findOrFail($id_user);
        $avatar = $user->avatar;

        if($user->delete())
        {
            if(is_dir(public_path('frontend/avatar/'.$id_user)))
            {
                File::deleteDirectory(public_path('frontend/avatar/'.$id_user));
            }

            if(is_dir(public_path('frontend/product/'.$id_user)))
            {
                File::deleteDirectory(public_path('frontend/product/'.$id_user));
            }
            return redirect('/admin/manage_user_list')->with('success', __('Xóa thành công'));
        }
        else
        {
            return redirect('/admin/manage_user_list')->withErrors('Có lỗi xảy ra. Vui lòng thử lại');
        }
    }
}
