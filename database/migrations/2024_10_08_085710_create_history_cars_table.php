<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoryCarsTable extends Migration
{
    public function up()
    {
        Schema::create('history_cars', function (Blueprint $table) {
            $table->id(); // Auto-incrementing ID
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // Foreign key referencing users
            $table->string('carModel');
            $table->string('serviceType');
            $table->string('carIssue')->nullable();
            $table->date('appointmentDate');
            $table->time('appointmentTime');
            $table->string('plateNumber');
            $table->text('additionalNotes')->nullable();
            $table->timestamps(); // created_at and updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('history_cars');
    }
}

