<?php

use App\Domain\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmployeesTable extends Migration
{
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('company_id')->nullable();
            $table->uuid('hr_id')->nullable();
            $table->string('status')->default(Status::NEED_DATA);
            $table->string('name')->nullable();
            $table->date('birthday')->nullable();
            $table->string('avatar')->default('default.jpg')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('paypal')->nullable()->unique()->nullable();
            $table->string('address')->unique()->nullable();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('zip')->nullable();
            $table->string('phone_1')->nullable();
            $table->string('phone_2')->nullable();
            $table->string('race')->nullable();
            $table->text('comments')->nullable();
            $table->boolean('pickup')->nullable()->default(false);
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('hr_id')->references('id')->on('users');
        });
    }

    public function down()
    {
        Schema::dropIfExists('employees');
    }
}
