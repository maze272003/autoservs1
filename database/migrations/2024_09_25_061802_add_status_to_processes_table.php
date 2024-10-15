<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToProcessesTable extends Migration
{
    public function up()
    {
        Schema::table('processes', function (Blueprint $table) {
            $table->string('status')->default('in process');
        });
    }

    public function down()
    {
        Schema::table('processes', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}

