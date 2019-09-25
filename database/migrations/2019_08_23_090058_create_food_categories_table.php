<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFoodCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('food_categories', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->boolean('active')->default(false);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::create('food_category_language', function (Blueprint $table) {
            $table->unsignedBigInteger('food_category_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();

            $table->foreign('food_category_id')
                ->references('id')
                ->on('food_categories')
                ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
        });

        Schema::create('food_category_super_category', function (Blueprint $table) {
            $table->unsignedBigInteger('food_category_id');
            $table->unsignedBigInteger('super_category_id');
            $table->timestamps();

            $table->foreign('food_category_id')
                ->references('id')
                ->on('food_categories')
                ->onDelete('cascade');

            $table->foreign('super_category_id')
                ->references('id')
                ->on('super_categories')
                ->onDelete('cascade');
        });

        Schema::create('food_category_interest', function (Blueprint $table) {
            $table->unsignedBigInteger('food_category_id');
            $table->unsignedBigInteger('interest_id');

            $table->foreign('food_category_id')
                ->references('id')
                ->on('food_categories')
                ->onDelete('cascade');

            $table->foreign('interest_id')
                ->references('id')
                ->on('interests')
                ->onDelete('cascade');
        });

        Schema::create('food_category_tag', function (Blueprint $table) {
            $table->unsignedBigInteger('food_category_id');
            $table->unsignedBigInteger('tag_id');

            $table->foreign('food_category_id')
                ->references('id')
                ->on('food_categories')
                ->onDelete('cascade');

            $table->foreign('tag_id')
                ->references('id')
                ->on('tags')
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
        Schema::dropIfExists('food_categories');
        Schema::dropIfExists('food_category_language');
        Schema::dropIfExists('food_category_super_category');
        Schema::dropIfExists('food_category_interest');
        Schema::dropIfExists('food_category_tag');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
