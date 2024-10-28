<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Blog;
use App\Models\frontend\Rate;
use App\Models\frontend\Blog_comment;

class BlogController extends Controller
{
    //
    public function blog_list()
    {
        $blogs = Blog::orderBy('updated_at', 'desc')->paginate(3);
        return view('frontend/blog/blog_list', compact('blogs'));
    }

    public function blog_detail($id_blog)
    {
        $blog = Blog::where('id', $id_blog)->first();
        $current_updated_at = $blog->updated_at;
        $id_current_blog = $blog->id; 

        $blogs = Blog::orderBy('updated_at', 'desc')->get();
        $max_updated_at = $min_updated_at = $current_updated_at;

        foreach($blogs as $key => $value)
        {
            if($value->updated_at > $max_updated_at)
            {
                $max_updated_at = $value->updated_at;
            }

            if($value->updated_at < $min_updated_at)
            {
                $min_updated_at = $value->updated_at;
            }
        }

        $id_max_updated_at = Blog::where('updated_at', $max_updated_at)->first()->id;
        $id_min_updated_at = Blog::where('updated_at', $min_updated_at)->first()->id;

        if($current_updated_at >= $max_updated_at)
        {
            $id_previous = $id_max_updated_at;
        }
        else
        {
            $id_previous = Blog::where('updated_at', '>', $current_updated_at)->orderBy('updated_at', 'asc')->first()->id;
        }

        if($current_updated_at <= $min_updated_at)
        {
            $id_next = $id_min_updated_at;
        }
        else
        {
            $id_next = Blog::where('updated_at', '<', $current_updated_at)->orderBy('updated_at', 'desc')->first()->id;
        }

        // điểm trung bình
        $count_rate = count(Blog::findOrFail($id_blog)->rates);
        if($count_rate == 0)
        {
            $avg = "Chưa có lượt đánh giá";
        }
        else
        {
            $tong = 0;
            foreach(Blog::findOrFail($id_blog)->rates as $key => $value)
            {
                $tong += $value->rate;
            }
            $avg = round($tong / $count_rate);
        }

        // Bình luận
            $count_cmt = count(Blog::findOrFail($id_blog)->comments_desc);
            $cmtCha = [];
            foreach(Blog::findOrFail($id_blog)->comments_desc as $key => $value)
            {
                if($value->level == 0)
                {
                    $cmtCha[] = $value;
                }
            }
        return view('frontend/blog/blog_detail', compact('blog', 'id_max_updated_at', 'id_min_updated_at', 'id_previous', 'id_next', 'count_rate', 'avg', 'count_cmt', 'cmtCha'));
    }

    public function blog_detail_rate()
    {
        $new_rate = new Rate();
            $new_rate->id_blog = $_POST['id_blog'];
            $new_rate->id_user = $_POST['id_user'];
            $new_rate->rate = $_POST['rate'];
            $new_rate->save();

        $_POST['count_rate'] += 1;
        return response()->json([
            'id_blog' => $new_rate->id_blog,
            'id_user' => $new_rate->id_user,
            'rate' => $new_rate->rate,
            'count_rate' => $_POST['count_rate'],
        ]);
        // return view('frontend/blog/blog_detail_rate');
    }

    public function blog_detail_cmt()
    {
        $new_cmt = new Blog_comment();
            $new_cmt->id_blog = $_POST['id_blog'];
            $new_cmt->id_user = $_POST['id_user'];
            $new_cmt->avatar = (!empty($_POST['avatar'])) ? $_POST['avatar'] : null;
            $new_cmt->name = $_POST['name'];
            $new_cmt->cmt = $_POST['cmt'];
            $new_cmt->save();

        $_POST['count_cmt'] += 1;
        return response()->json([
            'id_cmtCha' => $new_cmt->id,
            'id_blog' => $new_cmt->id_blog,
            'id_user' => $new_cmt->id_user,
            'avatar' => $new_cmt->avatar,
            'name' => $new_cmt->name,
            'cmt' => $new_cmt->cmt,
            'time' => $new_cmt->updated_at->format('H:i'),
            'day' => $new_cmt->updated_at->format('M d,y'),
            'count_cmt' => $_POST['count_cmt'],
        ]);
        // return view('frontend/blog/blog_detail_cmt');
    }

    public function blog_detail_replay()
    {
        $new_replay = new Blog_comment();
            $new_replay->id_blog = $_POST['id_blog'];
            $new_replay->id_user = $_POST['id_user'];
            $new_replay->avatar = (!empty($_POST['avatar'])) ? $_POST['avatar'] : null;
            $new_replay->name = $_POST['name'];
            $new_replay->cmt = $_POST['cmt'];
            $new_replay->level = $_POST['level'];
            $new_replay->save();

        $_POST['count_cmt'] += 1;

        return response()->json([
            'id_user' => $new_replay->id_user,
            'avatar' => $new_replay->avatar,
            'name' => $new_replay->name,
            'cmt' => $new_replay->cmt,
            'level' => $new_replay->level,
            'count_cmt' => $_POST['count_cmt'],
            'time' => $new_replay->updated_at->format('H:i'),
            'day' => $new_replay->updated_at->format('M d,y'),
        ]);
        return view('frontend/blog/blog_detail_replay');
    }
}
