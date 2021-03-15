<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class InformationRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('information_requests', function (Blueprint $table) {
            $table->id();
            //estado, incidencia, fecha, postulacion beca, expediente, programa es producto, via de conocimiento, fecha vigencia, excusion
            //$table->foreignId('productId');
            $table->bigInteger('productId');
            $table->integer('language');
            $table->softDeletes();
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
        Schema::dropIfExists('information_requests');
    }
}
