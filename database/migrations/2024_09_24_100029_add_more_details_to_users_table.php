<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMoreDetailsToUsersTable extends Migration
{
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            // Check if the column does not exist before adding it
            if (!Schema::hasColumn('users', 'address')) {
                $table->string('address')->nullable();
            }
            // Add other columns as needed, similarly checking for each
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            // Remove the column if it exists
            if (Schema::hasColumn('users', 'address')) {
                $table->dropColumn('address');
            }
        });
    }
}

