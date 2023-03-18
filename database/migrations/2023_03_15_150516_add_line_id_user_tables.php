<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLineIdUserTables extends Migration
{
    public function up()
    {
        Schema::table('teachers', function (Blueprint $table) {
            $table->string('line_id', 50)->nullable()->unique()->after('password')->comment('Line ID');
        });

        Schema::table('students', function (Blueprint $table) {
            $table->string('line_id', 50)->nullable()->index()->after('school_id')->comment('Line ID');
        });
    }

    public function down()
    {
    }
}
