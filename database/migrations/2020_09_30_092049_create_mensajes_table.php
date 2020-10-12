<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMensajesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mensajes', function (Blueprint $table) {
            $table->id();
            $table->integer('numero')->unique();
            $table->date('fechahora');
            $table->string('emisor'); //DEBERIA ser del comandante de UUSS ojo
            $table->string('receptor');
            $table->string('ubicacion');//DEBERIA ser las coordenadas
            $table->string('maquna_rpm')->nullable(); //revol por min
            $table->string('maquna_hrmp')->nullable(); //hor maquina principal
            $table->string('maquna_hor')->nullable(); //hor novedadesav
            $table->string('maquna_hn')->nullable(); //horas navegadas
            $table->string('maquna_thn')->nullable();
            $table->string('maquna_cch')->nullable();
            $table->string('ma_hfmg')->nullable(); //h motor generador
            $table->string('ma_ccmg')->nullable(); //consumo motor generador
            $table->string('ma_ccmb')->nullable(); //h motobomba
            $table->string('ma_tccdo')->nullable();
            $table->string('ma_sado')->nullable();
            $table->string('ma_scdo')->nullable();
            $table->string('mfb_ccmfb')->nullable();
            $table->string('mfb_tccge')->nullable();
            $table->string('mfb_scge')->nullable();
            $table->string('mfb_vp')->nullable();
            $table->longText('atraques')->nullable();
            $table->longText('avistajes')->nullable();
            $table->longText('varios')->nullable();
            $table->string('tx')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mensajes');
    }
}
