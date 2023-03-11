<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name', 50);
            $table->unsignedInteger('owner_id')->index('inx_owner');
            $table->unsignedTinyInteger('status')->comment('状态：1.待审核,2.已批准，3.已拒绝');
            $table->string('reject_reason')->default('')->comment('拒绝原因');
            $table->timestamps();
            $table->softDeletes();
        });
        table_comment('schools', '学校');

        Schema::create('school_teacher', function (Blueprint $table) {
            $table->unsignedInteger('school_id')->index('inx_school');
            $table->unsignedInteger('teacher_id')->index('inx_teacher');
        });
    }

    public function down()
    {
        Schema::dropIfExists('schools');
    }
}
