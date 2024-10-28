<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\CategoryRequest;
use App\Models\admin\Category;

class CategoryController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function category_list()
    {
        $categories = Category::where('level', 0)->get();
        return view('admin/category/category_list', compact('categories'));
    }

    public function category_add_form()
    {
        return view('admin/category/category_add');
    }

    public function category_add(CategoryRequest $request)
    {
        $data = $request->all();
        if(Category::create($data))
        {
            return redirect('/admin/category_list')->with('success', __('Thêm thành công'));
        }
        else
        {
            return redirect('/admin/category_list')->withErrors('Thêm thất bại');
        }
    }

    public function categoryCon_list($id_category)
    {
        $categories = Category::where('level', $id_category)->get();
        return view('admin/category/categoryCon_list', compact('id_category', 'categories'));
    }

    public function categoryCon_add_form($id_category)
    {
        return view('admin/category/categoryCon_add');
    }

    public function categoryCon_add(CategoryRequest $request, $id_category)
    {
        $data = $request->all();
        $data['level'] = $id_category;
        
        if(Category::create($data))
        {
            return redirect('/admin/category_list/'.$id_category)->with('success', __('Thêm thành công'));
        }
        else
        {
            return redirect('/admin/category_list/'.$id_category)->withErrors('Thêm thất bại');
        }
    }

    public function categoryCon_delete($id_categoryCon)
    {
        $level = Category::where('id', $id_categoryCon)->first()->level;
        if(Category::where('id', $id_categoryCon)->delete())
        {
            return redirect('/admin/category_list/'.$level)->with('success', __('Xóa thành công'));
        }
        else
        {
            return redirect('/admin/category_list/'.$level)->withErrors('Xóa thất bại');
        }
    }

    public function category_delete($id_category)
    {
        if(Category::where('id', $id_category)->delete())
        {
            Category::where('level', $id_category)->delete();
            return redirect('/admin/category_list')->with('success', __('Xóa thành công'));
        }
        else
        {
            return redirect('/admin/category_list')->withErrors('Xóa thất bại');
        }
    }
}
