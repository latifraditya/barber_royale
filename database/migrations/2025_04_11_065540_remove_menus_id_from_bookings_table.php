<?php
// database/migrations/xxxx_xx_xx_remove_menus_id_from_bookings_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveMenusIdFromBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Drop foreign key constraint if any
            $table->dropForeign(['menus_id']);
            // Drop the column
            $table->dropColumn('menus_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bookings', function (Blueprint $table) {
            // Add the column back in case you need to roll back the migration
            $table->unsignedBigInteger('menus_id')->nullable();
            $table->foreign('menus_id')->references('id')->on('menus')->onDelete('set null');
        });
    }
}
