<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RestructurePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            //文章副标题
            $table->string('subtitle')->after('title');
            //MarkDown格式文本
            $table->renameColumn('content', 'content_raw');
            //使用markdown编辑文本，但同时保存html版本
            $table->text('content_html')->after('content');
            //文章缩略图
            $table->string('page_image')->after('content_html');
            //文章备注说明
            $table->string('meta_description')->after('page_image');
            //该文章是否是草稿
            $table->boolean('is_draft')->after('meta_description');
            //使用的布局
            $table->string('layout')->after('is_draft')->default('blog.layouts.post');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn('layout');
            $table->dropColumn('is_draft');
            $table->dropColumn('meta_description');
            $table->dropColumn('page_image');
            $table->dropColumn('content_html');
            $table->renameColumn('content_raw', 'content');
            $table->dropColumn('subtitle');
        });
    }
}
