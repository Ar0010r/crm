<?php

use App\Shared\Value\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTestsTable extends Migration
{
    public function up()
    {
        Schema::create('tests', function (Blueprint $table) {
            $table->engine = 'MyISAM';

            $table->uuid('id')->primary();
            $table->date('date');
            $table->uuid('company_id');
            $table->uuid('manager_id');
            $table->string('env');
            $table->string('template');
            $table->boolean('outlook')->nullable();
            $table->boolean('yahoo')->nullable();
            $table->boolean('google')->nullable();
            $table->boolean('other')->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('manager_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('tests');
    }
}
