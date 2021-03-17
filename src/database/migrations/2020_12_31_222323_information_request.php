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
        $this->archives()
            ->informationRequests();

    }

    public function archives()
    {
        Schema::create('archives', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personId')->constrained('people');
            $table->morphs('file');
            $table->softDeletes();
            $table->timestamps();
        });

        return $this;
    }


    public function informationRequests()
    {
        Schema::create('information_requests', function (Blueprint $table) {
            $table->id();
            //estado, incidencia, fecha, postulacion beca, expediente, programa es producto, via de conocimiento, fecha vigencia, excusion
            //$table->foreignId('productId');
            $table->bigInteger('productId');
            //$table->foreignId('archiveId')->constrained('archives');
            $table->bigInteger('languageId');
            $table->softDeletes();
            $table->timestamps();
        });

        return $this;
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('information_requests');
        Schema::dropIfExists('archives');
    }
}
