<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMailLogsTable extends Migration
{
    public function up()
    {
        Schema::create('mail_logs', function (Blueprint $table) {
            //$table->engine = 'MyISAM';
            $table->uuid('id')->primary();
            $table->uuid('batch_id')->references('id')->on('letters');
            $table->uuid('hr_id')->references('id')->on('users');
            $table->integer('processed');
            $table->integer('wave');
            $table->timestamps();

            $table->foreign('batch_id')->references('id')->on('letters');
            $table->foreign('hr_id')->references('id')->on('users');
        });
    }
}
