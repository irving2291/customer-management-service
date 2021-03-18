<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Common extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->people()
            ->emails();
    }

    private function emails()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->string('email');
            $table->foreignId('personId')->constrained('people');
            $table->softDeletes();
            $table->timestamps();
        });

        return $this;
    }

    private function people()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('lastName');
            $table->enum('gender', ['_MALE', '_FEMALE', '_UNDEFINED'])->default('_UNDEFINED');
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
        Schema::dropIfExists('emails');
        Schema::dropIfExists('people');
    }
}
