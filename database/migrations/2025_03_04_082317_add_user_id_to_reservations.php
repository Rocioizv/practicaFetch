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
        // Schema::table('reservations', function (Blueprint $table) {
        //     $table->unsignedBigInteger('user_id')->after('id'); 
        //     $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        //     $table->dropColumn('customer_name'); // Eliminar customer_name
        // });
    }

    public function down()
    {
        // Schema::table('reservations', function (Blueprint $table) {
        //     $table->string('customer_name'); 
        //     $table->dropForeign(['user_id']);
        //     $table->dropColumn('user_id');
        // });
    }
};
