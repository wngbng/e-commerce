<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name')->comment('用户名称');
                $table->string('email')->unique()->comment('用户邮箱');
                $table->string('phone')->unique()->comment('用户手机');
                $table->string('password')->comment('用户密码');
                $table->rememberToken();
                $table->timestamps();
            });
        }
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('文章标题');
            $table->string('cover')->comment('文章封面,图片名称');
            $table->text('body')->nullable()->comment('文章内容');
            $table->integer('user_id')->comment('用户id或管理员id');
            $table->integer('user_type')->default(1)->comment('默认1,1未用户发布,2后台管理员发布');
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
        Schema::dropIfExists('users');
        Schema::dropIfExists('article');
    }
}
