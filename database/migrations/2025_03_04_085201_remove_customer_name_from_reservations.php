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
        Schema::table('reservations', function (Blueprint $table) {
            $table->dropColumn('customer_name'); 
        });
    }

    public function down()
    {
        // Schema::table('reservations', function (Blueprint $table) {
        //     $table->string('customer_name')->after('user_id'); // Agregarla de nuevo si se revierte
        // });
    }
};
