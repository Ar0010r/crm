<?php

use App\Domain\Enums\Status;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddContactedToEmployees extends Migration
{
    public function up()
    {
        Schema::table('employees', function (Blueprint $table) {
            $table->timestamp('contacted')->nullable();
        });
    }
}
