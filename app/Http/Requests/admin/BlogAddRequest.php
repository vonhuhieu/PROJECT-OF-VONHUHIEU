<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BlogAddRequest extends FormRequest
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
            //
            'title' => [
                'required',
                'max:200',
                Rule::unique('blogs'),
            ],
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
            'content' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được nhập quá :max ký tự',
            'unique' => ':attribute bị trùng',
            'image' => ':attribute sai định dạng',
            'mimes' => ':attribute sai định dạng',
            'image.max' => ':attribute phải có dung lượng dưới 1MB',
        ];
    }

    public function attributes()
    {
        return [
            'title' => 'Tiêu đề',
            'image' => 'Hình ảnh',
            'content' => 'Nội dung',
        ];
    }
}
