<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProofPaymentToProcessesTable extends Migration
{
    public function up()
    {
        Schema::table('processes', function (Blueprint $table) {
            $table->string('proof_payment')->nullable(); // Add proof_payment column
        });
    }

    public function down()
    {
        Schema::table('processes', function (Blueprint $table) {
            $table->dropColumn('proof_payment');
        });
    }
}
