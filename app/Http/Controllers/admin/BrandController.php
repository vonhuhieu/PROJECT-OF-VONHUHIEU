<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Brand;
use App\Http\Requests\admin\BrandRequest;

class BrandController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function brand_list()
    {
        $brands = Brand::all();
        return view('admin/brand/brand_list', compact('brands'));
    }

    public function brand_add_form()
    {
        return view('/admin/brand/brand_add');
    }

    public function brand_add(BrandRequest $request)
    {
        $data = $request->all();
        if(Brand::create($data))
        {
            return redirect('/admin/brand_list')->with('success', __('Thêm thành công'));
        }
        else
        {
            return redirect('admin/brand_list')->withErrors('Thêm thất bại');
        }
    }

    public function brand_delete($id_brand)
    {
        if(Brand::where('id', $id_brand)->delete())
        {
            return redirect('/admin/brand_list')->with('success', __('Xóa thành công'));
        }
        else
        {
            return redirect('admin/brand_list')->withErrors('Xóa thất bại');
        }
    }
}
