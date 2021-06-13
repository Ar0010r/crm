<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTopHrHrsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_hr_hrs', function (Blueprint $table) {
            $table->id();
            $table->uuid('top_hr_id');
            $table->uuid('hr_id')->unique();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('top_hr_id')->references('id')->on('users');
            $table->foreign('hr_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('top_hr_hrs');
    }
}
