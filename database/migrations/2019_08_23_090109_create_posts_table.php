<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->longText('body')->nullable();
            $table->text('youtube_link')->nullable();
            $table->string('web_link')->nullable();
            $table->string('web_link_title')->nullable();
            $table->string('credit_title')->nullable();
            $table->string('credit_link')->nullable();
            $table->boolean('is_published')->default(false);
            $table->dateTime('publish_at')->nullable();
            $table->timestamps();

        });

        Schema::create('language_post', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
        });

        Schema::create('post_super_category', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('super_category_id');
            $table->timestamps();

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('super_category_id')
                ->references('id')
                ->on('super_categories')
                ->onDelete('cascade');
        });

        Schema::create('interest_post', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('interest_id');
            $table->timestamps();

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('interest_id')
                ->references('id')
                ->on('interests')
                ->onDelete('cascade');
        });

        Schema::create('post_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('tag_id');
            $table->timestamps();

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
                ->onDelete('cascade');
        });

        Schema::create('food_category_post', function (Blueprint $table) {
            $table->unsignedBigInteger('post_id');
            $table->unsignedBigInteger('food_category_id');
            $table->timestamps();

            $table->foreign('post_id')
                ->references('id')
                ->on('posts')
                ->onDelete('cascade');

            $table->foreign('food_category_id')
                ->references('id')
                ->on('food_categories')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS = 0');
        Schema::dropIfExists('language_post');
        Schema::dropIfExists('post_super_category');
        Schema::dropIfExists('interest_post');
        Schema::dropIfExists('post_tag');
        Schema::dropIfExists('food_category_post');
        Schema::dropIfExists('posts');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
