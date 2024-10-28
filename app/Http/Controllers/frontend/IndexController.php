<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\frontend\Product;
use App\Models\admin\Brand;
use App\Models\admin\Category;
use App\Models\frontend\Product_average;
use App\Models\frontend\Product_rate;

class IndexController extends Controller
{
    //
    public function index()
    {
        $categories = Category::where('level', 0)->get();
        $products = Product::orderBy('created_at', 'desc')->limit(6)->get();
        
        $desc_average_product = Product_average::where('average', '<>', null)->orderBy('average', 'desc')->orderBy('count_rate', 'desc')->limit(3)->get();
        $outstanding_products = [];
        foreach($desc_average_product as $key => $value)
        {
            $outstanding_products[] = $value->product;
        }

        return view('frontend/index/index', compact('products', 'categories', 'outstanding_products'));
    }

    public function category($id_category)
    {
        $products = Product::where('id_category', $id_category)->orderBy('created_at', 'desc')->limit(6)->get();

        $desc_average_product = Product_average::where('average', '<>', null)->orderBy('average', 'desc')->orderBy('count_rate', 'desc')->limit(3)->get();
        $outstanding_products = [];
        foreach($desc_average_product as $key => $value)
        {
            $outstanding_products[] = $value->product;
        }

        return view('frontend/index/category', compact('products', 'outstanding_products'));
    }

    public function brand($id_brand)
    {
        $products = Product::where('id_brand', $id_brand)->orderBy('created_at', 'desc')->limit(6)->get();

        $desc_average_product = Product_average::where('average', '<>', null)->orderBy('average', 'desc')->orderBy('count_rate', 'desc')->limit(3)->get();
        $outstanding_products = [];
        foreach($desc_average_product as $key => $value)
        {
            $outstanding_products[] = $value->product;
        }

        return view('frontend/index/brand', compact('products', 'outstanding_products'));
    }
}
