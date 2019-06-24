<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model {
    protected $fillable = ['tag', 'title', 'subtitle', 'page_image', 'meta_description', 'reverse_direction'];

    //定义文章与标签之间的多对多关系
    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag_pivot');
    }

    //添加列表中所需的任何标签
    public static function addNeededTags(array $tags)
    {
        if (count($tags) === 0) {
            return;
        }

        $found = static::whereIn('tag', $tags)->get()->pluck('tag')->all();


        foreach (array_diff($tags, $found) as $tag) {
            static::create([
                    'tag'               => $tag,
                    'title'             => $tag,
                    'subtitle'          => 'Subtitle for ' . $tag,
                    'page_image'        => '',
                    'meta_description'  => '',
                    'reverse_direction' => false,
            ]);
        }
    }

    //创建一个：返回用于标记的索引布局（Return the index layout to use for a tag）
    public static function layout($tag,$default = 'blog.layouts.index' )
    {
        $layout = static::where('tag', $tag)->get()->pluck('layout')->first();

        return $layout ?: $default;
    }

}
