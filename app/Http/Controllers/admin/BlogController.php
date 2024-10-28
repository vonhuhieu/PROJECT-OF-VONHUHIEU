<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\admin\BlogAddRequest;
use App\Models\admin\Blog;
use App\Http\Requests\admin\BlogUpdateRequest;
use Illuminate\Support\Facades\File;

class BlogController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function blog_list()
    {
        $blogs = Blog::all();
        return view('admin/blog/blog_list', compact('blogs'));
    }

    public function blog_add_form()
    {
        return view('admin/blog/blog_add');
    }

    public function blog_add(BlogAddRequest $request)
    {
        $new_blog = new Blog();
            $new_blog->title = $request->title;
            $new_blog->image = $request->hasFile('image') ? $request->file('image')->getClientOriginalName() : null;
            $new_blog->content = $request->content;
            $new_blog->save();

        if(!is_dir(public_path('/admin/blog/'.$new_blog->id)))
        {
            mkdir(public_path('/admin/blog/'.$new_blog->id));
        }

        if($request->hasFile('image'))
        {
            $request->file('image')->move(public_path('/admin/blog/'.$new_blog->id), $new_blog->image);
        }
        return redirect('/admin/blog_list')->with('success', __('Thêm thành công'));
    }

    public function blog_update_form($id_blog)
    {
        $blog = Blog::where('id', $id_blog)->first();
        return view('admin/blog/blog_update', compact('blog'));
    }

    public function blog_update(BlogUpdateRequest $request, $id_blog)
    {
        $blog = Blog::findOrFail($id_blog);
        $hinhcu = $blog->image ?? '';

        $data = $request->except(['image']);

        if($request->hasFile('image'))
        {
            $data['image'] = $request->file('image')->getClientOriginalName();
        }

        if($blog->update($data))
        {
            if($request->hasFile('image'))
            {
                if($hinhcu != '')
                {
                    if(file_exists(public_path('admin/blog/'.$id_blog.'/'.$hinhcu)))
                    {
                        unlink(public_path('admin/blog/'.$id_blog.'/'.$hinhcu));
                    }
                }
                $request->file('image')->move(public_path('admin/blog/'.$id_blog), $request->file('image')->getClientOriginalName());
            }
            return redirect('admin/blog_list')->with('success', __('Cập nhật thành công'));
        }
        else
        {
            return redirect('admin/blog_list')->withErrors('Có lỗi xảy ra. Vui lòng thử lại');
        }
    }

    public function blog_delete($id_blog)
    {
        $blog = Blog::findOrFail($id_blog);
        $hinhxoa = $blog->image ?? '';
        
        if($blog->delete())
        {
            if($hinhxoa != '')
            {
                if(file_exists(public_path('admin/blog/'.$id_blog.'/'.$hinhxoa)))
                {
                    unlink(public_path('admin/blog/'.$id_blog.'/'.$hinhxoa));
                }
            }

            if(File::exists(public_path('admin/blog/'.$id_blog)))
            {
                File::deleteDirectory(public_path('admin/blog/'.$id_blog));
            }
            return redirect('/admin/blog_list')->with('success', __('Xóa thành công'));
        }
        else
        {
            return redirect('admin/blog_list')->withErrors('Có lỗi xảy ra. Vui lòng thử lại');
        }
    }
}
