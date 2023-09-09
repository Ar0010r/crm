<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadLogsTable extends Migration
{
    public function up()
    {
        Schema::create('lead_logs', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->uuid('id')->primary();
            $table->uuid('employee_id')->references('id')->on('employees');
            $table->integer('action')->default(0);
            $table->timestamps();

            $table->foreign('employee_id')->references('id')->on('employees');
        });
    }
}
