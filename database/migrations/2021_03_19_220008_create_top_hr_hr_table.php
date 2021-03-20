<?php

use App\Shared\Value\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('top_hr_hr', function (Blueprint $table) {
            $table->id();
            $table->foreignId('top_hr_id')->nullable();
            $table->foreignId('hr_id')->nullable();
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
        Schema::dropIfExists('top_hr_hr');
    }
}
