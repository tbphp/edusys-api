<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeOfflineMessagesTable extends Migration
{
    public function up()
    {
        Schema::table('offline_messages', function (Blueprint $table) {
            $table->string('from_type')->nullable();
            $table->unsignedInteger('from_id')->nullable()->comment('发送者ID');
            $table->string('to_type');
            $table->unsignedInteger('to_id')->comment('接收者ID');
            $table->text('message')->comment('消息');
            $table->timestamps();

            $table->dropColumn('data');
        });
    }

    public function down()
    {
        Schema::table('offline_messages', function (Blueprint $table) {
            //
        });
    }
}
