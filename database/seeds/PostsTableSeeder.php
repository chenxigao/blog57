<?php

use Illuminate\Database\Seeder;
use App\Models\Post;

class PostsTableSeeder extends Seeder {
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //先清理数据表
        Post::truncate();
        //一次填充20篇文章
        factory(Post::class, 20)->create();
    }
}
