<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Servers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('servers', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id');
            $table->string('name');
            $table->string('title');
            $table->integer('author');
            $table->string('ip');
            $table->string('guest_permission')->default('游客');
            $table->string('player_permission')->default('注册玩家');
            $table->string('admin_permission')->default('管理员');
            $table->json('tags');
            $table->string('cover');
            $table->string('website');
            $table->text('describe');
            $table->text('markdown');
            $table->string('md5');
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
        Schema::dropIfExists('servers');
    }
}
