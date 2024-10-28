<?php

namespace App\Http\Requests\frontend;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

use Illuminate\Foundation\Http\FormRequest;

class MemberRegisterRequest extends FormRequest
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
            'email' => [
                'email',
                'required',
                'max:200',
                Rule::unique('users'),
            ],
            'password' => 'required|min:8',
            'password_confirm' => 'required|min:8',
            'phone' => [
                'nullable',
                'numeric',
                'gt:0',
                Rule::unique('users'),
            ],
            'address' => 'nullable|max:200',
            'avatar' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:1024',
            'id_country' => 'nullable',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => 'attribute không được nhập quá :max ký tự',
            'email' => ':attribute sai định dạng',
            'unique' => ':attribute đã được sử dụng bởi người khác',
            'min' => ':attribute phải nhập tối thiểu :min ký tự',
            'numeric' => ':attribute sai định dạng',
            'gt' => ':attribute sai định dạng',
            'image' => ':attribute sai định dạng',
            'mimes' => ':attribute sai định dạng',
            'avatar.max' => ':attribute phải có dung lượng dưới 1MB'
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Họ tên',
            'email' => 'Địa chỉ email',
            'password' => 'Mật khẩu',
            'password_confirm' => 'Mật khẩu nhập lại',
            'phone' => 'Số điện thoại',
            'address' => 'Địa chỉ',
            'avatar' => 'Ảnh đại diện',
        ];
    }
}
