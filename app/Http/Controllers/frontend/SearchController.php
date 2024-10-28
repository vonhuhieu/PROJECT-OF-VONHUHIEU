<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\frontend\Product;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Models\frontend\Product_average;
use App\Models\frontend\Product_rate;

class SearchController extends Controller
{
    //
    public function search(Request $request)
    {
        $search_name = session()->has('search') ? session()->get('search') : "";
        session()->put('search', $request->name);
        return redirect('/frontend/search_result');
    }

    public function search_result()
    {
        $desc_average_products = Product_average::where('average','<>',null)->orderBy('average','desc')->orderBy('count_rate','desc')->limit(3)->get();
        $outstanding_products = [];
        foreach($desc_average_products as $key => $value)
        {
            $outstanding_products[] = $value->product;
        }
        $products = Product::where('name','LIKE','%'.session()->get('search').'%')->paginate(3);
        return view('frontend/search/search_result', compact('products', 'outstanding_products'));
    }

    public function search_advanced_form()
    {
        $categories = Category::where('level', '<>', 0)->get();
        $brands = Brand::all();
        return view('frontend/search/search_advanced', compact('categories', 'brands'));
    }

    public function search_advanced(Request $request)
    {
        $search = session()->has('search_advanced') ? session()->get('search_advanced') : [];
        $search = [
            'name' => $request->name ?? '',
            'price' => $request->price ?? '',
            'id_category' => $request->id_category ?? '',
            'id_brand' => $request->id_brand ?? '',
            'status' => $request->status ?? '',
        ];
        session()->put('search_advanced', $search);
        return redirect('/frontend/search_advanced_result');
    }

    public function search_advanced_result()
    {
        $desc_average_products = Product_average::where('average','<>',null)->orderBy('average','desc')->orderBy('count_rate','desc')->limit(3)->get();
        $outstanding_products = [];
        foreach($desc_average_products as $key => $value)
        {
            $outstanding_products[] = $value->product;
        }
        $categories = Category::where('level', '<>', 0)->get();
        $brands = Brand::all();

        $query = Product::query();

        $search = session()->has('search_advanced') ? session()->get('search_advanced') : [];

        if(!empty($search['name']))
        {
            $query->where('name', 'LIKE', '%'.$search['name'].'%');
        }
        
        if(!empty($search['price']))
        {
            $search['price'] = explode('-', $search['price']);
            $minPrice = (int)$search['price'][0];
            $maxPrice = (int)$search['price'][1];
            $query->whereBetween('price', [$minPrice, $maxPrice]);
        }

        if(!empty($search['id_category']))
        {
            $query->where('id_category', $search['id_category']);
        }

        if(!empty($search['id_brand']))
        {
            $query->where('id_brand', $search['id_brand']);
        }

        if(!empty($search['status']))
        {
            $query->where('status', $search['status']);
        }

        $products = $query->orderBy('created_at', 'desc')->paginate(3);
        return view('/frontend/search/search_advanced', compact('categories', 'brands', 'products', 'outstanding_products'));
    }

    public function price_range()
    {
        $data = explode(' : ', $_POST['price_range']);
        $data[0] = (int)$data[0];
        $data[1] = (int)$data[1];
        [$minPrice, $maxPrice] = [$data[0], $data[1]];
        $products = Product::whereBetween('price', [$minPrice, $maxPrice])->get();
        
        $data_price = [];
        foreach($products as $key => $value)
        {
            $images = json_decode($value->image, true);
            if($images != null)
            {
                $image = $images[0];
            }
            else
            {
                $image = "";
            }
            $data_price[] = [
                'image' => $image,
                'id_product' => $value->id,
                'id_user' => $value->id_user,
                'name' => $value->name,
                'price' => $value->price,
            ];
        }
        // return view('frontend/search/price_range');
        return response()->json(['data' => $data_price]);
    }
}
