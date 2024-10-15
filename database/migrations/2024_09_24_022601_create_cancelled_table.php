<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('cancelled_bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('carModel');
            $table->string('serviceType');
            $table->string('carIssue')->nullable();
            $table->date('appointmentDate');
            $table->time('appointmentTime');
            $table->string('plateNumber');
            $table->text('additionalNotes')->nullable();
            $table->timestamps();
        });
    }


        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('cancelled_bookings');
        }
};
