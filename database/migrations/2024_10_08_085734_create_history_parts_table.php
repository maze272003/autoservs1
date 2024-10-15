<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryPartsTable extends Migration
{
    public function up()
{
    Schema::create('history_parts', function (Blueprint $table) {
        $table->id();
        $table->foreignId('history_car_id')->constrained()->onDelete('cascade');
        $table->foreignId('part_id')->constrained()->onDelete('cascade');
        $table->string('part_name');
        $table->decimal('part_price', 8, 2);
        $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Add this line
        $table->timestamps();
    });
}


    public function down()
    {
        Schema::dropIfExists('history_parts');
    }
}

