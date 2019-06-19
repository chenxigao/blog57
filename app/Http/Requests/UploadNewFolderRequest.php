<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UploadNewFolderRequest extends FormRequest {
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
                'folder'     => 'required',
                'new_folder' => 'required',
        ];
    }

    public function messages()
    {
        return [
                'folder.required'     => '文件夹名字不能为空',
                'new_folder.required' => '新创建的目录名不能为空',
        ];
    }

}
