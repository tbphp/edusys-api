<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOfflineMessagesTable extends Migration
{
    public function up()
    {
        Schema::create('offline_messages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedTinyInteger('type')->index('inx_type')->comment('类型：1，用户消息，2.系统通知');
            $table->string('user_key', 20)->index('inx_user_key')->comment('接收者key,身份+id拼接');
            $table->text('data')->comment('json格式消息体');
        });
    }

    public function down()
    {
        Schema::dropIfExists('offline_messages');
    }
}
