<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_posts', function (Blueprint $table) {
            $table->bigIncrements('id');


            $table->bigInteger('category_id')->unsigned();
            $table->bigInteger('user_id')->unsigned();


            $table->string('slug')->unique();
            $table->string('title');


            $table->text('excerpt')->nullable();


            $table->text('content_raw');
            $table->text('content_html');


            $table->boolean('is_published')->default(false);
            $table->timestamp('published_at')->nullable();


            $table->timestamps();
            $table->softDeletes();


            $table->index('is_published');


        });
        Schema::table('blog_posts', function ($table) {
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('category_id')->references('id')->on('blog_categories');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_posts');
    }
}
