<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookingsTable extends Migration
{
    public function up()
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->string('carModel');
            $table->string('serviceType');
            $table->string('carIssue')->nullable();
            $table->date('appointmentDate');
            $table->time('appointmentTime');
            $table->string('plateNumber'); // Changed from phoneNumber to plateNumber
            $table->text('additionalNotes')->nullable();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('status')->default('pending'); // Add this line for status
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('bookings');
    }
}
