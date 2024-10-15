<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProcessIdToClientPartsTable extends Migration
{
    public function up()
    {
        Schema::table('client_parts', function (Blueprint $table) {
            $table->foreignId('process_id')->nullable()->constrained(); // Allows null values and sets up a foreign key constraint
        });
    }

    public function down()
    {
        Schema::table('client_parts', function (Blueprint $table) {
            $table->dropForeign(['process_id']); // Drop the foreign key constraint
            $table->dropColumn('process_id'); // Drop the column
        });
    }
}

