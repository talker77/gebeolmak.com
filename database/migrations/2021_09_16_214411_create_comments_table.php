<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->string('comment',255);
            $table->boolean('status')->nullable();

            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedBigInteger('commentable_id');
            $table->string('commentable_type', 100);

            $table->unsignedTinyInteger('point')->comment('range 1-10'); // range : 1 - 10

            $table->ipAddress('ip_address');
            $table->string('name',100)->nullable();
            $table->string('surname',100)->nullable();
            $table->string('email',100)->nullable();
            $table->string('message',255)->nullable();

            $table->timestamps();

            $table->foreign('user_id')->on('users')->references('id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
