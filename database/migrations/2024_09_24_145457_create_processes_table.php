<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProcessesTable extends Migration
{
    public function up()
    {
        Schema::create('processes', function (Blueprint $table) {
            $table->id();
            $table->string('carModel');
            $table->string('serviceType');
            $table->string('carIssue')->nullable();
            $table->date('appointmentDate');
            $table->time('appointmentTime');
            $table->string('plateNumber');
            $table->text('additionalNotes')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); // Assuming user ID references users table
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('processes');
    }
}
