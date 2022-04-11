<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateForumCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('forum_comments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('forum_id');
            $table->unsignedInteger('user_id');
            $table->unsignedBigInteger('replied_id')->nullable();
            $table->string('comment',500);
            $table->unsignedTinyInteger('status')->default(\App\Models\ForumComment::STATUS_PENDING);
            $table->timestamps();

            $table->foreign('forum_id')->references('id')->on('forums');
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('replied_id')->references('id')->on('forum_comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('forum_comments');
    }
}
