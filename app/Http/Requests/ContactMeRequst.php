<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactMeRequst extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
                'name'    => 'required',
                'email'   => 'required|email',
                'message' => 'required',
        ];
    }

    public function messages()
    {
        return [
                'name.required'  => '名称不能为空',
                'email.required' => '邮箱不能为空',
                'message'        => '请输入内容',
        ];
    }
}
