<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMenusIdToBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bookings', function (Blueprint $table) {
          $table->unsignedBigInteger('menus_id')->nullable();

          // Menghubungkan foreign key dengan tabel menus
          $table->foreign('menus_id')->references('id')->on('menus')->onDelete('set null');
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
          $table->dropForeign(['menus_id']);
          $table->dropColumn('menus_id');
        });
    }
}
