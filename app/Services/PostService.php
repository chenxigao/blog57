<?php
namespace App\Services;

use App\Models\Post;
use App\Models\Tag;
use Carbon\Carbon;

class PostService
{
    protected $tag;

    //控制器
    public function __construct($tag)
    {
        $this->tag = $tag;
    }

    public function lists()
    {
        if ($this->tag){
            return $this->tag->tagIndexData($this->tag);
        }
        return $this->normalIndexData();
    }

    //返回正常索引页的数据
    public function ()
    {
        
    }
    
}