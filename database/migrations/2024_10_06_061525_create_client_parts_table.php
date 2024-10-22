<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientPartsTable extends Migration
{
    public function up()
    {
        Schema::create('client_parts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // User who owns the part
            $table->foreignId('parts_id')->constrained()->onDelete('cascade'); // Part ID
            $table->string('process_id', 50)->nullable(); // Add the process_id column with a length of 50
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('client_parts');
    }
}
