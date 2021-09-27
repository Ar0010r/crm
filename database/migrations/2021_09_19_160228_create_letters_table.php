<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLettersTable extends Migration
{
    public function up()
    {
        Schema::create('letters', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('hr_id');
            $table->uuid('company_id')->nullable();

            $table->integer('google');
            $table->integer('outlook');
            $table->integer('yahoo');
            $table->integer('other');
            $table->date('received_at');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('hr_id')->references('id')->on('users');
            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('letters');
    }
}
