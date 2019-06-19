<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TagCreateRequest extends FormRequest {
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
                'tag'      => 'bail|required|unique:tags,tag',
                'title'    => 'required',
                'subtitle' => 'required',
                'layout'   => 'required',
        ];
    }

    public function messages()
    {
        return [
                'tag.bail'          => '标签保证',
                'tag.required'      => '标签不能为空',
                'tag.unique'        => '标签不能重复',
                'title.required'    => '标题不能为空',
                'subtitle.required' => '副标题不能为空',
                'layout.required'   => '布局不能为空',
        ];
    }
}
