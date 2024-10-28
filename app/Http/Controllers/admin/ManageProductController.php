<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\frontend\Product;
use Illuminate\Support\Facades\File;
use Mail;
use App\Mail\DeleteProductMail;

class ManageProductController extends Controller
{
    //
    public function manage_product_list()
    {
        $products = Product::all();
        return view('admin/manage_product/manage_product_list', compact('products'));
    }

    public function delete_product($id_product)
    {
        $product = Product::findOrFail($id_product);
        $id_user = $product->id_user;
        $email = $product->user->email;
        $name_product = $product->name;

        $data = [
            'subject' => 'Thông báo về việc xóa sản phẩm',
            'body' => 'Chúng tôi rất tiếc vì đã xóa sản phẩm '.$name_product.' của bạn vì không đáp ứng đủ tiêu chuẩn bán hàng. Nếu có thắc mắc mong bạn vui lòng liên hệ lại với chúng tôi để biết thêm thông tin chi tiết',
        ];
        if($product->delete())
        {
            if(is_dir(public_path('frontend/product/'.$id_user.'/'.$id_product)))
            {
                File::deleteDirectory(public_path('frontend/product/'.$id_user.'/'.$id_product));
            }

            try
            {
                Mail::to($email)->send(new DeleteProductMail($data));
                return redirect('admin/manage_product_list')->with('success', __('Xóa thành công'));
            }
            catch(Exception $th)
            {
                return redirect('admin/manage_product_list')->withErrors('Xóa thất bại');
            }
        }
    }
}
