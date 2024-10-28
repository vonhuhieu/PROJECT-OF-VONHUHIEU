<?php

namespace App\Http\Requests\frontend;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|max:200',
            'price' => 'required',
            'id_category' => 'required',
            'id_brand' => 'required',
            'status' => 'required',
            'sale' => 'nullable|numeric|gt:0|max:100',
            'company' => 'required|max:200',
            'detail' => 'required',
            'image' => 'nullable',
            'image.*' => 'image|mimes:jpg,jpeg,png,gif|max:1024',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được nhập quá :max ký tự',
            'numeric' => ':attribute không hợp lệ',
            'gt' => ':attribute không hợp lệ',
            'sale.max' => ':attribute không hợp lệ',
            'image.*.image' => ':attribute sai định dạng',
            'image.*.mimes' => ':attribute sai định dạng',
            'image.*.max' => ':attribute phải có dung lượng dưới 1MB',
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Tên sản phẩm',
            'price' => 'Giá sản phẩm',
            'id_category' => 'Danh mục',
            'id_brand' => 'Thương hiệu',
            'status' => 'Tình trạng',
            'sale' => '% sale',
            'company' => 'Tên công ty',
            'detail' => 'Thông tin chi tiết',
            'image' => 'Hình ảnh',
        ];
    }
}
