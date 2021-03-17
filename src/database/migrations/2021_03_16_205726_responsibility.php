<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Responsibility extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this->employees()
            ->obligations()
            ->delegates();
    }

    private function employees()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->foreignId('personId')->constrained('people');
            $table->foreignId('userId')->constrained('users');
            $table->softDeletes();
            $table->timestamps();
        });

        return $this;
    }

    private function obligations()
    {
        Schema::create('obligations', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->softDeletes();
            $table->timestamps();
        });

        return $this;
    }

    private function delegates()
    {
        Schema::create('delegates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('employeeAssignedId')->constrained('employees');
            $table->foreignId('employeeAssigningId')->constrained('employees');
            $table->foreignId('obligationId')->constrained('obligations');
            $table->boolean('main')->default(0);
            $table->morphs('assignable');
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
        Schema::dropIfExists('delegates');
        Schema::dropIfExists('obligations');
        Schema::dropIfExists('employees');
    }
}
