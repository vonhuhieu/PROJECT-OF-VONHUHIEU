<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\frontend\Product;
use App\Models\frontend\Product_rate;
use App\Models\frontend\Product_review;
use App\Models\frontend\Product_average;

class ProductController extends Controller
{
    //
    public function product_detail($id_product)
    {
        $product = Product::findOrFail($id_product);

        // lấy đánh giá
        $product_rate = $product->product_rates;
        $count_rate = count($product_rate);

        if($count_rate < 1)
        {
            $avg = "Chưa có lượt đánh giá";
        }
        else
        {
            $tong = 0;
            foreach($product_rate as $key => $value)
            {
                $tong += $value->rate;
            }
            $avg = round($tong / $count_rate);
        }

        // lấy review
        $reviewCha = [];
        $product_review = $product->product_reviews;
        $count_review = count($product_review);
        foreach($product_review as $key => $value)
        {
            if($value->level == 0)
            {
                $reviewCha[] = $value;
            }
        }

        // sản phẩm nổi bật
        $desc_average_products = Product_average::where('average','<>',null)->orderBy('average','desc')->orderBy('count_rate','desc')->limit(3)->get();
        $outstanding_products = [];
        foreach($desc_average_products as $key => $value)
        {
            $outstanding_products[] = $value->product;
        }
        return view('frontend/product/product_detail', compact('product', 'avg', 'count_rate', 'reviewCha', 'count_review', 'outstanding_products'));
    }

    public function product_detail_rate()
    {
        $new_rate = new Product_rate();
            $new_rate->id_product = $_POST['id_product'];
            $new_rate->id_user = $_POST['id_user'];
            $new_rate->rate = $_POST['rate'];
            $new_rate->save();

        $_POST['count_rate'] += 1;

        foreach(Product::all() as $key => $value)
        {
            $rates = Product_rate::where('id_product', $value->id)->get();
            $count_rate = count($rates);
            if($count_rate > 0)
            {
                $tong = $rates->sum('rate');
                $average = round($tong / $count_rate);
            }
            else
            {
                $average = null;
            }

            $product_average = Product_average::where('id_product', $value->id)->first();
            if($product_average)
            {
                $product_average->update([
                    'id_product' => $value->id,
                    'count_rate' => $count_rate,
                    'average' => $average,
                ]);
            }
            else
            {
                $product_average = new Product_average();
                    $product_average->id_product = $value->id;
                    $product_average->count_rate = $count_rate;
                    $product_average->average = $average;
                    $product_average->save();
            }
        }
        return response()->json([
            'id_product' => $new_rate->id_product,
            'id_user' => $new_rate->id_user,
            'rate' => $new_rate->rate,
            'count_rate' => $_POST['count_rate'],
        ]);
        // return view('frontend/product/product_detail_rate');
    }

    public function product_detail_review()
    {
        $new_review = new Product_review();
            $new_review->id_product = $_POST['id_product'];
            $new_review->id_user = $_POST['id_user'];
            $new_review->avatar = (!empty($_POST['avatar'])) ? $_POST['avatar'] : null;
            $new_review->name = $_POST['name'];
            $new_review->review = $_POST['review'];
            $new_review->level = $_POST['level'];
            $new_review->save();
        
        $_POST['count_review'] += 1;

        return response()->json([
            'id_review' => $new_review->id,
            'id_product' => $new_review->id_product,
            'id_user' => $new_review->id_user,
            'avatar' => $new_review->avatar,
            'name' => $new_review->name,
            'review' => $new_review->review,
            'level' => $new_review->level,
            'time' => $new_review->updated_at->format('H:i'),
            'day' => $new_review->updated_at->format('M d,y'),
            'count_review' => $_POST['count_review']
        ]);
        // return view('frontend/product/product_detail_review');
    }

    public function product_detail_replay()
    {
        $new_replay = new Product_review();
            $new_replay->id_product = $_POST['id_product'];
            $new_replay->id_user = $_POST['id_user'];
            $new_replay->avatar = (!empty($_POST['avatar'])) ? $_POST['avatar'] : null;
            $new_replay->name = $_POST['name'];
            $new_replay->review = $_POST['replay'];
            $new_replay->level = $_POST['level'];
            $new_replay->save();

        $_POST['count_review'] += 1;

        return response()->json([
            'id_replay' => $new_replay->id,
            'id_product' => $new_replay->id_product,
            'id_user' => $new_replay->id_user,
            'avatar' => $new_replay->avatar,
            'name' => $new_replay->name,
            'replay' => $new_replay->review,
            'level' => $new_replay->level,
            'time' => $new_replay->updated_at->format('H:i'),
            'day' => $new_replay->updated_at->format('M d,y'),
            'count_review' => $_POST['count_review'],
        ]);
        // return view('frontend/product/product_detail_replay');
    }
}
