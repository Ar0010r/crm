<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubscriptionsTable extends Migration
{
    public function up()
    {
        Schema::create('subscriptions', function (Blueprint $table) {
            //$table->engine = 'MyISAM';

            $table->uuid('id')->primary();
            $table->uuid('company_id');
            $table->string('period');
            $table->string('provider');
            $table->string('service');
            $table->float('price');
            $table->date('last_payment');
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('company_id')->references('id')->on('companies');
        });
    }

    public function down()
    {
        Schema::dropIfExists('subscriptions');
    }
}
