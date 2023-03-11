<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->string('username', 100)->unique();
            $table->string('password', 255);
            $table->unsignedInteger('school_id')->index('inx_school');
            $table->timestamps();
            $table->softDeletes();
        });
        table_comment('students', '学生');
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}
