<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('username', 100)->unique();
            $table->string('password', 255);
            $table->timestamps();
        });
        table_comment('teachers', '教师');
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}
