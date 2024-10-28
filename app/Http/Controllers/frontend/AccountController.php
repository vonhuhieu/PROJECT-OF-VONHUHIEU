<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin\Country;
use App\Http\Requests\admin\ProfileUpdateRequest;
use App\Models\User;
use App\Models\admin\Blog;
use App\Models\frontend\Blog_comment;
use Illuminate\Support\Facades\Auth;
use App\Models\admin\Category;
use App\Models\admin\Brand;
use App\Http\Requests\frontend\ProductRequest;
use Intervention\Image\Laravel\Facades\Image;
use App\Models\frontend\Product;
use Illuminate\Support\Facades\File;
use App\Models\frontend\Product_review;

class AccountController extends Controller
{
    //
    public function account()
    {
        return view('frontend/account/account');
    }

    public function account_update_form()
    {
        $countries = Country::all();
        return view('frontend/account/account_update', compact('countries'));
    }

    public function account_update(ProfileUpdateRequest $request)
    {
        $user = User::findOrFail(Auth::id());
        $matkhaucu = $user->password;
        $avatarcu = $user->avatar;

        $data = $request->except(['password', 'password_confirm', 'avatar']);
        $data['level'] = 0;

        if($request->filled('password'))
        {
            if($request->password != $request->password_confirm)
            {
                return redirect()->back()->withErrors('Mật khẩu nhập lại không khớp');
            }
            else
            {
                $data['password'] = bcrypt($request->password);
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
                Blog_comment::where('id_user', Auth::id())->update([
                    'avatar' => $data['avatar'],
                    'name' => $data['name'],
                ]);
    
                Product_review::where('id_user', Auth::id())->update([
                    'avatar' => $data['avatar'],
                    'name' => $data['name'],
                ]);
            }
            else
            {
                Blog_comment::where('id_user', Auth::id())->update([
                    'avatar' => $avatarcu,
                    'name' => $data['name'],
                ]);
    
                Product_review::where('id_user', Auth::id())->update([
                    'avatar' => $avatarcu,
                    'name' => $data['name'],
                ]);
            }

            if($request->hasFile('avatar'))
            {
                if($avatarcu != null)
                {
                    if(file_exists(public_path('/frontend/avatar/'.Auth::id().'/'.$avatarcu)))
                    {
                        unlink(public_path('/frontend/avatar/'.Auth::id().'/'.$avatarcu));
                    }
                }
                $request->file('avatar')->move(public_path('/frontend/avatar/'.Auth::id()), $request->file('avatar')->getClientOriginalName());
            }
            return redirect()->back()->with('success', __('Cập nhật tài khoản thành công'));
        }
        else
        {
            return redirect()->back()->withErrors('Cập nhật thất bại');
        }
    }

    public function my_product()
    {
        $user = User::findOrFail(Auth::id());
        $products = $user->products;
        return view('/frontend/account/my_product', compact('products'));
    }

    public function add_product_form()
    {
        $categories = Category::where('level', '<>', 0)->get();
        $brands = Brand::all();
        return view('/frontend/account/add_product', compact('categories', 'brands'));
    }

    public function add_product_show_sale_input()
    {
        return response()->json([
            'status' => $_POST['status'],
        ]);
    }

    public function add_product(ProductRequest $request)
    {
        $data = $request->except(['sale', 'image']);
        $data['id_user'] = Auth::id();

        if($request->status == 0)
        {
            $data['sale'] = $request->sale;
        }
        else
        {
            $data['sale'] = null;
        }

        $data_image = [];
        if($request->hasFile('image'))
        {
            if(count($request->file('image')) > 3)
            {
                return redirect()->back()->withErrors('Chỉ cho phép upload tối đa 3 hình ảnh');
            }
            else
            {
                foreach($request->file('image') as $xx)
                {
                    $name = $xx->getClientOriginalName();
                    $data_image[] = $name;
                }
            }
        }
        $data['image'] = json_encode($data_image);

        $new_product = new Product();
            $new_product->id_user = $data['id_user'];
            $new_product->name = $data['name'];
            $new_product->price = $data['price'];
            $new_product->id_category = $data['id_category'];
            $new_product->id_brand = $data['id_brand'];
            $new_product->status = $data['status'];
            $new_product->sale = $data['sale'];
            $new_product->company = $data['company'];
            $new_product->detail = $data['detail'];
            $new_product->image = $data['image'];
            $new_product->save();
        
        if(!is_dir(public_path('/frontend/product/'.Auth::id())))
        {
            mkdir(public_path('/frontend/product/'.Auth::id()));
        }

        if(!is_dir(public_path('frontend/product/'.Auth::id().'/'.$new_product->id)))
        {
            mkdir(public_path('frontend/product/'.Auth::id().'/'.$new_product->id));
        }

        if($request->hasFile('image'))
        {
            if(count($request->file('image')) <= 3)
            {
                foreach($request->file('image') as $xx)
                {
                    $image = Image::read($xx);

                    $name = $xx->getClientOriginalName();
                    $name_2 = "hinh85_".$xx->getClientOriginalName();
                    $name_3 = "hinh329_".$xx->getClientOriginalName();

                    $path = public_path('frontend/product/'.Auth::id().'/'.$new_product->id.'/'.$name);
                    $path_2 = public_path('frontend/product/'.Auth::id().'/'.$new_product->id.'/'.$name_2);
                    $path_3 = public_path('frontend/product/'.Auth::id().'/'.$new_product->id.'/'.$name_3);

                    $image->save($path);
                    $image->resize(85,84)->save($path_2);
                    $image->resize(329,380)->save($path_3);
                }
            }
        }

        return redirect('/frontend/account/my_product')->with('success', __('Thêm sản phẩm thành công'));
    }

    public function update_product_form($id_product)
    {
        $categories = Category::where('level', '<>', 0)->get();
        $brands = Brand::all();
        $product = Product::findOrFail($id_product);
        return view('/frontend/account/update_product', compact('product', 'categories', 'brands'));
    }

    public function update_product(ProductRequest $request, $id_product)
    {
        $product = Product::findOrFail($id_product);
        $hinhcu = json_decode($product->image);

        $data = $request->except(['sale', 'image']);
        $data['id_user'] = $product->id_user;
        if($request->status == 0)
        {
            $data['sale'] = $request->sale;
        }
        else
        {
            $data['sale'] = null;
        }

        $hinhxoa = $request->input('hinhxoa', []);

        $hinhconlai = [];

        // Xử lí hình xóa
        foreach($hinhcu as $key => $value)
        {
            if(!in_array($value, $hinhxoa))
            {
                $hinhconlai[] = $value;
            }
        }

        // Xử lí nếu cập nhật hình mới
        if($request->hasFile('image'))
        {
            if(count($request->file('image')) + count($hinhcu) - count($hinhxoa) > 3)
            {
                return redirect()->back()->withErrors('Chỉ cho phép upload tối đa 3 hình ảnh');
            }
            else
            {
                foreach($request->file('image') as $xx)
                {
                    $image = Image::read($xx);

                    $name = $xx->getClientOriginalName();
                    $name_2 = "hinh85_".$xx->getClientOriginalName();
                    $name_3 = "hinh329_".$xx->getClientOriginalName();

                    $path = public_path('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.$name);
                    $path_2 = public_path('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.$name_2);
                    $path_3 = public_path('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.$name_3);

                    $image->save($path);
                    $image->resize(85,84)->save($path_2);
                    $image->resize(329,380)->save($path_3);

                    $hinhconlai[] = $name;
                }
            }
        }

        $data['image'] = json_encode($hinhconlai);

        if($product->update($data))
        {
            if(!empty($hinhxoa))
            {
                foreach($hinhxoa as $key => $value)
                {
                    if(file_exists(public_path('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.$value)))
                    {
                        unlink(public_path('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.$value));
                        unlink(public_path('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.'hinh85_'.$value));
                        unlink(public_path('/frontend/product/'.$product->id_user.'/'.$product->id.'/'.'hinh329_'.$value));
                    }
                }
            }
            return redirect('/frontend/account/my_product')->with('success', __('Cập nhật sản phẩm thành công'));
        }
        else
        {
            return redirect('/frontend/account/my_product')->withErrors('Cập nhật sản phẩm thất bại');
        }
    }

    public function delete_product($id_product)
    {
        $product = Product::findOrFail($id_product);
        $path = public_path('/frontend/product/'.$product->id_user.'/'.$product->id);
        if($product->delete())
        {
            if(File::exists($path))
            {
                File::deleteDirectory($path);
            }
            return redirect('/frontend/account/my_product')->with('success', __('Xóa sản phẩm thành công'));
        }
        else
        {
            return redirect('/frontend/account/my_product')->withErrors('Xóa sản phẩm thất bại');
        }
    }
}
