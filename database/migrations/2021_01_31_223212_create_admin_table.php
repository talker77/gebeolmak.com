<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAdminTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('admin', function (Blueprint $table) {
            $table->id();
            $table->string('title', 50)->nullable();
            $table->string('short_title', 4)->nullable();
            $table->string('creator', 100)->nullable();
            $table->string('creator_link', 100)->nullable();
            $table->unsignedInteger('max_upload_size', )->default(3024);
            $table->text('modules_status')->nullable();
            $table->text('modules')->nullable(); // blog,product vb.
            $table->boolean('multi_lang')->default(false);
            $table->boolean('multi_currency')->default(false);
            $table->unsignedTinyInteger('default_language')->default(\App\Models\Ayar::LANG_TR);
            $table->unsignedSmallInteger('default_currency')->default(\App\Models\Ayar::CURRENCY_TL);
            $table->string('default_currency_prefix', 10)->default('tl');
            $table->boolean('force_lang_currency')->default(false);
            $table->text('dashboard')->nullable();
            $table->text('site')->nullable();
            $table->text('image_quality')->nullable(); // banner,blog ... image quality

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('admin');
    }
}
