<?php

namespace App\Http\Requests\admin;

use Illuminate\Foundation\Http\FormRequest;

class OpinionReplayRequest extends FormRequest
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
            'subject' => 'required|max:200',
            'replay' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute không được để trống',
            'max' => ':attribute không được nhập quá :max ký tự',
        ];
    }

    public function attributes()
    {
        return [
            'subject' => 'Chủ đề',
            'replay' => 'Phản hồi'
        ];
    }
}
