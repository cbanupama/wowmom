<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInterestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('interests', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('user_id');
            $table->string('name');
            $table->boolean('active')->default(true);
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });

        Schema::create('interest_language', function (Blueprint $table) {
            $table->unsignedBigInteger('interest_id');
            $table->unsignedBigInteger('language_id');
            $table->timestamps();

            $table->foreign('interest_id')
                ->references('id')
                ->on('interests')
                ->onDelete('cascade');

            $table->foreign('language_id')
                ->references('id')
                ->on('languages')
                ->onDelete('cascade');
        });

        Schema::create('interest_super_category', function (Blueprint $table) {
            $table->unsignedBigInteger('interest_id');
            $table->unsignedBigInteger('super_category_id');
            $table->timestamps();

            $table->foreign('interest_id')
                ->references('id')
                ->on('interests')
                ->onDelete('cascade');

            $table->foreign('super_category_id')
                ->references('id')
                ->on('super_categories')
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
        Schema::dropIfExists('interests');
        Schema::dropIfExists('interest_language');
        Schema::dropIfExists('interest_super_category');
        DB::statement('SET FOREIGN_KEY_CHECKS = 1');
    }
}
