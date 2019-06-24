<?php

namespace App\Models;

use Carbon\Carbon;
use App\Services\Markdowner;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Post extends Model {
    protected $dates = ['published_at'];

    //添加 $fillable 属性
    protected $fillable = [
            'title', 'subtitle', 'content_raw', 'page_image', 'meta_description', 'layout', 'is_draft', 'published_at',
    ];

    //返回published_at 字段的日期部分
    public function getPublishDateAttribute($value)
    {
        return $this->published_at->format('Y-m-d');
    }

    //返回published_at 字段的时间部分
    public function getPublishTimeAttribute($value)
    {
        return $this->published_at->format('g:i A');
    }

    //content_raw 字段别名
    public function getContentAttribute($value)
    {
        return $this->content_raw;
    }

    //添加文章与标签多对多关系
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'post_tag_pivot');
    }


    //设置标题属性并自动设置slug
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = $value;

        if ( ! $this->exists) {
            $value = uniqid(str_random(8));
            $this->setUniqueSlug($value, 0);
        }
    }

    protected function setUniqueSlug($title, $extra)
    {
        $slug = str_slug($title, '-', $extra);

        if (static::where('slug', $slug)->exists()) {
            $this->setUniqueSlug($title, $extra + 1);
            return;
        }

        return $this->attributes['slug'] = $slug;
    }

    //设置原始内容时自动设置 HTML 内容
    public function setContentRawAttribute($value)
    {
        $markdown = new Markdowner();

        $this->attributes['content_raw'] = $value;
        $this->attributes['content_html'] = $markdown->toHTML($value);

    }

    //同步添加的新标签
    public function syncTags(array $tags)
    {
        Tag::addNeededTags($tags);

        if (count($tags)) {
            $this->tags()->sync(
                    Tag::whereIn('tag', $tags)->get()->pluck('id')->all()
            );
            return;
        }

        $this->tags()->detach();
    }

    //返回文章url的方法
    public function url(Tag $tag = null)
    {
        $url = url('blog/' . $this->slug);

        if ($tag) {
            $url .= '?tag=' . urlencode($tag->tag);
        }
        return $url;
    }

    //返回标记连接的数组

    public function tagLinks($base = '/blog?tag=%TAG%')
    {
        $tags = $this->tags()->get()->pluck('tag')->all();
        $return = [];
        foreach ($tags as $tag) {
            $url = str_replace('%TAG%', urlencode($tag), $base);
            $return[] = '<a href="' . $url . '">' . e($tag) . '</a>';
        }
        return $return;
    }

    //在此之后返回下一个日志或为空
    public function newerPost(Tag $tag = null)
    {
        $query = static::where('published_at', '>', $this->published_at)
                ->where('published_at', '<=', Carbon::now())
                ->where('is_draft', 0)
                ->orderBy('published_at', 'asc');
        if ($tag) {
            $query = $query->whereHas('tags', function ($q) use ($tag) {
                $q->where('tag', '=', $tag->tag);
            });
        }
        return $query->first();
    }

    //返回之前的上一篇文章或为空
    public function olderPost(Tag $tag = null)
    {
        $query = static::query()->where('published_at', '<', $this->published_at)
                ->where('is_draft', 0)
                ->orderBy('published_at', 'desc');
        if ($tag){
            $query = $query->whereHas('tags', function($q) use ($tag){
                $q->where('tag', '=', $tag->tag);
            });
        }
        return $query->first();
    }

}
