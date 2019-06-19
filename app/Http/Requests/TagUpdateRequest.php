<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagUpdateRequest extends FormRequest {
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
                'title'    => 'required',
                'subtitle' => 'required',
                'layout'   => 'required',
        ];
    }

    public function messages()
    {
        return [
                'title.required'  => '标题不能为空',
                'subtitle'        => '副标题不能为空',
                'layout.required' => '布局不能为空',
        ];
    }

}
