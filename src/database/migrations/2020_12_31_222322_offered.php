<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Offered extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->products()
            ->productVersions()
            ->programsAndAreas();
    }

    private function productVersions()
    {
        Schema::create('product_versions', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->index();
            $table->foreignId('productId')->constrained('products');
            $table->softDeletes();
            $table->timestamps();
            $table->unique(['productId', 'code']);
        });

        return $this;
    }

    private function products()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->index();
            $table->enum('type', ['PROGRAM', 'WEBINAR', 'CONGRESS', 'SERVICE', 'EVENT', 'LEARN'])->default('PROGRAM');// LEARN SON CURSOS
            $table->morphs('offerable');
            $table->softDeletes();
            $table->timestamps();
        });

        return $this;
    }

    private function programsAndAreas()
    {
        Schema::create('areas', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->index();
            $table->softDeletes();
            $table->timestamps();
        });

        Schema::create('programs', function (Blueprint $table) {
            $table->id();
            $table->string('code')->index();
            $table->foreignId('areaId')->constrained('areas');
            $table->morphs('offerable');
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
        Schema::dropIfExists('programs');
        Schema::dropIfExists('areas');
        Schema::dropIfExists('productVersions');
        Schema::dropIfExists('products');
    }
}
