<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewFieldsToEmployees extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->engine = 'MyISAM';
            $table->string('secondary_email')->nullable();
            $table->string('address_2')->nullable();
        });
    }
}
