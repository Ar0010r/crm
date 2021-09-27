<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompaniesTable extends Migration
{
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name')->unique();
            $table->uuid('personnel_id');
            $table->string('domain')->unique();
            $table->string('pseudonym')->unique();
            $table->string('email')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('personnel_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('companies');
    }
}
