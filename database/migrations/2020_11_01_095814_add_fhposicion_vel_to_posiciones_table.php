<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFhposicionVelToPosicionesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posiciones', function (Blueprint $table) {
            //
            $table->dateTime('fh_posicion')->nullable()->after('tracker_id');
            $table->string('vel',20)->nullable()->after('fh_posicion');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posiciones', function (Blueprint $table) {
            //
            $table->dropColumn('fh_posicion');
            $table->dropColumn('vel');
        });
    }
}
