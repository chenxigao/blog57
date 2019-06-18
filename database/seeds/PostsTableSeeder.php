<?php

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class PostsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //从文件中提取所有的标签名
        $tags = Tag::all()->pluck('tag')->all();

        //先清理数据表
        Post::truncate();

        //不要忘记清理关联表
        DB::table('post_tag_pivot')->truncate();

        //一次填充20篇文章
        factory(Post::class, 20)->create()->each(function ($post) use ($tags){
            //30% 没有分配标签
            if (mt_rand(0, 100) <= 30 ){
                return;
            }

            shuffle($tags);
            $postTags = [$tags[0]];

            //30% 文章随机分配标签1,2
            if (mt_rand(1, 100) <= 30){
                $postTags[] = $tags[1];
            }

            $post->syncTags($postTags);
        });
    }
}
