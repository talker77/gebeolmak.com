<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('blog', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->string('slug', 255)->unique();
            $table->text('description')->nullable();
            $table->string('image', 255)->nullable();
            $table->text('tags')->nullable();
            $table->boolean('is_active')->default(true)->index();
            $table->unsignedSmallInteger('lang')->default(config('admin.default_language'));
            $table->unsignedBigInteger('category_id')->nullable()->index();
            $table->unsignedBigInteger('sub_category_id')->nullable();
            $table->unsignedInteger('writer_id')->nullable();
            $table->unsignedBigInteger('view_count')->default(0);
            //----TYPES
            $table->string('type',50)->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('writer_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('blog');
    }
}
