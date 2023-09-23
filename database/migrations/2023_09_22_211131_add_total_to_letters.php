<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddTotalToLetters extends Migration
{
    public function up()
    {
        \Illuminate\Support\Facades\DB::unprepared(
            "ALTER TABLE letters ADD COLUMN total INT GENERATED ALWAYS AS (google + outlook + yahoo + other) STORED;"
        );
    }
}
