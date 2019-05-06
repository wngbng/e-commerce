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
                $table->string('password')->comment('用户密码');
                $table->rememberToken();
                $table->timestamps();
            });
        }
        Schema::create('article', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->comment('文章标题');
            $table->text('body')->nullable()->comment('文章内容');
            $table->integer('user_id')->comment('用户id');
            $table->timestamps();
        });
        Schema::create('admin', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->comment('管理员账号');
            $table->string('password')->comment('管理员密码');
            $table->integer('type')->comment('管理员权限');
            $table->timestamps();
        });
        Schema::create('password_resets', function (Blueprint $table) {
            $table->string('email')->index();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
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
        Schema::dropIfExists('admin');
        Schema::dropIfExists('password_resets');
    }
}
