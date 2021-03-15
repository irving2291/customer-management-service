<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Preenrollment extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*Schema::create('pre_enrolment', function (Blueprint $table) {
            $table->id();
            // preinscripcion resolucion
            // periodo lectivo
            // usuario creador
            $table->foreignId('informationRequestId')->constrained('information_request');
            $table->bigInteger('productId');
            $table->foreignId('StatusId')->constrained('state');
            $table->integer('language');
            $table->integer('state');
            $table->softDeletes();
            $table->timestamps();
        });*/
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Schema::dropIfExists('pre_enrolment');
    }
}
