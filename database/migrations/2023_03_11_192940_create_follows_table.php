<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFollowsTable extends Migration
{
    public function up()
    {
        Schema::create('follows', function (Blueprint $table) {
            $table->unsignedInteger('teacher_id')->index('inx_teacher');
            $table->unsignedInteger('student_id')->index('inx_student');
            $table->timestamps();
        });
        table_comment('follows', '关注');
    }

    public function down()
    {
        Schema::dropIfExists('follows');
    }
}
