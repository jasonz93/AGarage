<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogArticleBlogTopicTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_article_blog_topic', function (Blueprint $table) {
            $table->primary([
                'blog_article_id',
                'blog_topic_id'
            ]);
            $table->integer('blog_article_id');
            $table->integer('blog_topic_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('blog_article_blog_topic');
    }
}
