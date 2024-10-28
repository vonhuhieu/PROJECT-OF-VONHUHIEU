<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CartController extends Controller
{
    //
    public function index_add_to_cart()
    {
        $mangCon = [];
        $mangCha = session()->has('cart') ? session()->get('cart') : [];
        $mangCon = [
            'image' => $_POST['image'],
            'id_product' => $_POST['id_product'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'qty' => 1,
        ];
        if(!array_key_exists($_POST['id_product'], $mangCha))
        {
            $mangCha[$_POST['id_product']] = $mangCon;
        }
        else
        {
            $mangCha[$_POST['id_product']]['qty'] += 1;
        }
        session()->put('cart', $mangCha);
        
        $qty = 0;
        foreach(session()->get('cart') as $key => $value)
        {
            $qty += $value['qty'];
        }
        return response()->json([
            'quantity' => $qty,
        ]);
        // return view('frontend/index/index_add_to_cart');
    }

    public function product_detail_add_to_cart()
    {
        $mangCon = [];
        $mangCha = session()->has('cart') ? session()->get('cart') : [];
        $mangCon = [
            'image' => $_POST['image'],
            'id_product' => $_POST['id_product'],
            'name' => $_POST['name'],
            'price' => $_POST['price'],
            'qty' => $_POST['qty'],
        ];
        if(!array_key_exists($_POST['id_product'], $mangCha))
        {
            $mangCha[$_POST['id_product']] = $mangCon;
        }
        else
        {
            $mangCha[$_POST['id_product']]['qty'] += $_POST['qty'];
        }
        session()->put('cart', $mangCha);
        
        $qty = 0;
        foreach(session()->get('cart') as $key => $value)
        {
            $qty += $value['qty'];
        }
        return response()->json([
            'quantity' => $qty,
        ]);
        // return view('frontend/product/product_detail_add_to_cart');
    }

    public function cart()
    {
        return view('frontend/cart/cart');
    }

    public function cart_quantity_up()
    {
        $mangCha = session()->has('cart') ? session()->get('cart') : [];
        $mangCha[$_POST['id_product']]['qty'] += 1;

        session()->put('cart', $mangCha);

        $total_qty = 0;
        $total_final = 0;
        if(!empty(session()->get('cart')))
        {
            foreach(session()->get('cart') as $key => $value)
            {
                $total_qty += $value['qty'];
                $price = str_replace(',', '', $value['price']);
                $total_final += $value['qty'] * $price;
            }
        }

        return response()->json([
            'qty' => session()->get('cart')[$_POST['id_product']]['qty'],
            'price' => str_replace(',','',session()->get('cart')[$_POST['id_product']]['price']), 
            'id_product' => $_POST['id_product'],
            'total_qty' => $total_qty,
            'total_final' => $total_final
        ]);
        // return view('frontend/cart/cart_quantity_up');
    }

    public function cart_quantity_down()
    {
        $mangCha = session()->has('cart') ? session()->get('cart') : [];
        
        if($mangCha[$_POST['id_product']]['qty'] <= 1)
        {
            unset($mangCha[$_POST['id_product']]);
        }
        else
        {
            $mangCha[$_POST['id_product']]['qty'] -= 1;
        }

        session()->put('cart', $mangCha);

        $total_qty = 0;
        $total_final = 0;
        if(!empty(session()->get('cart')))
        {
            foreach(session()->get('cart') as $key => $value)
            {
                $total_qty += $value['qty'];
                $price = str_replace(',', '', $value['price']);
                $total_final += $value['qty'] * $price;
            }
        }

        return response()->json([
            'qty' => ($_POST['qty'] > 1) ? session()->get('cart')[$_POST['id_product']]['qty'] : "",
            'price' => ($_POST['qty'] > 1) ? str_replace(',','',session()->get('cart')[$_POST['id_product']]['price']) : "",
            'id_product' => $_POST['id_product'],
            'total_qty' => $total_qty,
            'total_final' => $total_final
        ]);
        // return view('frontend/cart/cart_quantity_down');
    }

    public function cart_quantity_delete()
    {
        $mangCha = session()->has('cart') ? session()->get('cart') : [];
        unset($mangCha[$_POST['id_product']]);

        session()->put('cart', $mangCha);
        
        $total_qty = 0;
        $total_final = 0;
        if(!empty(session()->get('cart')))
        {
            foreach(session()->get('cart') as $key => $value)
            {
                $total_qty += $value['qty'];
                $price = str_replace(',', '', $value['price']);
                $total_final += $value['qty'] * $price;
            }
        }

        return response()->json([
            'id_product' => $_POST['id_product'],
            'total_qty' => $total_qty,
            'total_final' => $total_final
        ]);
        // return view('frontend/cart/cart_quantity_delete');
    }
}
