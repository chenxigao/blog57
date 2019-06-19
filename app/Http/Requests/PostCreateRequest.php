<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;

class PostCreateRequest extends FormRequest {
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
                'title'            => 'required',
                'subtitle'         => 'required|min:2',
                'content'          => 'required|min:3',
                'meta_description' => 'required|max:60',
//                'publish_date' => 'required',
//                'publish_time' => 'required',
                'layout'           => 'required',
        ];
    }

    public function messages()
    {
        return [
                'title.required'            => '标题不能为空',
                'subtitle.required'         => '副标题不能为空',
                'subtitle.min'              => '副标题最少输入2个字符',
                'content.required'          => '内容不能为空',
                'content.min'               => '内容最少输入3个字符',
                'meta_description.required' => '摘要不能为空。',
                'meta_description.max'      => '摘要最多不能超过60个字符',
        ];
    }

    //返回创建新文章的字段和值
    public function postFillData()
    {
        $published_at = new Carbon(
                $this->publish_date . ' ' . $this->publish_time
        );
        return [
                'title'            => $this->title,
                'subtitle'         => $this->subtitle,
                'page_image'       => $this->page_image,
                'content_raw'      => $this->get('content'),
                'meta_description' => $this->meta_description,
                'is_draft'         => (bool) $this->is_draft,
                'published_at'     => $published_at,
                'layout'           => $this->layout,
        ];
    }
}
