<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
          $table->increments('id');
          $table->string('title',600);
          $table->string('link',600);
          $table->string('comments',600);
          $table->dateTime('pub_date');
          $table->string('creator',255);
          $table->string('category',255);
          $table->string('guid',255);
          $table->text('description');
          $table->longText('content');
          $table->integer('post_id');
          $table->integer('feed_id');
          $table->foreign('feed_id')->references('id')->on('feeds');
          $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
