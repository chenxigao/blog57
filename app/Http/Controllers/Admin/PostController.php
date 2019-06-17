<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostCreateRequest;
use App\Http\Requests\PostUpdateRequest;
//use App\Jobs\PostFormFields;
use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Response;

class PostController extends Controller
{
    protected $fieldList = [
            'title' => '',
        'subtitle' => '',
        'page_image' => '',
        'content' => '',
        'meta_description' => '',
        'is_draft' => '0',
        'publish_date' => '',
        'publish_time' => '',
        'layout' => 'blog.layouts.post',
        'tags' => [],
    ];

    /**
     * Display a listing of the resource.
     *文章列表
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.post.index', ['posts' => Post::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *创建文章
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $fields = $this->fieldList;

        $when = Carbon::now()->addHour();
        $fields['published_date'] = $when->format('Y-m-d');
        $fields['published_time'] = $when->format('g:i A');

        foreach ($fields as $fieldName => $fieldValue){
            $fields[$fieldName] = old($fieldName, $fieldValue);
        }

        $data = array_merge(
                $fields,
                ['allTags' => Tag::all()->pluck('tag')->all()]
        );

        return view('admin.post.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *存储新创建的文章
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostCreateRequest $request)
    {
        $post = Post::create($request->postFailData());
        $post->syncTags($request->get('tags', []));

        return redirect()->route('post.index')->with('success', '新文章创建成功！');
    }


    /**
     * Show the form for editing the specified resource.
     *编辑文章
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $fields = $this->fieldsFromModel($id, $this->fieldList);

        foreach ($fields as $fieldName => $fieldValue){
            $fields [$fieldName] = old($fieldName, $fieldValue);
        }

        $data = array_merge(
                $fields,
                ['allTags' => Tag::all()->pluck('tag')->all()]
        );

        return view('admin.post.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *更新文章
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostCreateRequest $request, $id)
    {
        $post = Post::findOrFail($id);
        $post->fill($request->postFillData());
        $post->save();
        $post->syncTags($request->get('tags', []));

        if ($request->action === 'continue'){
            return redirect()->back()->with('success', '文章已保存！');
        }

        return redirect()->route('post.index')->with('success', '文章已保存！');
    }

    /**
     * Remove the specified resource from storage.
     *删除文章
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->tags()->detach();
        $post->delete();

        return redirect()->route('post.index')->with('success', '文章已删除!');
    }

    private function fieldsFromModel($id, array $fields)
    {
        $post = Post::findOrFail($id);

        $fieldNames = array_keys(array_except($fields, ['tags']));

        $fields = ['id' => $id];
        foreach ($fieldNames as $field){
            $fields[$field] = $post->{$field};
        }
        $fields['tags'] = $post->tags->pluck('tag')->all();

        return $fields;
    }

}
