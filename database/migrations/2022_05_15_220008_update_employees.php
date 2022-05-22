<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateEmployees extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->uuid('hr_company_id')->nullable();
            $table->foreign('hr_company_id')->references('id')->on('companies');

            $table->string('notes')->nullable();
        });
    }
}
